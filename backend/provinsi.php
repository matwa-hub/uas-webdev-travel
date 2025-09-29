<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>

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

<?php
/** Memanggil koneksi ke MySQL **/
include("include/config.php");

/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
if (isset($_POST['Simpan'])) {
  $provinsi_KODE = $_POST['provinsi_KODE'];
  $provinsi_NAMA = $_POST['provinsi_NAMA'];
 
  $namafoto = $_FILES['fotoprovinsi']['name'];
  $file_tmp = $_FILES['fotoprovinsi']['tmp_name'];
  $file_size = $_FILES['fotoprovinsi']['size'];
   
  // Validasi ukuran file (maksimal 2MB)
  if ($file_size > 2 * 1024 * 1024) {
      echo "<script>alert('Ukuran file foto tidak boleh lebih dari 2 MB!');</script>";
  } else {
 
  move_uploaded_file($file_tmp, 'images/' . $namafoto);
 
  mysqli_query($conn, "INSERT INTO provinsi VALUES('$provinsi_KODE', '$provinsi_NAMA', '$namafoto')");
  header("Location: provinsi.php");
  exit;
}
}
 
/**--pencarian-data--**/
$search = ""; // Variabel untuk menyimpan pencarian
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM provinsi
    WHERE provinsi_KODE LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'
    OR provinsi_NAMA LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM provinsi");
}
/**--end-pencarian-data--**/
?>
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Provinsi</title>
 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>
 
<!-- Form input data kategori -->
<div class="row">
<div class="col-1"></div>
<div class="col-10">
 
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5">Input Provinsi</h1>
    <p class="lead">Berikut adalah Tampilan Data Provinsi</p>
  </div>
</div>
 
<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="beritaID" class="col-sm-2 col-form-label">Kode Provinsi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="provinsi_KODE" name="provinsi_KODE" placeholder="Kode Provinsi">
    </div>
  </div>
  <div class="row mb-3">
    <label for="beritaJUDUL" class="col-sm-2 col-form-label">Nama Provinsi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="provinsi_NAMA" name="provinsi_NAMA" placeholder="Nama Provinsi">
    </div>
  </div>
 
  <!-- input-file -->
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
        <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
        <input type="reset" class="btn btn-danger" value="Batal">
    </div>
  </div>    
 
</form>
 
<div class="jumbotron jumbotron-fluid mt-5">
  <div class="container">
    <h1 class="display-5">Output Provinsi</h1>
  </div>
</div>
 
 <!-- Form Pencarian Data -->
 <form method="POST" class="mt-5">
        <div class="form-group row">
          <label for="search" class="col-sm-2">Cari Nama Provinsi</label>
          <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search"
              value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari Nama Provinsi">
          </div>
          <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
        </div>
      </form>
 
 
<table class="table table-striped table-success table-hover mt-5">
    <tr class="info">
        <th>Kode Provinsi</th>
        <th>Nama Provinsi</th>
        <th>Foto Provinsi</th>
        <th colspan="2">Aksi</th>
    </tr>
 
 
    <?php while ($row = mysqli_fetch_array($query)) { ?>
          <tr class="danger">
            <td><?php echo $row['provinsi_KODE']; ?></td>
            <td><?php echo $row['provinsi_NAMA']; ?></td>
            <td>
              <?php if ($row['foto_provinsi'] == "") { ?>
                <img src="images/noimage.png" width="88"/>
              <?php } else { ?>
                <img src="images/<?php echo $row['foto_provinsi']; ?>" width="88"/>
              <?php } ?>
            </td>
            <td>
              <a href="provinsi_update.php?ubahprovinsi=<?php echo $row["provinsi_KODE"]?>" class="btn btn-success btn-sm" title="EDIT">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
              </svg>
            </td>
            <td>
              <a href="provinsi_hapus.php?hapusprovinsi=<?php echo $row["provinsi_KODE"]?>" class="btn btn-danger btn-sm" title="HAPUS">
              <i class="bi bi-trash3"></i>
            </td>
          </tr>
        <?php } ?>
</table>
 
</div>
<div class="col-1"></div>
</div>
</main>
                <?php include "include/footer.php"; ?>
            </div>
        </div>
        <?php include "include/jsscript.php"; ?>
        </body> 
<?php
// Mengakhiri output buffering
ob_end_flush();
?>
</html>
 