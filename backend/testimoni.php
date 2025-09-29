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
    $testimoni_JUDUL = $_POST['testimoni_JUDUL'];
    $testimoni_ISI = $_POST['testimoni_ISI'];
    $testimoni_NAMA = $_POST['testimoni_NAMA'];
    $testimoni_KOTA = $_POST['testimoni_KOTA'];

    $namafoto = $_FILES['testimoni_FOTO']['name'];
    $file_tmp = $_FILES['testimoni_FOTO']['tmp_name'];
    $file_size = $_FILES['testimoni_FOTO']['size'];
    
    if ($file_size > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran file foto tidak boleh lebih dari 2 MB!');</script>";
    } else {
        move_uploaded_file($file_tmp, 'images/' . $namafoto);
        mysqli_query($conn, "INSERT INTO testimoni (testimoni_JUDUL, testimoni_FOTO, testimoni_ISI, testimoni_NAMA, testimoni_KOTA) 
                             VALUES('$testimoni_JUDUL', '$namafoto', '$testimoni_ISI', '$testimoni_NAMA', '$testimoni_KOTA')");
        header("Location: testimoni.php");
        exit;
    }
}

$search = "";
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM testimoni
    WHERE testimoni_JUDUL LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'
    OR testimoni_NAMA LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM testimoni");
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

<div class="row">
<div class="col-1"></div>
<div class="col-10">

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5">Input Testimoni</h1>
    <p class="lead">Berikut adalah Tampilan Data Testimoni</p>
  </div>
</div>

<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="testimoni_JUDUL" class="col-sm-2 col-form-label">Judul Testimoni</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="testimoni_JUDUL" name="testimoni_JUDUL" placeholder="Judul Testimoni">
    </div>
  </div>
  <div class="row mb-3">
    <label for="testimoni_ISI" class="col-sm-2 col-form-label">Isi Testimoni</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="testimoni_ISI" name="testimoni_ISI" rows="3" placeholder="Isi Testimoni"></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label for="testimoni_NAMA" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="testimoni_NAMA" name="testimoni_NAMA" placeholder="Nama">
    </div>
  </div>
  <div class="row mb-3">
    <label for="testimoni_KOTA" class="col-sm-2 col-form-label">Kota</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="testimoni_KOTA" name="testimoni_KOTA" placeholder="Kota">
    </div>
  </div>

  <div class="form-group row mb-3">
    <label for="file" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="file" name="testimoni_FOTO">
        <p class="help-block">Unggah Foto Testimoni</p>
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
    <h1 class="display-5">Output Testimoni</h1>
  </div>
</div>

<form method="POST" class="mt-5">
    <div class="form-group row">
      <label for="search" class="col-sm-2">Cari Testimoni</label>
      <div class="col-sm-6">
        <input type="text" name="search" class="form-control" id="search"
          value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari Nama atau Judul Testimoni">
      </div>
      <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
    </div>
</form>

<table class="table table-striped table-success table-hover mt-5">
    <tr class="info">
        <th>Judul Testimoni</th>
        <th>Foto</th>
        <th>Isi</th>
        <th>Nama</th>
        <th>Kota</th>
        <th colspan="2">Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr class="danger">
            <td><?php echo $row['testimoni_JUDUL']; ?></td>
            <td>
                <?php if ($row['testimoni_FOTO'] == "") { ?>
                    <img src="images/noimage.png" width="88"/>
                <?php } else { ?>
                    <img src="images/<?php echo $row['testimoni_FOTO']; ?>" width="88"/>
                <?php } ?>
            </td>
            <td><?php echo $row['testimoni_ISI']; ?></td>
            <td><?php echo $row['testimoni_NAMA']; ?></td>
            <td><?php echo $row['testimoni_KOTA']; ?></td>
            <td>
                <a href="testimoni_update.php?ubahtestimoni=<?php echo $row["testimoni_ID"]?>" class="btn btn-success btn-sm" title="EDIT">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
            <td>
                <a href="testimoni_hapus.php?hapustestimoni=<?php echo $row["testimoni_ID"]?>" class="btn btn-danger btn-sm" title="HAPUS">
                    <i class="bi bi-trash3"></i>
                </a>
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
ob_end_flush();
?>
</html>
