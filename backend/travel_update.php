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
$travel_ID = $_GET["ubahtravel"];
$edit = mysqli_query($conn, "SELECT * FROM travel WHERE travel_ID = '$travel_ID'");
$row_edit = mysqli_fetch_array($edit);

// Memeriksa apakah tombol 'Ubah' diklik
if (isset($_POST['Ubah'])) {
    $travel_ID = $_POST['travel_ID'];
    $travel_JUDUL = $_POST['travel_JUDUL'];
    $travel_SUBJUDUL = $_POST['travel_SUBJUDUL'];
    $travel_KETERANGAN = $_POST['travel_KETERANGAN'];
    $travel_LINKVID = $_POST['travel_LINKVID'];

    $namafoto = $_FILES['travel_FOTO']['name'];
    $file_tmp = $_FILES['travel_FOTO']['tmp_name'];
    $file_size = $_FILES['travel_FOTO']['size'];
    $max_size = 2 * 1024 * 1024; // 2MB dalam byte

    // Memeriksa apakah foto baru diunggah
    if ($namafoto != "") {
        if ($file_size <= $max_size) {
            move_uploaded_file($file_tmp, 'includes/images/' . $namafoto);
            // Query dengan foto baru
            $query = "UPDATE travel SET
                      travel_JUDUL = '$travel_JUDUL',
                      travel_SUBJUDUL = '$travel_SUBJUDUL',
                      travel_KETERANGAN = '$travel_KETERANGAN',
                      travel_LINKVID = '$travel_LINKVID',
                      travel_FOTO = '$namafoto'
                      WHERE travel_ID = '$travel_ID'";
        } else {
            echo "<script>alert('Ukuran file terlalu besar. Maksimal 2MB.');</script>";
        }
    } else {
        // Query tanpa mengubah foto
        $query = "UPDATE travel SET
                  travel_JUDUL = '$travel_JUDUL',
                  travel_SUBJUDUL = '$travel_SUBJUDUL',
                  travel_KETERANGAN = '$travel_KETERANGAN',
                  travel_LINKVID = '$travel_LINKVID'
                  WHERE travel_ID = '$travel_ID'";
    }
   
    // Menjalankan query
    if (isset($query) && mysqli_query($conn, $query)) {
        header("location:travel.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Travel</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<!-- Form input data travel -->
<div class="row">
<div class="col-1"></div>
<div class="col-10">

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5">Update Travel</h1>
    <p class="lead">Formulir untuk memperbarui data travel</p>
  </div>
</div>

<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="travel_ID" class="col-sm-2 col-form-label">ID Travel</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="travel_ID" name="travel_ID" value="<?php echo $row_edit["travel_ID"] ?>" readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label for="travel_JUDUL" class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="travel_JUDUL" name="travel_JUDUL" value="<?php echo $row_edit["travel_JUDUL"] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="travel_SUBJUDUL" class="col-sm-2 col-form-label">Subjudul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="travel_SUBJUDUL" name="travel_SUBJUDUL" value="<?php echo $row_edit["travel_SUBJUDUL"] ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="travel_KETERANGAN" class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="travel_KETERANGAN" name="travel_KETERANGAN"><?php echo $row_edit["travel_KETERANGAN"] ?></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label for="travel_LINKVID" class="col-sm-2 col-form-label">Link Video</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="travel_LINKVID" name="travel_LINKVID" value="<?php echo $row_edit["travel_LINKVID"] ?>">
    </div>
  </div>

  <!-- Input file foto -->
  <div class="form-group row mb-3">
    <label for="file" class="col-sm-2 col-form-label">Foto Travel</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="file" name="travel_FOTO">
        <p class="help-block">Unggah Foto Travel (jika ingin mengubah)</p>
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