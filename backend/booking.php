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
    $booking_NAMA = $_POST['booking_NAMA'];
    $booking_DESKRIPSI = $_POST['booking_DESKRIPSI'];
    $booking_TGL = $_POST['booking_TGL'];

    mysqli_query($conn, "INSERT INTO bookingmenu (booking_NAMA, booking_DESKRIPSI, booking_TGL) 
                         VALUES('$booking_NAMA', '$booking_DESKRIPSI', '$booking_TGL')");
    header("Location: booking.php");
    exit;
}

$search = "";
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM bookingmenu
    WHERE booking_NAMA LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM bookingmenu");
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
    <h1 class="display-5">Input Booking</h1>
    <p class="lead">Berikut adalah Tampilan Data Booking</p>
  </div>
</div>

<form method="POST">
  <div class="row mb-3 mt-5">
    <label for="booking_NAMA" class="col-sm-2 col-form-label">Nama Booking</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="booking_NAMA" name="booking_NAMA" placeholder="Nama Booking">
    </div>
  </div>
  <div class="row mb-3">
    <label for="booking_DESKRIPSI" class="col-sm-2 col-form-label">Deskripsi</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="booking_DESKRIPSI" name="booking_DESKRIPSI" rows="3" placeholder="Deskripsi Booking"></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label for="booking_TGL" class="col-sm-2 col-form-label">Tanggal</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="booking_TGL" name="booking_TGL">
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
    <h1 class="display-5">Output Booking</h1>
  </div>
</div>

<form method="POST" class="mt-5">
    <div class="form-group row">
      <label for="search" class="col-sm-2">Cari Booking</label>
      <div class="col-sm-6">
        <input type="text" name="search" class="form-control" id="search"
          value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari Nama Booking">
      </div>
      <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
    </div>
</form>

<table class="table table-striped table-success table-hover mt-5">
    <tr class="info">
        <th>Nama Booking</th>
        <th>Deskripsi</th>
        <th>Tanggal</th>
        <th colspan="2">Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr class="danger">
            <td><?php echo $row['booking_NAMA']; ?></td>
            <td><?php echo $row['booking_DESKRIPSI']; ?></td>
            <td><?php echo $row['booking_TGL']; ?></td>
            <td>
                <a href="booking_update.php?ubahbooking=<?php echo $row["booking_ID"]?>" class="btn btn-success btn-sm" title="EDIT">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
            <td>
                <a href="booking_hapus.php?hapusbooking=<?php echo $row["booking_ID"]?>" class="btn btn-danger btn-sm" title="HAPUS">
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
