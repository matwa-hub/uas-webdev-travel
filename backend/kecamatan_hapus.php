<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>
<?php
    include "include/config.php";
    if(isset($_GET["hapuskecamatan"]))
    {
        $kecamatanKODE = $_GET["hapuskecamatan"];
        mysqli_query($conn, "DELETE FROM kecamatan WHERE kecamatan_KODE = '$kecamatanKODE'");
        echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='kecamatan.php'</script>";
    }
?>