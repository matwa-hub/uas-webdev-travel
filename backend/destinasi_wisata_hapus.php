<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>
<?php
    include "include/config.php";
    if(isset($_GET["hapusdestinasi"]))
    {
        $destinasKODE = $_GET["hapusdestinasi"];
        mysqli_query($conn, "DELETE FROM destinasi WHERE destinasi_KODE = '$destinasKODE'");
        echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='destinasi_wisata.php'</script>";
    }
?>