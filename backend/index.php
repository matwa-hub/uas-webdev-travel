<html lang="en">
<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>
    <body class="sb-nav-fixed">
    <?php include "include/head.php";?>
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
                </main>
                <?php include "include/footer.php";?>
            </div>
        </div>
        <?php include "include/jsscript.php";?>
    </body>
<?php
// mysqli_close($conn);
ob_end_flush();
?>
</html>