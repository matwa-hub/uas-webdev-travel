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
// Memanggil koneksi ke database
include("include/config.php");

// Mengecek apakah tombol simpan diklik
if (isset($_POST['Simpan'])) {
    $kategori_ID = $_POST['kategori_ID'];
    $kategori_NAMA = $_POST['kategori_NAMA'];
    $kategori_KET = $_POST['kategori_KET'];
    $namafoto = $_FILES['fotokategori']['name'];
    $file_tmp = $_FILES['fotokategori']['tmp_name'];
    $file_size = $_FILES['fotokategori']['size'];

    // Validasi ukuran file
    if ($file_size > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran file foto tidak boleh lebih dari 2 MB!');</script>";
    } else {
        // Proses upload foto
        move_uploaded_file($file_tmp, 'includes/images/' . $namafoto);

        // Menyimpan data ke database
        mysqli_query($conn, "INSERT INTO kategori VALUES('$kategori_ID', '$kategori_NAMA', '$kategori_KET', '$namafoto')");

        // Redirect ke halaman yang sama setelah menyimpan data
        header("location:inputkategori.php");
        exit;
    }
}

// Fungsi Pencarian Data
$search = ""; // Variabel pencarian
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM kategori
        WHERE kategori_ID LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'
        OR kategori_NAMA LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM kategori");
}
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
    <h1 class="display-5">Input Kategori</h1>
    <p class="lead">Berikut adalah Tampilan Data Kategori</p>
  </div>
</div>

<!-- Form input data kategori -->
<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="kategori_ID" class="col-sm-2 col-form-label">Kode Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kategori_ID" name="kategori_ID" placeholder="Kode Kategori" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="kategori_NAMA" class="col-sm-2 col-form-label">Nama Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kategori_NAMA" name="kategori_NAMA" placeholder="Nama Kategori" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="kategori_KET" class="col-sm-2 col-form-label">Keterangan Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kategori_KET" name="kategori_KET" placeholder="Keterangan Kategori" required>
    </div>
  </div>

  <!-- input-file -->
  <div class="form-group row mb-3">
    <label for="fotokategori" class="col-sm-2 col-form-label">Foto Kategori</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="fotokategori" name="fotokategori" >
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
        <label for="search" class="col-sm-2">Cari Nama Kategori</label>
        <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search"
                value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari Nama Kategori">
        </div>
        <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
    </div>
</form>

<!-- Tabel Kategori -->
<table class="table table-striped table-success table-hover mt-5">
    <tr>
        <th>Kode Kategori</th>
        <th>Nama Kategori</th>
        <th>Keterangan Kategori</th>
        <th>Foto Kategori</th>
        <th colspan="2">Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?php echo $row['kategori_ID']; ?></td>
            <td><?php echo $row['kategori_NAMA']; ?></td>
            <td><?php echo $row['kategori_KET']; ?></td>
            <td>
                <?php if (empty($row['foto_kategori'])) { ?>
                    <img src="images/noimage.png" width="88" alt="No Image">
                <?php } else { ?>
                    <img src="images/<?php echo $row['foto_kategori']; ?>" width="88" alt="Foto Kategori">
                <?php } ?>
            </td>
            <td>
              <a href="inputkategoriedit.php?ubahkategori=<?php echo $row["kategori_ID"]; ?>" class="btn btn-success btn-sm" title="EDIT">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
              </svg>
            </td>
            <td>
              <a href="inputkategorihapus.php?hapuskategori=<?php echo $row["kategori_ID"]; ?>" class="btn btn-danger btn-sm" title="HAPUS">
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