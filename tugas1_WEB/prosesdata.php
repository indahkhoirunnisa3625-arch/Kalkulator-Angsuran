<?php
if (!isset($_POST["hitung"])) {
    header("Location: index.php");
    exit();
}

$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$hargamobil = (float)($_POST['hargamobil'] ?? 0);
$tenor = (int)($_POST['tenor'] ?? 0);
$dp = (float)($_POST['dp'] ?? 0);

// Repopulate Query String
$query_nama = "nama=" . urlencode($nama);
$query_email = "email=" . urlencode($email);
$query_hargamobil = "hargamobil=" . urlencode($hargamobil);
$query_tenor = "tenor=" . urlencode($tenor);
$query_dp = "dp=" . urlencode($dp);
$isi_form = "&$query_nama&$query_email&$query_hargamobil&$query_tenor&$query_dp";

// Validasi Form (Pesan peringatan jika belum diisi)
if (empty($nama)) {
    $pesan = urlencode("Nama harus diisi");
    header("Location: index.php?pesan={$pesan}{$isi_form}");
    exit();
}

if (empty($email)) {
    $pesan = urlencode("Email harus diisi");
    header("Location: index.php?pesan={$pesan}{$isi_form}");
    exit();
}

if (empty($hargamobil)) {
    $pesan = urlencode("harga mobil harus diisi ya!");
    header("Location: index.php?pesan={$pesan}{$isi_form}");
    exit();
}

if (empty($tenor)) {
    $pesan = urlencode("tenor harus diisi ya!");
    header("Location: index.php?pesan={$pesan}{$isi_form}");
    exit();
}

// Perhitungan Logic
$bunga_persen = 20;
$bunga_nominal = ($bunga_persen / 100) * $hargamobil;
$hargadpmobil = ($dp / 100) * $hargamobil;
$lamaangsuran = $tenor * 12;

// Rumus Angsuran: ((Harga Mobil + Bunga) - DP) / Lama Angsuran
$total_hutang = ($hargamobil + $bunga_nominal) - $hargadpmobil;
$jumlahangsuran = $lamaangsuran > 0 ? ($total_hutang / $lamaangsuran) : 0;

// Output Tampilan Biasa (Plain Text)
echo "nama=" . htmlspecialchars($nama) . "<br>";
echo "email=" . htmlspecialchars($email) . "<br>";
echo "hargamobil=" . $hargamobil . "<br>";
echo "tenor=" . $tenor . " tahun <br>";
echo "dp=" . $dp . "% <br>";
echo "Bunga=" . $bunga_persen . "%<br>";
echo "Lama Angsuran=" . $lamaangsuran . " bulan <br>";
echo "DP Mobil=Rp " . number_format($hargadpmobil, 0, ',', '.') . " rupiah <br>";
echo "Jumlah Angsuran=Rp " . number_format($jumlahangsuran, 0, ',', '.') . " / bulan <br>";
?>