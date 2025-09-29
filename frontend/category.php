<section class="pt-5 pt-md-9" id="service">
    <?php
    // Memanggil koneksi ke MySQL
    include("../admin/includes/config.php");

    // Ambil satu kategori secara acak
    $query_kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY RAND() LIMIT 1");
    if (!$query_kategori) {
        die("Error pada query kategori: " . mysqli_error($conn));
    }

    $kategori = mysqli_fetch_assoc($query_kategori);
    $id_kategori = $kategori['kategori_ID']; // ID kategori
    $nama_kategori = $kategori['kategori_NAMA']; // Nama kategori

    // Pastikan kategori_ID aman untuk query
    $id_kategori_safe = is_numeric($id_kategori) ? $id_kategori : "'" . mysqli_real_escape_string($conn, $id_kategori) . "'";

    // Ambil semua destinasi berdasarkan kategori terpilih
    $query_destinasi = mysqli_query($conn, "SELECT * FROM destinasi WHERE kategori_ID = $id_kategori_safe");
    if (!$query_destinasi) {
        die("Error pada query destinasi: " . mysqli_error($conn));
    }
    ?>

    <div class="container">
        <!-- Header Kategori -->
        <div class="position-absolute z-index--1 end-0 d-none d-lg-block">
            <img src="assets/img/category/shape.svg" style="max-width: 200px" alt="service" />
        </div>
        <div class="mb-7 text-center">
            <h5 class="text-secondary">CATEGORY</h5>
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">
                <?= $nama_kategori; ?>
            </h3>
        </div>

        <!-- Daftar Destinasi -->
        <div class="row">
            <?php
            if (mysqli_num_rows($query_destinasi) > 0) {
                while ($destinasi = mysqli_fetch_assoc($query_destinasi)) {
                    ?>
                    <div class="col-lg-3 col-sm-6 mb-6">
                        <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                            <div class="card-body p-xxl-5 p-4">
                                <img src="images/<?= $destinasi['foto_destinasi']; ?>" width="75" alt="<?= $destinasi['destinasi_NAMA']; ?>" />
                                <h4 class="mb-3"><?= $destinasi['destinasi_NAMA']; ?></h4>
                                <p class="mb-0 fw-medium">Trip: <?= $destinasi['destinasi_KET']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>Tidak ada destinasi untuk kategori ini.</p>";
            }
            ?>
        </div>
    </div><!-- end of .container-->
</section>
