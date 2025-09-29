<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>
<?php
include "include/config.php";
if (isset($_GET["hapustestimoni"])) {
    $testimoniID = $_GET["hapustestimoni"];
    mysqli_query($conn, "DELETE FROM testimoni WHERE testimoni_ID = '$testimoniID'");
    echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='testimoni.php'</script>";
}
?>
