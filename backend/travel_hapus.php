<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>

<?php
include "include/config.php";

if (isset($_GET["hapustravel"])) {
    $travel_ID = $_GET["hapustravel"];
    mysqli_query($conn, "DELETE FROM travel WHERE travel_ID = '$travel_ID'");
    echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='travel.php'</script>";
}
?>