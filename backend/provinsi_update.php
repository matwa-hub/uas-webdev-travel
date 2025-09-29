<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}


// Memanggil koneksi ke MySQL
include("include/config.php");

// Menerima data yang akan diubah
$provinsi_KODE = $_GET["ubahprovinsi"];
$edit = mysqli_query($conn, "SELECT * FROM provinsi WHERE provinsi_KODE = '$provinsi_KODE'");
$row_edit = mysqli_fetch_array($edit);

// Memeriksa apakah tombol 'Ubah' diklik
if (isset($_POST['Ubah'])) {
    $provinsi_KODE = $_POST['provinsi_KODE'];
    $provinsi_NAMA = $_POST['provinsi_NAMA'];

    $namafoto = $_FILES['fotoprovinsi']['name'];
    $file_tmp = $_FILES['fotoprovinsi']['tmp_name'];
    $file_size = $_FILES['fotoprovinsi']['size'];
    $max_size = 2 * 1024 * 1024; // 2MB dalam byte
    $upload_dir = 'images/';

    // Memeriksa apakah foto baru diunggah dan ukuran sesuai
    if ($namafoto != "") {
        if ($file_size <= $max_size) {
            $new_file_name = uniqid() . "_" . $namafoto;
            move_uploaded_file($file_tmp, $upload_dir . $new_file_name);

            // Query dengan foto baru
            $query = "UPDATE provinsi SET
                      provinsi_NAMA = '$provinsi_NAMA',
                      foto_provinsi = '$new_file_name'
                      WHERE provinsi_KODE = '$provinsi_KODE'";
        } else {
            echo "<script>alert('Error: File size must be less than 2MB.');</script>";
        }
    } else {
        // Query tanpa mengubah foto
        $query = "UPDATE provinsi SET
                  provinsi_NAMA = '$provinsi_NAMA'
                  WHERE provinsi_KODE = '$provinsi_KODE'";
    }

    if (isset($query) && mysqli_query($conn, $query)) {
        header("Location: provinsi.php");
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
                                    <h1 class="display-5">Update Provinsi</h1>
                                    <p class="lead">Berikut adalah Tampilan Data Provinsi</p>
                                </div>
                            </div>

                            <form method="POST" enctype="multipart/form-data">
                                <div class="row mb-3 mt-5">
                                    <label for="provinsi_KODE" class="col-sm-2 col-form-label">Kode Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="provinsi_KODE" name="provinsi_KODE" value="<?php echo $row_edit['provinsi_KODE']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="provinsi_NAMA" class="col-sm-2 col-form-label">Nama Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="provinsi_NAMA" name="provinsi_NAMA" value="<?php echo $row_edit['provinsi_NAMA']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="file" class="col-sm-2 col-form-label">Foto Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="file" name="fotoprovinsi">
                                        <p class="help-block">Unggah Foto Provinsi</p>
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
<?php ob_end_flush(); ?>
