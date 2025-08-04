<script setup>
defineProps({
    data: Object,
});
const date = new Date().toLocaleDateString("id-ID");

function fcurrency(value) {
    return new Intl.NumberFormat().format(value);
}
</script>

<template>
    <div class="container">
        <div class="header">
            <h1>GADAI SELAMAT JAYA</h1>
        </div>

        <div class="parties-section">
            <p>
                Pada hari ini, {{ date }} bertempat di Balige, kami yang
                bertanda tangan di bawah ini:
            </p>

            <p><strong>PIHAK PERTAMA (PEMBERI PINJAMAN)</strong></p>
            <p>
                Nama: Supri<br />
                Nomor KTP/Identitas: 12083728167<br />
                Alamat: jl besar balige tarutung<br />
                (Selanjutnya disebut sebagai **PIHAK PERTAMA**)
            </p>

            <p><strong>PIHAK KEDUA (PEMINJAM)</strong></p>
            <p>
                Nama: {{ data[0].nasabah.name }}<br />
                Nomor KTP/Identitas: {{ data[0].nasabah.nik }}<br />
                Alamat: {{ data[0].nasabah.alamat }}<br />
                (Selanjutnya disebut sebagai **PIHAK KEDUA**)
            </p>

            <p>
                PIHAK PERTAMA dan PIHAK KEDUA secara bersama-sama selanjutnya
                disebut sebagai **PARA PIHAK**. PARA PIHAK sepakat untuk
                mengadakan Perjanjian Piutang dengan ketentuan dan syarat
                sebagai berikut:
            </p>
        </div>

        <div class="articles-section">
            <h3>Pasal 1 - Jumlah Piutang</h3>
            <ol>
                <li>
                    PIHAK PERTAMA dengan ini memberikan pinjaman kepada PIHAK
                    KEDUA, dan PIHAK KEDUA dengan ini menerima pinjaman dari
                    PIHAK PERTAMA, sejumlah Rp.
                    {{ fcurrency(data[0].pinjaman) }}
                </li>
            </ol>

            <h3>Pasal 2 - Jangka Waktu dan Pembayaran</h3>
            <ol>
                <li>
                    Jangka waktu perjanjian ini adalah selama
                    {{ data[0].term }} bulan, terhitung sejak tanggal
                    ditandatanganinya perjanjian ini.
                </li>
                <li>
                    PIHAK KEDUA wajib melunasi seluruh jumlah piutang kepada
                    PIHAK PERTAMA selambat-lambatnya pada tanggal
                    {{ data[0].term_date }}.
                </li>
                <li>
                    Pelunasan piutang dapat dilakukan secara tunai atau melalui
                    transfer bank ke rekening PIHAK PERTAMA dengan nomor
                    **[Nomor Rekening]**.
                </li>
            </ol>
            <br />
            <br />
            <h3>Pasal 3 - Denda Keterlambatan</h3>
            <ol>
                <li>
                    Apabila PIHAK KEDUA tidak dapat melunasi atau memperpanjang
                    waktu pelunasan dalam 3 hari setelah tanggal jatuh tempo
                    akan di lakukan pelelangan tanpa pemberitahuan.
                </li>
            </ol>

            <h3>Pasal 4 - Penyelesaian Perselisihan</h3>
            <ol>
                <li>
                    Apabila terjadi perselisihan atau sengketa di kemudian hari
                    terkait perjanjian ini, PARA PIHAK sepakat untuk
                    menyelesaikannya secara musyawarah untuk mencapai mufakat.
                </li>
                <li>
                    Apabila musyawarah tidak dapat mencapai kata sepakat, PARA
                    PIHAK sepakat untuk menyelesaikan perselisihan melalui jalur
                    hukum yang berlaku di Indonesia.
                </li>
            </ol>
        </div>

        <div class="closing-section">
            <p>
                Demikianlah Perjanjian ini dibuat dalam rangkap dan
                ditandatangani oleh PARA PIHAK dalam keadaan sadar tanpa paksaan
                dari pihak mana pun, untuk dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <div class="signature-section">
            <div class="signature-block">
                <p>PIHAK PERTAMA</p>
                <p>(Pemberi Pinjaman)</p>
                <div class="signature-line"></div>
                <p class="signature-name">Supri</p>
            </div>
            <div class="signature-block">
                <p>PIHAK KEDUA</p>
                <p>(Peminjam)</p>
                <div class="signature-line"></div>
                <p class="signature-name">{{ data[0].nasabah.name }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
body {
    font-family: "Inter", sans-serif;
    background-color: #f3f4f6;
}
.container {
    max-width: 850px;
    margin: 40px auto;
    padding: 40px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
    line-height: 1.8;
    font-size: 1rem;
    color: #1f2937;
}
.header {
    text-align: center;
    margin-bottom: 32px;
}
.header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1f2937;
    text-transform: uppercase;
}
.header p {
    font-size: 1.125rem;
    color: #4b5563;
}
.parties-section,
.articles-section,
.closing-section,
.signature-section {
    margin-top: 32px;
}
.parties-section p,
.articles-section p {
    margin-bottom: 16px;
    text-align: justify;
}
.parties-section strong,
.articles-section strong {
    display: block;
    margin-bottom: 8px;
}
.articles-section h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 8px;
    margin-bottom: 16px;
}
.articles-section ol {
    list-style-type: decimal;
    padding-left: 24px;
}
.articles-section li {
    margin-bottom: 16px;
    text-align: justify;
}
.signature-section {
    display: flex;
    justify-content: space-around;
    margin-top: 60px;
}
.signature-block {
    text-align: center;
    flex-basis: 45%;
}
.signature-line {
    width: 100%;
    height: 1px;
    background-color: #9ca3af;
    margin-top: 80px;
}
.signature-name {
    margin-top: 8px;
    font-weight: 600;
    color: #1f2937;
}
@media print {
    .container {
        box-shadow: none;
        margin: 0;
        padding: 0;
    }
}
</style>
