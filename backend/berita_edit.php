<!DOCTYPE html>
<html>
<?php
    ob_start();
    session_start();
    if (!isset($_SESSION["admin_USER"]))
        header("location:login.php");
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
include("../admin/includes/config.php");

// Inisialisasi variabel pesan error
$pesanerror = null;

/** menerima data yang akan diubah **/
	$kodeberita = $_GET["ubahberita"];
	$edit =  mysqli_query($conn, "SELECT * FROM berita WHERE berita_ID = '$kodeberita'");
	$row_edit = mysqli_fetch_array($edit); 	

/** Mengecek apakah tombol ubah sudah di pilih/klik atau belum **/
     if(isset($_POST['ubah']))
 	 {
		$beritaID = $_POST['inputID'];
		$beritaJUDUL = $_POST['inputJUDUL'];
		$beritaISI = $_POST['inputISIBERITA'];
		$beritaSUMBER = $_POST['inputSUMBER'];
		$kategoriKODE = $_POST["kategoriID"];

		$maxFileSize = 2 * 1024 * 1024;
		$namafoto = $_FILES['fotoberita']['name']; /** untuk menampung data foto atau gambar **/ 
		$file_tmp = $_FILES["fotoberita"]["tmp_name"];
		move_uploaded_file($file_tmp, 'images/'.$namafoto); /** untuk upload file gambarnya **/

	if ($_FILES['fotoberita']['size'] > $maxFileSize) {
		$pesanerror = "File terlalu besar. Ukuran maksimal adalah 2MB.";
		move_uploaded_file($file_tmp, 'images/' .$namafoto);
	} else { if ($namafoto == "") {	
		mysqli_query($conn, "UPDATE  berita SET berita_JUDUL='$beritaJUDUL', berita_ISI='$beritaISI', berita_SUMBER='$beritaSUMBER', kategori_ID='$kategoriKODE' WHERE berita_ID='$kodeberita'");
	} else {
		mysqli_query($conn, "UPDATE  berita SET berita_JUDUL='$beritaJUDUL', berita_ISI='$beritaISI', berita_SUMBER='$beritaSUMBER', kategori_ID='$kategoriKODE', berita_FOTO='$namafoto' WHERE berita_ID='$kodeberita'");
	}
	header("location:berita-input-output.php"); }
   }

	/* $query = mysqli_query($conn, "select * from berita,kategori
		where berita.kategori_ID = kategori.kategori_ID"); */
	$datakategori = mysqli_query($conn, "select * from kategori");
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

</head>
<body>

<!-- membuat form input data kategori -->
<div class="row">
<div class="col-1"></div>
<div class="col-10">

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5">Edit Berita Wisata</h1>
    <p class="lead">Berita tentang destinasi wisata di Jawa</p>
  </div>
</div>

	
<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="beritaID" class="col-sm-2 col-form-label">Kode Berita</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="beritaID" name="inputID" value="<?php echo $row_edit["berita_ID"]?>" readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label for="beritaJUDUL" class="col-sm-2 col-form-label">Judul Berita Wisata</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="beritaJUDUL" name="inputJUDUL" value="<?php echo $row_edit["berita_JUDUL"]?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="beritaISI" class="col-sm-2 col-form-label">Isi Berita Wisata</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="beritaISI" name="inputISIBERITA" value="<?php echo $row_edit["berita_ISI"]?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="beritaSUMBER" class="col-sm-2 col-form-label">Sumber Berita</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="beritaSUMBER" name="inputSUMBER" value="<?php echo $row_edit["berita_SUMBER"]?>">
    </div>
  </div>

<!-- penggunaan select2 -->
  <div class="row mb-3">
    <label for="kategoriID" class="col-sm-2 col-form-label">Kode Kategori</label>
    <div class="col-sm-10">
      <select class="form-control" id="kategoriID" name="kategoriID">
        <option><?php echo $row_edit["kategori_ID"]?></option>
					<?php if (mysqli_num_rows($datakategori) > 0) {?>
        <?php while($row = mysqli_fetch_array($datakategori)) 
        { ?>
          <option value="<?php echo $row["kategori_ID"]?>">
            <?php echo $row["kategori_ID"]?>
            <?php echo $row["kategori_NAMA"]?>
          </option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
  </div>
<!-- end select2 -->

<!-- input file -->
  <div class="form-group row mb-3">
    <label for="file" class="col-sm-2 col-form-label">Foto Berita</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="file" name="fotoberita" value="<?php echo $row_edit["berita_FOTO"]?>">
      <p class="help-block">Unggah Foto Berita</p>
	  <?php if ($pesanerror) { ?>
        <div class="text-danger"><?php echo $pesanerror; ?></div>
      <?php } ?>
    </div>
  </div>
<!-- end input file -->

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
    <h1 class="display-5">Output Berita Wisata</h1>
  </div>
</div>

<!-- form pencarian data -->
<form method="POST">
	<div class="form-group row mt-5">
		<label for="search" class="col-sm-2">Cari Judul Berita</label>
		<div class="col-sm-6">
			<input type="text" name="search" class="form-control" id="search"
			value="<?php if(isset($_POST["search"]))
			{echo $_POST["search"];}?>" placeholder="Cari nama destinasi">
		</div>
		  <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
	</div>
</form>
<!-- end pencarian data -->

<table class="table table-striped table-success table-hover mt-5">
<!-- membuat judul -->
	<tr class="info">
				<th>Kode</th>
				<th>Judul Berita</th>
				<th>Isi Berita</th>
				<th>Sumber Berita</th>
				<th>Kode Kategori</th>
				<th>Nama Kategori</th>
				<th>Foto Berita</th>
				<th colspan="2">Aksi</th>
	</tr>

<!-- menampilkan data dari tabel kategori -->
	<?php { 
/** pencarian data */
	if(isset($_POST["kirim"]))
	{
	$search = $_POST["search"];
	$query = mysqli_query($conn, "SELECT * FROM kategori, berita 
		WHERE kategori.kategori_ID = berita.kategori_ID AND 
		berita_JUDUL LIKE '%".$search."%'");
	}else
	{
	$query = mysqli_query($conn, "select * from kategori, berita 
		where kategori.kategori_ID = berita.kategori_ID");
	}
	/** end pencarian data */

		?>
	<?php while ($row = mysqli_fetch_array($query)) 	
		{ ?>
			<tr class="danger">
				<td><?php echo $row['berita_ID']; ?> </td>
				<td><?php echo $row['berita_JUDUL']; ?> </td>
				<td><?php echo $row['berita_ISI']; ?> </td>
				<td><?php echo $row['berita_SUMBER']; ?> </td>
				<td><?php echo $row['kategori_ID']; ?> </td>
				<td><?php echo $row['kategori_NAMA']; ?> </td>
				<td>
						<?php if($row['berita_FOTO']==""){ echo "<img src='images/noimage.png' width='88'/>";}else{?>
						<img src="../admin/images/<?php echo $row['berita_FOTO'] ?>" width="88" class="img-responsive" />
						<?php }?>
				</td>

				<td>
					<a href="#" class="btn btn-success btn-sm" title="EDIT">					
						<i class="bi bi-pencil-square"></i>
					</a>
					<a href="#" class="btn btn-danger btn-sm" title="HAPUS">					
						<i class="bi bi-trash"></i>
					</a>
				</td>
			</tr>
	<?php } ?>
<?php }?>
</table>

</div>
<div class="col-1"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

</main>
                <?php include "include/footer.php";?> 
            </div>
        </div>
    <?php include "include/jsscript.php";?>

</body>
</html>
