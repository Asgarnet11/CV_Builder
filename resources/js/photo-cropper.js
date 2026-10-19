export function cvPhotoCropper(config = {}) {
    return {
        photoName: null,
        photoPreview: null,
        savedBase64: null,
        showCropper: false,
        cropper: null,
        isUploading: false,
        isDeleting: false,
        activeRatio: '1:1',
        cropWidth: 0,
        cropHeight: 0,
        photoMessage: null,
        errorMessage: null,
        uploadUrl: config.uploadUrl || '/cv-profile/photo',
        deleteUrl: config.deleteUrl || '/cv-profile/photo',
        csrfToken: config.csrfToken || '',

        init() {
            if (!this.csrfToken) {
                this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            }
        },

        initCropper(imageUrl) {
            this.showCropper = true;
            this.activeRatio = '1:1';
            this.errorMessage = null;

            this.$nextTick(() => {
                const image = document.getElementById('cropper-image');
                if (!image) return;

                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }

                image.onload = () => {
                    const CropperClass = window.Cropper;
                    if (!CropperClass) {
                        this.errorMessage = 'Pustaka pemotong gambar sedang dimuat, silakan coba sesaat lagi.';
                        return;
                    }

                    this.cropper = new CropperClass(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 0.9,
                        responsive: true,
                        restore: false,
                        guides: true,
                        center: true,
                        highlight: false,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                        crop: (e) => {
                            this.cropWidth = Math.round(e.detail.width);
                            this.cropHeight = Math.round(e.detail.height);
                        }
                    });
                };

                image.src = imageUrl;
            });
        },

        setRatio(ratio) {
            this.activeRatio = ratio;
            if (!this.cropper) return;
            if (ratio === '1:1') this.cropper.setAspectRatio(1);
            else if (ratio === '3:4') this.cropper.setAspectRatio(3 / 4);
            else if (ratio === 'free') this.cropper.setAspectRatio(NaN);
        },

        zoom(delta) {
            if (this.cropper) this.cropper.zoom(delta);
        },

        rotate(deg) {
            if (this.cropper) this.cropper.rotate(deg);
        },

        resetCrop() {
            if (this.cropper) {
                this.cropper.reset();
                this.setRatio(this.activeRatio);
            }
        },

        cancelCrop() {
            this.showCropper = false;
            if (this.cropper) {
                this.cropper.destroy();
                this.cropper = null;
            }
            if (this.$refs.photo) {
                this.$refs.photo.value = '';
            }
        },

        async cropAndSave() {
            if (!this.cropper || this.isUploading) return;
            this.isUploading = true;
            this.errorMessage = null;

            try {
                // Ambil canvas hasil crop dengan resolusi asli tanpa dipaksa mengecil ke 400x400
                const canvas = this.cropper.getCroppedCanvas({
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });

                if (!canvas) {
                    throw new Error('Gagal memproses area foto yang dipilih.');
                }

                // Kompresi adaptif: jaga di bawah 2 MB (target aman 1.95 MB) dengan menjaga ketajaman resolusi asli
                const TARGET_BYTES = 1950000;
                let quality = 0.94;
                let base64 = canvas.toDataURL('image/jpeg', quality);
                let approxBytes = Math.round((base64.length * 3) / 4);

                if (approxBytes > TARGET_BYTES) {
                    const qualities = [0.90, 0.86, 0.82, 0.78, 0.74, 0.70];
                    for (const q of qualities) {
                        quality = q;
                        base64 = canvas.toDataURL('image/jpeg', quality);
                        approxBytes = Math.round((base64.length * 3) / 4);
                        if (approxBytes <= TARGET_BYTES) break;
                    }
                }

                // Edge case ekstrim bila gambar di atas 30-40 megapixel: skala proporsional secukupnya
                let workingCanvas = canvas;
                while (approxBytes > TARGET_BYTES && (workingCanvas.width > 1600 || workingCanvas.height > 1600)) {
                    const scale = 0.88;
                    const newW = Math.round(workingCanvas.width * scale);
                    const newH = Math.round(workingCanvas.height * scale);
                    const tempCanvas = document.createElement('canvas');
                    tempCanvas.width = newW;
                    tempCanvas.height = newH;
                    const ctx = tempCanvas.getContext('2d');
                    ctx.imageSmoothingEnabled = true;
                    ctx.imageSmoothingQuality = 'high';
                    ctx.drawImage(workingCanvas, 0, 0, newW, newH);
                    workingCanvas = tempCanvas;
                    base64 = workingCanvas.toDataURL('image/jpeg', 0.85);
                    approxBytes = Math.round((base64.length * 3) / 4);
                }

                const token = this.csrfToken || document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const response = await fetch(this.uploadUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ photo_base64: base64 })
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    this.photoPreview = data.photo_url;
                    this.savedBase64 = base64;
                    this.photoMessage = `Foto tersimpan (${data.width} × ${data.height} px • ${data.size_kb} KB)`;
                    setTimeout(() => { this.photoMessage = null; }, 6000);
                    this.cancelCrop();

                    // Refresh split preview iframe if open
                    const frame = document.querySelector('iframe[x-ref="previewFrame"]');
                    if (frame && frame.contentWindow) {
                        frame.contentWindow.location.reload();
                    }
                } else {
                    this.errorMessage = data.message || 'Gagal menyimpan foto profil.';
                }
            } catch (err) {
                this.errorMessage = err.message || 'Terjadi kendala saat memproses foto.';
            } finally {
                this.isUploading = false;
            }
        },

        async deletePhoto() {
            if (!confirm('Apakah Anda yakin ingin menghapus foto profil ini?')) return;
            this.isDeleting = true;
            this.errorMessage = null;

            try {
                const token = this.csrfToken || document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const response = await fetch(this.deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                });

                const data = await response.json();
                if (response.ok && data.status === 'success') {
                    this.photoPreview = 'deleted';
                    this.savedBase64 = null;
                    this.photoName = null;
                    this.photoMessage = 'Foto profil berhasil dihapus.';
                    setTimeout(() => { this.photoMessage = null; }, 5000);

                    // Refresh split preview iframe if open
                    const frame = document.querySelector('iframe[x-ref="previewFrame"]');
                    if (frame && frame.contentWindow) {
                        frame.contentWindow.location.reload();
                    }
                } else {
                    this.errorMessage = data.message || 'Gagal menghapus foto.';
                }
            } catch (err) {
                this.errorMessage = err.message || 'Terjadi kesalahan saat menghapus foto.';
            } finally {
                this.isDeleting = false;
            }
        }
    };
}
