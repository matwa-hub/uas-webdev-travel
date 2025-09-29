<?php
if (!defined('aktif')) {
    die('Anda tidak bisa mengakses langsung file ini');
} else {
    // Memanggil koneksi database
    include("../admin/includes/config.php");

    // Query untuk mengambil data dari tabel-tabel
    $query_booking = mysqli_query($conn, "SELECT booking_ID, booking_NAMA, booking_DESKRIPSI, booking_TGL FROM bookingmenu LIMIT 1");
    $query_destinasi = mysqli_query($conn, "SELECT * FROM destinasi LIMIT 1");
    $query_kabupaten = mysqli_query($conn, "SELECT kabupaten_NAMA FROM kabupaten LIMIT 1");
    $query_kategori = mysqli_query($conn, "SELECT kategori_NAMA FROM kategori LIMIT 1");
    $query_kecamatan = mysqli_query($conn, "SELECT kecamatan_NAMA FROM kecamatan LIMIT 1");
    $query_testimoni = mysqli_query($conn, "SELECT testimoni_JUDUL, testimoni_ISI, testimoni_NAMA FROM testimoni LIMIT 1");

    // Ambil data
    $booking = mysqli_fetch_assoc($query_booking);
    $destinasi = mysqli_fetch_assoc($query_destinasi);
    $kabupaten = mysqli_fetch_assoc($query_kabupaten);
    $kategori = mysqli_fetch_assoc($query_kategori);
    $kecamatan = mysqli_fetch_assoc($query_kecamatan);
    $testimoni = mysqli_fetch_assoc($query_testimoni);
    ?>
    <section id="booking">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="mb-4 text-start">
                        <h5 class="text-secondary">Easy and Fast</h5>
                        <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">
                            <?= $booking['booking_NAMA']; ?>
                        </h3>
                    </div>
                    <div class="d-flex align-items-start mb-5">
                        <div class="bg-primary me-sm-4 me-3 p-3" style="border-radius: 13px">
                            <img src="assets/img/steps/selection.svg" width="22" alt="steps" />
                        </div>
                        <div class="flex-1">
                            <h5 class="text-secondary fw-bold fs-0">Deskripsi Booking</h5>
                            <p><?= $booking['booking_DESKRIPSI']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-5">
                        <div class="bg-danger me-sm-4 me-3 p-3" style="border-radius: 13px">
                            <img src="assets/img/steps/water-sport.svg" width="22" alt="steps" />
                        </div>
                        <div class="flex-1">
                            <h5 class="text-secondary fw-bold fs-0">Kategori</h5>
                            <p>Kategori: <?= $kategori['kategori_NAMA']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-5">
                        <div class="bg-info me-sm-4 me-3 p-3" style="border-radius: 13px">
                            <img src="assets/img/steps/taxi.svg" width="22" alt="steps" />
                        </div>
                        <div class="flex-1">
                            <h5 class="text-secondary fw-bold fs-0">Lokasi</h5>
                            <p>Kecamatan: <?= $kecamatan['kecamatan_NAMA']; ?>, Kabupaten: <?= $kabupaten['kabupaten_NAMA']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-center align-items-start">
                    <div class="card position-relative shadow" style="max-width: 370px;">
                        <div class="position-absolute z-index--1 me-10 me-xxl-0" style="right:-160px;top:-210px;">
                            <img src="assets/img/steps/bg.png" style="max-width:550px;" alt="shape" />
                        </div>
                        <div class="card-body p-3">
                            <img class="mb-4 mt-2 rounded-2 w-100" src="images/<?= $destinasi['foto_destinasi']; ?>" alt="booking" />
                            <div>
                                <h5 class="fw-medium"><?= $destinasi['destinasi_NAMA']; ?></h5>
                                <p class="fs--1 mb-3 fw-medium">Trip: <?= $destinasi['destinasi_KET']; ?></p>
                                <div class="icon-group mb-4">
                                    <span class="btn icon-item"> <img src="assets/img/steps/leaf.svg" alt="" /></span>
                                    <span class="btn icon-item"> <img src="assets/img/steps/map.svg" alt="" /></span>
                                    <span class="btn icon-item"> <img src="assets/img/steps/send.svg" alt="" /></span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center mt-n1">
                                        <img class="me-3" src="assets/img/steps/building.svg" width="18" alt="building" />
                                        <span class="fs--1 fw-medium">Testimoni: <?= $testimoni['testimoni_JUDUL']; ?></span>
                                    </div>
                                    <div class="show-onhover position-relative">
                                        <button class="btn">
                                            <img src="assets/img/steps/heart.svg" width="20" alt="step" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section>
<?php } ?>
