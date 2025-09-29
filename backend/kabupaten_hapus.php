<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>
<?php
    include "include/config.php";
    if(isset($_GET["hapuskabupaten"]))
    {
        $kabupatenKODE = $_GET["hapuskabupaten"];
        mysqli_query($conn, "DELETE FROM kabupaten WHERE kabupaten_KODE = '$kabupatenKODE'");
        echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='kabupaten.php'</script>";
    }
?>