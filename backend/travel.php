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
include("include/config.php");

if (isset($_POST['Simpan'])) {
    $travel_ID = $_POST['travel_ID'];
    $travel_JUDUL = $_POST['travel_JUDUL'];
    $travel_SUBJUDUL = $_POST['travel_SUBJUDUL'];
    $travel_KETERANGAN = $_POST['travel_KETERANGAN'];
    $travel_LINKVID = $_POST['travel_LINKVID'];
    $namafoto = $_FILES['travel_FOTO']['name'];
    $file_tmp = $_FILES['travel_FOTO']['tmp_name'];
    $file_size = $_FILES['travel_FOTO']['size'];

    if ($file_size > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran file foto tidak boleh lebih dari 2 MB!');</script>";
    } else {
        move_uploaded_file($file_tmp, 'includes/images/' . $namafoto);
        mysqli_query($conn, "INSERT INTO travel VALUES('$travel_ID', '$travel_JUDUL', '$travel_SUBJUDUL', '$travel_KETERANGAN', '$travel_LINKVID', '$namafoto')");
        header("location:travel.php");
        exit;
    }
}

$search = "";
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM travel
        WHERE travel_ID LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'
        OR travel_JUDUL LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM travel");
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Travel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>

<div class="row">
<div class="col-1"></div>
<div class="col-10">

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5">Input Travel</h1>
    <p class="lead">Berikut adalah Tampilan Data Travel</p>
  </div>
</div>

<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="travel_ID" class="col-sm-2 col-form-label">ID Travel</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="travel_ID" name="travel_ID" placeholder="ID Travel" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="travel_JUDUL" class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="travel_JUDUL" name="travel_JUDUL" placeholder="Judul Travel" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="travel_SUBJUDUL" class="col-sm-2 col-form-label">Subjudul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="travel_SUBJUDUL" name="travel_SUBJUDUL" placeholder="Subjudul Travel" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="travel_KETERANGAN" class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="travel_KETERANGAN" name="travel_KETERANGAN" placeholder="Keterangan Travel" required></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label for="travel_LINKVID" class="col-sm-2 col-form-label">Link Video</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="travel_LINKVID" name="travel_LINKVID" placeholder="Link Video" required>
    </div>
  </div>

  <div class="form-group row mb-3">
    <label for="travel_FOTO" class="col-sm-2 col-form-label">Foto Travel</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="travel_FOTO" name="travel_FOTO" >
        <p class="help-block">Unggah Foto Travel</p>
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

<!-- Tabel Travel -->
<table class="table table-striped table-success table-hover mt-5">
    <tr>
        <th>ID Travel</th>
        <th>Judul</th>
        <th>Subjudul</th>
        <th>Keterangan</th>
        <th>Link Video</th>
        <th>Foto</th>
        <th colspan="2">Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?php echo $row['travel_ID']; ?></td>
            <td><?php echo $row['travel_JUDUL']; ?></td>
            <td><?php echo $row['travel_SUBJUDUL']; ?></td>
            <td><?php echo $row['travel_KETERANGAN']; ?></td>
            <td><?php echo $row['travel_LINKVID']; ?></td>
            <td>
                <?php if (empty($row['travel_FOTO'])) { ?>
                    <img src="images/noimage.png" width="88" alt="No Image">
                <?php } else { ?>
                    <img src="images/<?php echo $row['travel_FOTO']; ?>" width="88" alt="Foto Travel">
                <?php } ?>
            </td>
            <td>
              <a href="travel_update.php?ubahtravel=<?php echo $row["travel_ID"]; ?>" class="btn btn-success btn-sm" title="EDIT">
              <i class="bi bi-pencil-square"></i>
            </td>
            <td>
              <a href="travel_hapus.php?hapustravel=<?php echo $row["travel_ID"]; ?>" class="btn btn-danger btn-sm" title="HAPUS">
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
<?php ob_end_flush(); ?>
</html>