<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>

<?php
/** Memanggil koneksi ke MySQL **/
include("include/config.php");
 
// Proses penghapusan data
if (isset($_GET['hapuskategori'])) {
    $Kategori_ID = $_GET["hapuskategori"];
    mysqli_query($conn, "DELETE FROM kategori WHERE Kategori_ID = '$Kategori_ID'");
    echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='inputkategori.php'</script>";
}
 
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
if (isset($_POST['Simpan'])) {
  $Kategori_ID = $_POST['Kategori_ID'];
  $Kategori_NAMA = $_POST['Kategori_NAMA'];
  $Kategori_Ket = $_POST['Kategori_Ket'];
 
  $namafoto = $_FILES['fotokategori']['name'];
  $file_tmp = $_FILES['fotokategori']['tmp_name'];
  move_uploaded_file($file_tmp, 'images/' . $namafoto);
 
  mysqli_query($conn, "INSERT INTO kategori VALUES('$Kategori_ID', '$Kategori_NAMA', '$Kategori_Ket', '$namafoto')");
  header("Location: inputkategori.php");
  exit;
}
 
/**--pencarian-data--**/
$search = ""; // Variabel untuk menyimpan pencarian
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM kategori
    WHERE Kategori_ID LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'
    OR Kategori_NAMA LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM kategori");
}
/**--end-pencarian-data--**/
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
    <label for="beritaID" class="col-sm-2 col-form-label">Kode Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Kategori_ID" name="Kategori_ID" placeholder="Kode Kategori">
    </div>
  </div>
  <div class="row mb-3">
    <label for="beritaJUDUL" class="col-sm-2 col-form-label">Nama Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Kategori_NAMA" name="Kategori_NAMA" placeholder="Nama Kategori">
    </div>
  </div>
  <div class="row mb-3">
    <label for="beritaKET" class="col-sm-2 col-form-label">Keterangan Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Kategori_Ket" name="Kategori_Ket" placeholder="Keterangan Kategori">
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
        <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
        <input type="reset" class="btn btn-danger" value="Batal">
    </div>
  </div>    
 
</form>
 
<div class="jumbotron jumbotron-fluid mt-5">
  <div class="container">
    <h1 class="display-5">Output Kategori</h1>
  </div>
</div>
 
 <!-- Form Pencarian Data -->
 <form method="POST" class="mt-5">
        <div class="form-group row">
          <label for="search" class="col-sm-2">Cari Judul Kategori</label>
          <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search"
              value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari Nama Kategori">
          </div>
          <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
        </div>
      </form>
 
 
<table class="table table-striped table-success table-hover mt-5">
    <tr class="info">
        <th>Kode Kategori</th>
        <th>Nama Kategori</th>
        <th>Keterangan Kategori</th>
        <th>Foto Kategori</th>
        <th colspan="2">Aksi</th>
    </tr>
 
 
    <?php while ($row = mysqli_fetch_array($query)) { ?>
          <tr class="danger">
            <td><?php echo $row['Kategori_ID']; ?></td>
            <td><?php echo $row['Kategori_NAMA']; ?></td>
            <td><?php echo $row['Kategori_Ket']; ?></td>
            <td>
              <?php if ($row['Kategori_Foto'] == "") { ?>
                <img src="images/noimage.png" width="88"/>
              <?php } else { ?>
                <img src="images/<?php echo $row['Kategori_Foto']; ?>" width="88"/>
              <?php } ?>
            </td>
            <td>
              <a href="kategori_edit.php?ubahkategori=<?php echo $row["Kategori_ID"]?>" class="btn btn-success btn-sm" title="EDIT">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>
            </td>
            <td>
              <a href="kategori_hapus.php?hapuskategori=<?php echo $row["Kategori_ID"]?>" class="btn btn-danger btn-sm" title="HAPUS">
              <i class="bi bi-trash3"></i>
            </td>
          </tr>
        <?php } ?>
</table>
 
</div>
<div class="col-1"></div>
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
 
</body>
</html>
 
 