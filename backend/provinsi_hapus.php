<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>
<?php
include "include/config.php";
if (isset($_GET["hapusprovinsi"])) {
    $provinsiKODE = $_GET["hapusprovinsi"];
    mysqli_query($conn, "DELETE FROM provinsi WHERE provinsi_KODE = '$provinsiKODE'");
    echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='provinsi.php'</script>";
}
