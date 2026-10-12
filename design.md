# Design System & Aturan Kerja: LaraCV (gaya portal SSCASN)

Letakkan file ini di `.agent/rules/design-system.md` agar selalu dibaca Antigravity.

## 1. Tujuan
Website builder CV ini harus **tampil** seperti portal SSCASN (referensi: https://sscasn.bkn.go.id/) dan **berfungsi penuh** (bukan sekadar tampilan). Meniru gaya, bukan identitas.

## 2. Larangan Branding
- Jangan memakai logo SSCASN, logo BKN, lambang Garuda, foto peserta, atau teks "BKN/SSCASN".
- Gunakan logo dan nama sendiri (LaraCV). Jangan membuat situs terlihat seperti situs pemerintah asli.

## 3. Aturan Verifikasi ke Situs Referensi (WAJIB)
Jika informasi desain/perilaku kurang jelas (warna, spasi, hover, animasi, responsif, alur halaman):
1. Buka https://sscasn.bkn.go.id/ langsung dengan browser agent.
2. Periksa lewat DevTools: computed styles, CSS variables, font, ukuran, radius, shadow.
3. Uji perilakunya: scroll, hover, klik tab, carousel, tombol scroll-to-top, tampilan mobile (lebar 375px, 768px, 1280px).
4. Catat temuan ke `docs/design-reference/NOTES.md`, lalu terapkan ke kode.
Jangan menebak jika bisa dicek langsung.

## 4. Design Tokens (Terverifikasi dari live portal sscasn.bkn.go.id & globals.css)
Situs referensi memakai `theme-color: #1270a0` dan CSS variable resmi `--color-primary: #269dd8`.

```css
:root {
  /* Warna Resmi SSCASN */
  --color-primary: #269dd8;        /* tombol, aksen, judul langkah, menu aktif */
  --color-primary-dark: #1270a0;   /* hero gradient awal, theme-color */
  --color-primary-mid: #1a8cc8;    /* hero gradient 35% */
  --color-primary-alt: #1e8ec4;    /* hero gradient akhir 100% */
  --color-primary-light: #e8f4fb;  /* latar pill/tab, ikon */
  --color-accent: #de1d5e;         /* tanggal/penekanan rose-pink (resmi: --color-danger) */
  --color-warning: #fbb92e;        /* badge status aktif/menunggu (resmi: --color-warning) */
  --color-success: #77ce94;        /* status sukses/selesai */
  --color-dark: #1a1a1a;           /* teks gelap pekat */
  --color-bg: #ffffff;
  --color-surface: #ffffff;
  --color-border: #cfe6f3;
  --color-border-subtle: rgba(38, 157, 216, 0.2);
  --color-text: #1e293b;           /* slate-800 judul */
  --color-text-muted: #6b7280;     /* body-color resmi */

  /* Gradasi Hero Resmi */
  --hero-gradient: linear-gradient(135deg, #1270a0 0%, #1a8cc8 35%, #269dd8 65%, #1e8ec4 100%);

  /* Tipografi Resmi */
  --font-sans: "Poppins", ui-sans-serif, system-ui, sans-serif;
  --fw-regular: 400; --fw-medium: 500; --fw-semibold: 600; --fw-bold: 700; --fw-extrabold: 800;

  /* Bentuk & Radius Resmi */
  --radius-sm: 8px;    /* tombol & input field (rounded-lg) */
  --radius-md: 12px;   /* tab pill (rounded-xl) */
  --radius-lg: 24px;   /* kartu besar timeline (rounded-3xl) */
  --radius-pill: 999px;
  --shadow-sm: 0 1px 3px rgba(18, 112, 160, .12);
  --shadow-md: 0 6px 20px rgba(18, 112, 160, .15);

  /* Jarak: kelipatan 4px */
  --space: 4px;
}
```

## 5. Komponen
**Navbar**
- Sticky di atas. Di posisi atas: transparan di atas hero, teks putih. Setelah scroll: latar putih/blur terang, teks gelap, menu aktif berwarna primary.
- Kiri: logo. Tengah: menu (Beranda, Formasi/Template, FAQ, Panduan, Bantuan). Kanan: "Buat Akun" (outline) dan "Masuk" (solid).
- Mobile: menu jadi hamburger dengan drawer.

**Hero**
- Latar gradasi biru (primary-dark ke primary) dengan pola peta titik-titik halus.
- Kiri: judul besar tebal putih, pill label, deskripsi, kontrol carousel (panah kiri/kanan + indikator titik), tombol putih "Call Center". Kanan: ilustrasi/foto sendiri.
- Carousel harus benar-benar berjalan (auto-play, klik panah, klik indikator, bisa disentuh/swipe).

**Judul Section**
- Huruf kapital tebal di tengah, garis bawah tebal pendek berwarna primary.

**Tab/Pill**
- Kelompok pill dalam wadah bergaris tipis. Tab aktif: latar primary, teks putih. Pindah tab mengganti konten tanpa reload.

**Timeline (kartu besar)**
- Wadah dengan border primary tipis dan radius besar.
- Baris berisi langkah: ikon dalam kotak rounded, judul biru tebal, rentang tanggal berwarna accent, badge status (aktif/menunggu) di sudut ikon.
- Panah ">" antar langkah; garis siku menyambung antar baris. Responsif: jadi vertikal di mobile.

**Tombol**
- Primary: solid primary, teks putih, radius 8px, ada ikon opsional di kiri. Hover: gelapkan sedikit. Focus: ring terlihat.
- Secondary: outline primary, latar putih.

**Footer**
- Tiga kolom: Kontak (ikon + teks), Tautan (dua kolom), Media Sosial (tombol kotak outline). Strip bawah berwarna primary berisi hak cipta.
- Tombol "kembali ke atas" mengambang di kanan bawah (muncul setelah scroll, scroll halus).

## 6. Fungsionalitas (semua harus bekerja)
- Semua tautan navigasi menuju halaman nyata (tidak ada `href="#"` kosong). Buat halaman: Beranda, Template/Formasi, FAQ, Panduan/Dasar Hukum, Bantuan.
- Autentikasi: Buat Akun, Masuk, Keluar, dengan validasi form dan pesan error yang jelas.
- Fitur inti CV builder: isi data, pratinjau langsung, simpan, edit, hapus, ekspor PDF.
- Navbar sticky + perubahan gaya saat scroll, menu mobile, tab, carousel, scroll-to-top.
- Setiap form: label di atas input, validasi, status loading, state error/kosong.
- Aksesibilitas: kontras cukup, navigasi keyboard, atribut `alt` dan `aria-label`.
- Responsif: uji di 375px, 768px, 1280px.

## 7. Aturan Kode
- Gunakan token di atas lewat CSS variables / konfigurasi Tailwind. Jangan hardcode warna atau ukuran.
- Komponen dibuat reusable; halaman baru memakai komponen yang sudah ada.
- Jangan menghapus fitur yang sudah ada tanpa diminta.

## 8. Alur Setiap Tugas UI
1. Baca file ini dan `docs/design-reference/`.
2. Implementasikan.
3. Jalankan aplikasi, buka di browser, uji semua interaksi yang disentuh.
4. Ambil screenshot, bandingkan dengan situs referensi (desktop dan mobile), perbaiki selisihnya.
5. Laporkan apa yang diuji dan apa yang masih belum sesuai.