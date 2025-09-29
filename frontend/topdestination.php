<?php
if (!defined('aktif')) {
    die('anda tidak bisa akses langsung file ini');
} else {
    // Memanggil koneksi ke-MySQL
    include("../admin/includes/config.php");
 
    // Query untuk mendapatkan data dari tabel kategori, kabupaten, dan destinasi
    $query = mysqli_query($conn, "SELECT * FROM kecamatan, destinasi
                                   WHERE kecamatan.kecamatan_KODE = destinasi.kecamatan_KODE");
?>
 
<section class="pt-5" id="destination">
    <div class="container">
        <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4">
            <img src="assets/img/dest/shape.svg" alt="destination" />
        </div>
        <div class="mb-7 text-center">
            <h5 class="text-secondary">Top Selling</h5>
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Top Destinations</h3>
        </div>
        <div class="row">
            <?php if (mysqli_num_rows($query) > 0) { ?>
                <?php while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card overflow-hidden shadow">
                            <img class="card-img-top" src="images/<?php echo $row['foto_destinasi']; ?>"
                                alt="Tidak ada foto"
                                style="height: 275px; width: 100%; object-fit: cover;" />
                            <div class="card-body py-4 px-3">
                                <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                                    <h4 class="text-secondary fw-medium">
                                        <a class="link-900 text-decoration-none stretched-link" href="#!">
                                            <?php echo $row['destinasi_NAMA']; ?>
                                        </a>
                                    </h4>
                                    <span class="fs-1 fw-medium"><?php echo $row['kecamatan_NAMA']; ?></span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="assets/img/dest/navigation.svg" style="margin-right: 14px" width="20" alt="navigation" />
                                    <span class="fs-0 fw-medium"><?php echo $row['destinasi_ALAMAT']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div><!-- end of .row -->
    </div><!-- end of .container -->
</section>
<?php } ?>
 
 