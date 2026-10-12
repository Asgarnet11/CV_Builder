# Catatan Ekstraksi Desain Resmi SSCASN (https://sscasn.bkn.go.id/)

Tanggal Verifikasi: 12 Oktober 2026
Sumber: Inspeksi langsung live portal `https://sscasn.bkn.go.id/` dan stylesheet resmi `/_astro/globals.DjoOU26J.css`

## 1. Token Desain Resmi yang Diekstrak

### Warna
- `--color-primary`: `#269dd8` (Cyan Blue khas SSCASN)
- `--color-primary-dark`: `#1270a0` (Navy Blue - warna awal gradasi hero & theme-color)
- `--color-primary-mid`: `#1a8cc8` (Titik tengah gradasi 35%)
- `--color-primary-alt`: `#1e8ec4` (Titik akhir gradasi 100%)
- Gradasi Hero: `linear-gradient(135deg, #1270a0 0%, #1a8cc8 35%, #269dd8 65%, #1e8ec4 100%)`
- `--color-success`: `#77ce94`
- `--color-warning`: `#fbb92e` (Badge status aktif/peringatan)
- `--color-danger`: `#de1d5e` (Aksen tanggal / penekanan rose-pink)
- `--color-dark`: `#1a1a1a`
- `--color-body-color`: `#6b7280` (Teks sekunder)
- `--color-slate-800`: `#1e293b` (Teks judul utama di area putih)
- Background Section Alur: `bg-primary/5` (`rgba(38, 157, 216, 0.05)`)
- Border Kartu Timeline: `border-primary/60`
- Border Pill Tab: `border-primary/20`

### Tipografi
- Font Family: `'Poppins', ui-sans-serif, system-ui, sans-serif`
- Google Fonts URL: `https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap`
- Weights: 400 (regular), 500 (medium), 600 (semibold), 700 (bold), 800 (extrabold)

### Bentuk & Radius
- Tombol & Input: `rounded-lg` (8px)
- Tab Pill: `rounded-xl` (12px)
- Kartu Besar / Timeline Box: `rounded-3xl` (24px)
- Indicator Carousel: Pill aktif `w-8 h-2 rounded-full`, titik inaktif `w-2 h-2 rounded-full`

### Perilaku Interaktif Terverifikasi
1. **Navbar:**
   - Di posisi atas (`scrollTop === 0`): latar belakang transparan, logo putih (`brightness-0 invert`), teks menu putih (`text-white/80` hover `text-white`), tombol "Buat Akun" bergaris putih dengan kaca semi-transparan (`bg-white/15 border-white/50 text-white`), tombol "Masuk" solid putih (`bg-white text-primary`).
   - Setelah di-scroll (`scrollTop > 20`): latar belakang putih blur halus (`bg-white/95 backdrop-blur-md shadow-md border-b border-slate-200/80`), logo warna asli, teks menu gelap (`text-slate-800`), menu aktif `text-primary`, tombol "Buat Akun" outline primary (`border-primary text-primary`), tombol "Masuk" solid primary (`bg-primary text-white`).
2. **Hero Carousel:**
   - Background gradasi biru khas SSCASN dengan pola peta titik-titik transparan `opacity-20`.
   - Carousel slider otomatis berganti setiap 5 detik dengan panah navigasi kiri/kanan bulat (`w-8 h-8 rounded-full border border-white/30 bg-white/15`) dan tombol pill indicator.
3. **Timeline Alur:**
   - Kartu besar `rounded-3xl border border-primary/60 bg-white/80 backdrop-blur-[1px]` berisi langkah-langkah terstruktur dengan ikon kotak rounded, judul biru, tanggal merah muda (`#de1d5e`), dan badge status.
4. **Footer:**
   - 3 Kolom: Kontak, Tautan, Media Sosial dengan header bergaris aksen horizontal kecil (`w-6 h-0.5 bg-primary rounded-full`).
   - Strip copyright di paling bawah.
5. **Scroll-To-Top:**
   - Tombol mengambang di kanan bawah, muncul setelah scroll 300px, klik melakukan smooth scroll ke atas.
