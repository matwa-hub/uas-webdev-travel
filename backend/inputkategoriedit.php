<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>

<?php include "include/head.php";?>
    <body class="sb-nav-fixed">
        <?php include "include/menunav.php";?>

        <div id="layoutSidenav">
        <?php include "include/menu.php";?>    
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
 
<?php
// Memanggil koneksi ke MySQL
include("include/config.php");
 
// Menerima data yang akan diubah
$kategori_ID = $_GET["ubahkategori"];
$edit = mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_ID = '$kategori_ID'");
$row_edit = mysqli_fetch_array($edit);
 
// Memeriksa apakah tombol 'Ubah' diklik
if (isset($_POST['Ubah'])) {
    $kategori_ID = $_POST['kategori_ID'];
    $kategori_NAMA = $_POST['kategori_NAMA'];
    $Kategori_Ket = $_POST['Kategori_Ket'];
 
    $namafoto = $_FILES['fotokategori']['name'];
    $file_tmp = $_FILES['fotokategori']['tmp_name'];
    $file_size = $_FILES['fotokategori']['size']; // diperbaiki dari 'fotoprovinsi' ke 'fotokategori'
    $max_size = 2 * 1024 * 1024; // 2MB dalam byte
 
    // Memeriksa apakah foto baru diunggah
    if ($namafoto != "") {
        if ($file_size <= $max_size) {
            move_uploaded_file($file_tmp, 'images/' . $namafoto);
            // Query dengan foto baru
            $query = "UPDATE kategori SET
                      kategori_NAMA = '$kategori_NAMA',
                      Kategori_Ket = '$Kategori_Ket',  
                      Kategori_Foto = '$namafoto'
                      WHERE kategori_ID = '$kategori_ID'";
        } else {
            echo "<script>alert('Ukuran file terlalu besar. Maksimal 2MB.');</script>";
        }
    } else {
        // Query tanpa mengubah foto
        $query = "UPDATE kategori SET
                  kategori_NAMA = '$kategori_NAMA',
                  Kategori_Ket = '$Kategori_Ket'
                  WHERE kategori_ID = '$kategori_ID'";
    }
   
    // Menjalankan query
    if (isset($query) && mysqli_query($conn, $query)) {
        header("location:inputkategori.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
 
// Fungsi Pencarian
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM kategori
        WHERE kategori_NAMA LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM kategori");
}
?>
 
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Kategori</title>
 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
 
<!-- Form input data kategori -->
<div class="row">
<div class="col-1"></div>
<div class="col-10">
 
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5">Input Kategori</h1>
    <p class="lead">Berikut adalah Tampilan Data Kategori</p>
  </div>
</div>
 
<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="kategori_ID" class="col-sm-2 col-form-label">Kode Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kategori_ID" name="kategori_ID" value="<?php echo $row_edit["kategori_ID"] ?>"readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label for="kategori_NAMA" class="col-sm-2 col-form-label">Nama Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kategori_NAMA" name="kategori_NAMA" value="<?php echo $row_edit["kategori_NAMA"] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="Kategori_Ket" class="col-sm-2 col-form-label">Keterangan Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Kategori_Ket" name="Kategori_Ket" value="<?php echo $row_edit["kategori_KET"] ?>">
    </div>
  </div>
 
  <!-- input-file -->
  <div class="form-group row mb-3">
    <label for="file" class="col-sm-2 col-form-label">Foto Kategori</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="file" name="fotokategori">
        <p class="help-block">Unggah Foto Kategori</p>
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
</main>
                <?php include "include/footer.php";?>
            </div>
        </div>
        <?php include "include/jsscript.php";?>
</div>
<div class="col-1"></div>
</div>
</body>
<?php
// Mengakhiri output buffering
ob_end_flush();
?>
</html>

 
 