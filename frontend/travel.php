<?php
// Memanggil koneksi database
include("../admin/includes/config.php");

// Query untuk mendapatkan data dari tabel travel_experiences
$query = mysqli_query($conn, "SELECT * FROM travel");

// Ambil data baris pertama (karena hanya menampilkan 1 record untuk UI ini)
$row = mysqli_fetch_assoc($query);
?>

<?php if (!defined('aktif')) { die('Anda tidak bisa mengakses langsung file ini'); } else { ?>
<section style="padding-top: 7rem;">
    <div class="bg-holder" style="background-image:url(assets/img/hero/hero-bg.svg);">
    </div>
    <!--/.bg-holder-->

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end">
                <!-- Menampilkan gambar dari travel_FOTO -->
                <img class="pt-7 pt-md-0 hero-img" src="<?php echo $row['travel_FOTO']; ?>" alt="hero-header" />
            </div>
            <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
                <!-- Menampilkan travel_JUDUL -->
                <h4 class="fw-bold text-danger mb-3"><?php echo $row['travel_JUDUL']; ?></h4>
                <!-- Menampilkan travel_SUBJUDUL -->
                <h1 class="hero-title"><?php echo $row['travel_SUBJUDUL']; ?></h1>
                <!-- Menampilkan travel_KETERANGAN -->
                <p class="mb-4 fw-medium"><?php echo nl2br($row['travel_KETERANGAN']); ?></p>
                <div class="text-center text-md-start">
                    <a class="btn btn-primary btn-lg me-md-4 mb-3 mb-md-0 border-0 primary-btn-shadow" href="#!" role="button">Find out more</a>
                    <div class="w-100 d-block d-md-none"></div>
                    <a href="#!" role="button" data-bs-toggle="modal" data-bs-target="#popupVideo">
                        <span class="btn btn-danger round-btn-lg rounded-circle me-3 danger-btn-shadow">
                            <img src="assets/img/hero/play.svg" width="15" alt="play" />
                        </span>
                    </a>
                    <span class="fw-medium">Play Demo</span>
                    <!-- Modal untuk video -->
                    <div class="modal fade" id="popupVideo" tabindex="-1" aria-labelledby="popupVideo" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Menampilkan travel_LINKVID -->
                                <iframe class="rounded" style="width:100%;max-height:500px;" height="500px" src="<?php echo $row['travel_LINKVID']; ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
