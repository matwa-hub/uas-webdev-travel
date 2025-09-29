<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>

<?php include "include/head.php";?>
    <body class="sb-nav-fixed">
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
 
<?php
/** Memanggil koneksi ke MySQL **/
include("include/config.php");
/** Menerima data yang akan diubah **/
    $kabupatenKODE = $_GET["ubahkabupaten"];
    $edit = mysqli_query($conn, "SELECT * FROM kabupaten WHERE kabupaten_KODE = '$kabupatenKODE' ");
    $row_edit = mysqli_fetch_array($edit);

/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['ubah']))
 	 {
		$kabupatenKODE = $_POST['inputKODE'];
		$kabupatenNAMA = $_POST['inputNAMA'];
        $provinsiKODE = $_POST ['provinsiKODE'];

    $namafoto = $_FILES['fotokabupaten']['name'];
    $file_tmp = $_FILES['fotokabupaten']['tmp_name'];
    move_uploaded_file($file_tmp, 'images/'.$namafoto);
		
	/**mysqli_query($conn, "insert into kabupaten values('$kabupatenKODE', '$kabupatenNAMA', '$provinsiKODE', '$namafoto')");**/
	if ($namafoto == "") {
        mysqli_query($conn, "UPDATE kabupaten 
            SET kabupaten_NAMA = '$kabupatenNAMA',   
                provinsi_KODE = '$provinsiKODE' 
            WHERE kabupaten_KODE = '$kabupatenKODE'");
    } else {
        mysqli_query($conn, "UPDATE kabupaten 
            SET kabupaten_NAMA = '$kabupatenNAMA',  
                provinsi_KODE = '$provinsiKODE', 
                foto_kabupaten = '$namafoto' 
            WHERE kabupaten_KODE = '$kabupatenKODE'");
    }
    header("location:kabupaten.php");
	}

	/**$query = mysqli_query($conn, "select * from kabupaten,provinsi where kabupaten.provinsi_KODE = provinsi.provinsi_KODE");**/
    $dataprovinsi = mysqli_query($conn, "select * from provinsi");
  
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />

</head>
<body>

<!-- membuat form input data kategori -->
<div class="row">
<div class="col-1"></div>
<div class="col-10">

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5">Input Kabupaten Destinasi Wisata</h1>
    <p class="lead">Berita tentang berita Kabupaten destinasi wisata</p>
  </div>
</div>

	
<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="kabupatenKODE" class="col-sm-2 col-form-label">Kode Kabupaten</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kabupatenKODE" name="inputKODE" value="<?php echo $row_edit["kabupaten_KODE"]?>" readonly> 
    </div>
  </div>
  <div class="row mb-3">
    <label for="kabupatenNAMA" class="col-sm-2 col-form-label">Nama Kabupaten</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kabupatenNAMA" name="inputNAMA" value="<?php echo $row_edit["kabupaten_NAMA"]?>">
    </div>
  </div>

  <!-- penggunaan select2 -->
  <div class="row mb-3">
    <label for="provinsiKODE" class="col-sm-2 col-form-label">Kode Provinsi</label>
    <div class="col-sm-10">
    <select class="form-control" id="provinsiKODE" name="provinsiKODE">
            <option><?php echo $row_edit["provinsi_KODE"]; ?></option>
            <?php 
                if(mysqli_num_rows($dataprovinsi) > 0) { 
                    while($row = mysqli_fetch_array($dataprovinsi)) { 
            ?>
                <option value="<?php echo $row["provinsi_KODE"]; ?>">
                    <?php echo $row["provinsi_KODE"]; ?>
                    <?php echo $row["provinsi_NAMA"]; ?>
                </option>
            <?php 
                    } 
                } 
            ?>
    </select>
    </div>
  </div>
  <!-- end select2 -->

  <!-- input-file -->
  <div class="form-group row mb-3">
    <label for="file" class="col-sm-2 col-form-label">Foto Kabupaten</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="file" name="fotokabupaten" value="<?php echo $row_edit["foto_kabupaten"]?>">
        <p class="help-block">Unggah Foto Kabupaten</p>
    </div>
  </div>
  <!-- end input-file -->   

  <div class="form-group row">  
  	<div class="col-sm-2"></div>
  	<div class="col-sm-10">
		<input type="submit" class="btn btn-success" value="Update" name="ubah">
		<input type="reset" class="btn btn-danger" value="Batal">
	</div>
  </div>	

</form>

<div class="jumbotron jumbotron-fluid mt-5">
  <div class="container">
    <h1 class="display-5">Output Kabupaten Destinasi Wisata</h1>
  </div>
</div>

<table class="table table-striped table-success table-hover mt-5">
<!-- form pencarian data -->
<form method="POST">
    <div class="form-group row mt-5">
        <label for="search" class="col-sm-2">Nama Kabupaten</label>
        <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search" 
                   value="<?php if(isset($_POST['search'])) { echo $_POST['search']; } ?>" 
                   placeholder="Cari nama kabupaten">
        </div>
        <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
    </div>
</form>
<!-- end pencarian data -->

<!-- membuat judul -->
	<tr class="info">
		<th>Kode Kabupaten</th>
		<th>Nama Kabupaten</th>
        <th>Kode Provinsi</th>
        <th>Nama Provinsi</th>
        <th>Foto Kabupaten</th>
        <th colspan="2">Aksi</th>
	</tr>

<!-- menampilkan data dari tabel kategori -->
	<?php {
    //** pencarian data **/
    if(isset($_POST["kirim"])) {
      $search = $_POST["search"];
      $query = mysqli_query($conn, "select * from kabupaten, provinsi 
                                    where kabupaten.provinsi_KODE = provinsi.provinsi_KODE 
                                    and kabupaten_NAMA like '%" . $search . "%'");
    } else {
      $query = mysqli_query($conn, "select * from kabupaten, provinsi 
                                    where kabupaten.provinsi_KODE = provinsi.provinsi_KODE");
    }
    //** end pencarian data **/
    ?>
	    <?php while ($row = mysqli_fetch_array($query)) 	
		    { ?>
			    <tr class="danger">
				    <td><?php echo $row['kabupaten_KODE']; ?> </td>
				    <td><?php echo $row['kabupaten_NAMA']; ?> </td>
                    <td><?php echo $row['provinsi_KODE']; ?> </td>
                    <td><?php echo $row['provinsi_NAMA']; ?> </td>
                    <td>
                        <?php if($row['foto_kabupaten'] == "") {echo "<img src='images/noimage.jpg' 
                        width='88'/>";} else { ?>
                        <img src="images/<?php echo $row['foto_kabupaten']; ?>" width="88" class=
                        "img-responsive" /><?php } ?>
                    </td>
              <td>
                <a href="#" class="btn btn-success btn-sm" title="EDIT">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="
                currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 
                  0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 
                  0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 
                  .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 
                  1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 
                  0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
              </td>
              <td>
                <a href="#" class="btn btn-danger btn-sm" title="HAPUS">
                <i class="bi bi-trash"></i>
              </td>
			    </tr>
	    <?php } ?>
    <?php }?>
</table>
</main>
                <?php include "include/footer.php";?>
            </div>
        </div>
        <?php include "include/jsscript.php";?>
</div>
<div class="col-1"></div>
</div>
</body>
<?php
// Mengakhiri output buffering
ob_end_flush();
?>
</html>