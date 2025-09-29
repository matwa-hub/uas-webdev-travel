<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}

// Memanggil koneksi ke MySQL
include("include/config.php");

// Menerima data yang akan diubah
$booking_ID = $_GET["ubahbooking"];
$edit = mysqli_query($conn, "SELECT * FROM bookingmenu WHERE booking_ID = '$booking_ID'");
$row_edit = mysqli_fetch_array($edit);

// Memeriksa apakah tombol 'Ubah' diklik
if (isset($_POST['Ubah'])) {
    $booking_NAMA = $_POST['booking_NAMA'];
    $booking_DESKRIPSI = $_POST['booking_DESKRIPSI'];
    $booking_TGL = $_POST['booking_TGL'];

    // Query untuk mengupdate data
    $query = "UPDATE bookingmenu SET
              booking_NAMA = '$booking_NAMA',
              booking_DESKRIPSI = '$booking_DESKRIPSI',
              booking_TGL = '$booking_TGL'
              WHERE booking_ID = '$booking_ID'";

    if (mysqli_query($conn, $query)) {
        header("Location: booking.php");
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
                                    <h1 class="display-5">Update Booking</h1>
                                    <p class="lead">Berikut adalah Tampilan Data Booking</p>
                                </div>
                            </div>

                            <form method="POST">
                                <div class="row mb-3 mt-5">
                                    <label for="booking_NAMA" class="col-sm-2 col-form-label">Nama Booking</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="booking_NAMA" name="booking_NAMA" value="<?php echo $row_edit['booking_NAMA']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="booking_DESKRIPSI" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="booking_DESKRIPSI" name="booking_DESKRIPSI"><?php echo $row_edit['booking_DESKRIPSI']; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="booking_TGL" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="booking_TGL" name="booking_TGL" value="<?php echo $row_edit['booking_TGL']; ?>">
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