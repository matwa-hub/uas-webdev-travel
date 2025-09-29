<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}

// Memanggil koneksi ke MySQL
include("include/config.php");

// Menerima data yang akan diubah
$testimoni_ID = $_GET["ubahtestimoni"];
$edit = mysqli_query($conn, "SELECT * FROM testimoni WHERE testimoni_ID = '$testimoni_ID'");
$row_edit = mysqli_fetch_array($edit);

// Memeriksa apakah tombol 'Ubah' diklik
if (isset($_POST['Ubah'])) {
    $testimoni_JUDUL = $_POST['testimoni_JUDUL'];
    $testimoni_ISI = $_POST['testimoni_ISI'];
    $testimoni_NAMA = $_POST['testimoni_NAMA'];
    $testimoni_KOTA = $_POST['testimoni_KOTA'];

    $namafoto = $_FILES['testimoni_FOTO']['name'];
    $file_tmp = $_FILES['testimoni_FOTO']['tmp_name'];
    $file_size = $_FILES['testimoni_FOTO']['size'];
    $max_size = 2 * 1024 * 1024; // 2MB dalam byte
    $upload_dir = 'images/';

    // Memeriksa apakah foto baru diunggah dan ukuran sesuai
    if ($namafoto != "") {
        if ($file_size <= $max_size) {
            $new_file_name = uniqid() . "_" . $namafoto;
            move_uploaded_file($file_tmp, $upload_dir . $new_file_name);

            // Query dengan foto baru
            $query = "UPDATE testimoni SET
                      testimoni_JUDUL = '$testimoni_JUDUL',
                      testimoni_ISI = '$testimoni_ISI',
                      testimoni_NAMA = '$testimoni_NAMA',
                      testimoni_KOTA = '$testimoni_KOTA',
                      testimoni_FOTO = '$new_file_name'
                      WHERE testimoni_ID = '$testimoni_ID'";
        } else {
            echo "<script>alert('Error: File size must be less than 2MB.');</script>";
        }
    } else {
        // Query tanpa mengubah foto
        $query = "UPDATE testimoni SET
                  testimoni_JUDUL = '$testimoni_JUDUL',
                  testimoni_ISI = '$testimoni_ISI',
                  testimoni_NAMA = '$testimoni_NAMA',
                  testimoni_KOTA = '$testimoni_KOTA'
                  WHERE testimoni_ID = '$testimoni_ID'";
    }

    if (isset($query) && mysqli_query($conn, $query)) {
        header("Location: testimoni.php");
        exit; // Menghentikan eksekusi setelah header() dipanggil
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<?php include "include/head.php"; ?>
<body class="sb-nav-fixed">
    <?php include "include/menunav.php"; ?>
    <div id="layoutSidenav">
        <?php include "include/menu.php"; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1 class="display-5">Update Testimoni</h1>
                                    <p class="lead">Berikut adalah Tampilan Data Testimoni</p>
                                </div>
                            </div>

                            <form method="POST" enctype="multipart/form-data">
                                <div class="row mb-3 mt-5">
                                    <label for="testimoni_JUDUL" class="col-sm-2 col-form-label">Judul Testimoni</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="testimoni_JUDUL" name="testimoni_JUDUL" value="<?php echo $row_edit['testimoni_JUDUL']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="testimoni_ISI" class="col-sm-2 col-form-label">Isi Testimoni</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="testimoni_ISI" name="testimoni_ISI"><?php echo $row_edit['testimoni_ISI']; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="testimoni_NAMA" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="testimoni_NAMA" name="testimoni_NAMA" value="<?php echo $row_edit['testimoni_NAMA']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="testimoni_KOTA" class="col-sm-2 col-form-label">Kota</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="testimoni_KOTA" name="testimoni_KOTA" value="<?php echo $row_edit['testimoni_KOTA']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="testimoni_FOTO" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="testimoni_FOTO" name="testimoni_FOTO">
                                        <p class="help-block">Unggah Foto Testimoni</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn btn-success" value="Update" name="Ubah">
                                        <input type="reset" class="btn btn-danger" value="Batal">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "include/footer.php"; ?>
        </div>
    </div>
    <?php include "include/jsscript.php"; ?>
</body>
</html>
<?php 
ob_end_flush(); 
?>