<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>
<?php
include "include/config.php";
if (isset($_GET["hapusbooking"])) {
    $booking_ID = $_GET["hapusbooking"];
    mysqli_query($conn, "DELETE FROM bookingmenu WHERE booking_ID = '$booking_ID'");
    echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='booking.php'</script>";
}
?>