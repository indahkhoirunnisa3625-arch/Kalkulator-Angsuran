<?php
$pesan = $_GET['pesan'] ?? '';
$nama = $_GET['nama'] ?? '';
$email = $_GET['email'] ?? '';
$hargamobil = $_GET['hargamobil'] ?? '';
$tenor = $_GET['tenor'] ?? '';
$dp = $_GET['dp'] ?? '10'; // Default 10%
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!--CSS-->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!--Navbar-->
    <header class="sticky-top bg-white border-bottom">
        <div class="container-fluid px-4 py-2 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-box overflow-hidden">
                    <img src="asset/logo bmw.jfif" alt="Logo BMW" class="w-100 h-100 object-fit-cover">
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-navy">AutoFinance</h5>
                </div>
            </div>
            <nav class="custom-nav d-none d-md-flex align-items-center gap-2">
                <a class="nav-link active" href="#">Beranda</a>
                <a class="nav-link" href="#tentang-perusahaan">Tentang Kami</a>
                <a class="nav-link" href="#kalkulator">Kalkulator</a>
                <a class="nav-link" href="#kontak">Kontak</a>
            </nav>
        </div>
    </header>

    <!--Container-->
    <main class="container my-4">

        <!--Foto Mobil-->
        <div class="banner-box mb-5 overflow-hidden rounded-3 shadow-sm" style="height: 480px;">
            <img src="asset/foto mobil 1.jfif" class="w-100 h-100 img-banner-bmw" alt="Banner BMW">
        </div>

        <!--Tentang Perusahaan-->
        <section id="tentang-perusahaan" class="row g-4 align-items-center mb-5 pt-3">
            <div class="col-md-6">
                <h3 class="text-navy fw-bold mb-3">Tentang AutoFinance</h3>
                <p class="text-muted lh-base">
                    <strong>AutoFinance</strong> adalah penyedia layanan pembiayaan kendaraan terpercaya yang memberikan kemudahan, transparansi, dan kecepatan dalam proses kepemilikan mobil impian Anda.
                </p>
                <p class="text-muted lh-base">
                    Nikmati simulasi kredit yang akurat dengan skema angsuran fleksibel serta bunga kompetitif yang dapat disesuaikan dengan kebutuhan finansial Anda.
                </p>
            </div>
            <div class="col-md-6">
                <div class="rounded-3 overflow-hidden shadow style-img" style="height: 280px;">
                    <img src="asset/foto perusahaan.jfif" class="w-100 h-100 object-fit-cover" alt="Showroom Mobil">
                </div>
            </div>
        </section>

        <!--Kalkulator-->
        <section id="kalkulator" class="row justify-content-center my-5 pt-3">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="fw-bold text-navy mb-4 text-center">Input Data</h3>

                        <!--Tampilan Pesan-->
                        <?php if (!empty($pesan)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-exclamation me-2"></i><?= htmlspecialchars(urldecode($pesan)) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!--Untuk ke Prosesdata.php-->
                        <form action="prosesdata.php" method="POST">
                            
                            <!--Nama-->
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-bold">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= htmlspecialchars($nama) ?>">
                            </div>

                            <!--Email-->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="<?= htmlspecialchars($email) ?>">
                            </div>

                            <!--Harga Mobil-->
                            <div class="mb-3">
                                <label for="hargamobil" class="form-label fw-bold">Harga Mobil</label>
                                <input type="number" class="form-control" id="hargamobil" name="hargamobil" placeholder="Contoh: 300000000" value="<?= htmlspecialchars($hargamobil) ?>">
                            </div>

                            <!--Tenor-->
                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Tenor</label>
                                <div class="d-flex flex-column gap-2 ms-1">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tenor" id="tenor<?= $i ?>" value="<?= $i ?>" <?= $tenor == $i ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="tenor<?= $i ?>">
                                                <?= $i ?> Tahun
                                            </label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <!--DP-->
                            <div class="mb-4">
                                <label for="dp" class="form-label fw-bold">DP</label>
                                <select class="form-select" id="dp" name="dp">
                                    <?php 
                                    $dp_options = [10, 20, 30, 40, 50];
                                    foreach ($dp_options as $opt): 
                                    ?>
                                        <option value="<?= $opt ?>" <?= $dp == $opt ? 'selected' : '' ?>><?= $opt ?>%</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!--Hitung-->
                            <button type="submit" name="hitung" class="btn btn-hitung w-100 mt-2">Hitung</button>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </main>

    <!--Footer-->
    <footer id="kontak" class="footer">
        <div class="footer-content">
            <div class="footer-about">
                <h3>AutoFinance</h3>
                <p>Penyedia pembiayaan kendaraan terpercaya dengan proses cepat dan transparan.</p>
                <div class="social-icon">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Navigasi</h4>
                <a href="#">Beranda</a>
                <a href="#tentang-perusahaan">Tentang Kami</a>
                <a href="#kalkulator">Kalkulator</a>
            </div>
            <div class="footer-contact">
                <h4>Hubungi Kami</h4>
                <p><i class="fa-solid fa-location-dot"></i> Jl. Sudirman No. 123, Jakarta</p>
                <p><i class="fa-solid fa-phone"></i> (021) 555-0192</p>
                <p><i class="fa-solid fa-envelope"></i> info@autofinance.co.id</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 AutoFinance. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>