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
include("include/config.php"); /**pake .// biar dia keluar dari folder berita dlu dan masuk ke includes biar kebaca, soalnya mereka beda folder **/

// Inisialisasi variabel pesan error
$pesanerror = null;

/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan'])){
        $kabupatenKODE = $_POST['inputKODE'];
        $kabupatenNAMA = $_POST['inputNAMA'];
        $provinsiID = $_POST['provinsiID'];
	
        $maxFileSize = 2 * 1024 * 1024;
        $namafoto = $_FILES['fotokabupaten']['name']; /** untuk menampung data foto atau gambar **/
        $file_tmp = $_FILES['fotokabupaten']['tmp_name'];
  
        if ($_FILES['fotokabupaten']['size'] > $maxFileSize) {
          $pesanerror = "File terlalu besar. Ukuran maksimal adalah 2MB."; 
        } else { //proses unggah file
          move_uploaded_file($file_tmp, '..images/' .$namafoto); /**untuk upload file gambarnya **/
          $result = mysqli_query($conn, "INSERT INTO kabupaten VALUES('$kabupatenKODE', '$kabupatenNAMA', '$provinsiID', '$namafoto')");
          if ($result) {
            echo "Data berhasil disimpan!";
          } else {
            echo "Error: " . mysqli_error($conn); // Menampilkan pesan error
          }
          header("location:kabupaten.php");
        }
      }
      
  $dataprovinsi = mysqli_query($conn, "SELECT * FROM provinsi");
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" href="../css/bootstrap.min.css"> <!--pake ../ untuk keluar dulu dari folder berita, dan masuk ke css, jadi kebaca' -->
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
    <h1 class="display-5">Input Kabupaten</h1>
    <p class="lead">Berita tentang destinasi wisata di Jawa</p>
  </div>
</div>

	
<form method="POST" enctype="multipart/form-data">
  <div class="row mb-3 mt-5">
    <label for="kabupatenKODE" class="col-sm-2 col-form-label">Kode Kabupaten</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kabupatenKODE" name="inputKODE" placeholder="Kode Kabupaten"> 
    </div>
  </div>
  <div class="row mb-3">
    <label for="kabupatenNAMA" class="col-sm-2 col-form-label">Nama Kabupaten</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kabupatenNAMA" name="inputNAMA" placeholder="Nama Kabupaten">
    </div>
  </div>

  <!-- penggunaan select2 -->
   <div class="row mb-3">
    <label for="provinsiID" class="col-sm-2 col-form-label">Kode Provinsi</label>
    <div class="col-sm-10">
      <select class="form-control" id="provinsiID" name="provinsiID">
        <option>Kode Provinsi</option>
        <?php while($row = mysqli_fetch_array($dataprovinsi)) { ?>
          <option value="<?php echo $row["provinsi_KODE"]?>">
            <?php echo $row["provinsi_KODE"]?>
          </option>
        <?php } ?>
      </select>
    </div>
  </div>
  <!-- end select2 -->

  <!-- input file --> 
  <div class="form-group row mb-3">
    <label for="file" class="col-sm-2 col-form-label">Foto Kabupaten</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="file" name="fotokabupaten">
      <p class="help-block">Unggah Foto Kabupaten</p>
      <?php if ($pesanerror) { ?>
          <div class="text-danger"><?php echo $pesanerror; ?></div>
      <?php } ?>
    </div>
  </div>
  <!-- end input file -->

  <div class="form-group row">  
  	<div class="col-sm-2"></div>
  	<div class="col-sm-10">
		<input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
		<input type="reset" class="btn btn-danger" value="Batal">
	</div>
  </div>	

</form>

<div class="jumbotron jumbotron-fluid mt-5">
  <div class="container">
    <h1 class="display-5">Output List Kabupaten</h1>
  </div>
</div>

<form method="POST">
    <div class="form-group row mt-5">
        <label for="search" class="col-sm-2">Cari Kabupaten</label>
        <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search"
            value="<?php if(isset($_POST["search"])) {echo $_POST["search"];}?>" placeholder="Cari nama Kabupaten">
        </div>
        <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
    </div>
</form>

<table class="table table-striped table-success table-hover mt-5">
<!-- membuat judul -->
<thead>
	<tr class="info">
		  <th>Kode Kabupaten</th>
		  <th>Nama Kabupaten</th>
      <th>Kode Provinsi</th>
      <th>Foto Kabupaten</th>
      <th colspan="2">Aksi</th>
	</tr>
</thead>
  <!-- menampilkan data dari tabel kabupaten -->
  <tbody>
	    <?php 
       if(isset($_POST["kirim"])) {
        $search = $_POST["search"];
        $query = mysqli_query($conn, "SELECT * FROM provinsi, kabupaten
            WHERE provinsi.provinsi_KODE = kabupaten.provinsi_KODE 
            AND kabupaten_NAMA LIKE '%".$search."%'");
        } else {
        $query = mysqli_query($conn, "SELECT * FROM provinsi, kabupaten
            WHERE provinsi.provinsi_KODE = kabupaten.provinsi_KODE");
        }

  while ($row = mysqli_fetch_array($query)) { ?>
			<tr class="danger">
			  	<td><?php echo $row['kabupaten_KODE']; ?></td>
				  <td><?php echo $row['kabupaten_NAMA']; ?></td>
          <td><?php echo $row['provinsi_KODE']; ?></td>
          <td>
              <?php if ($row['foto_kabupaten'] == "") { ?>
                  <img src='images/noimage.png' width='88'/>
              <?php } else { ?>
                  <img src="../admin/images/<?php echo $row['foto_kabupaten']; ?>" width="88" class="img-responsive" />
              <?php } ?>
          </td>
          <td>
              <a href="kabupaten_update.php?ubahkabupaten=<?php echo $row['kabupaten_KODE']; ?>" class="btn btn-success btn-sm" title="EDIT">
                  <i class="bi bi-pencil-square"></i>
              </a>
              <a href="kabupaten_hapus.php?hapuskabupaten=<?php echo $row['kabupaten_KODE']; ?>" class="btn btn-danger btn-sm" title="HAPUS">
                  <i class="bi bi-trash"></i>
              </a>
          </td>
        </tr>
    <?php } ?>
  </tbody>
</table>

</div>
<div class="col-1"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

<script>
  $(document).ready(function()
  {
  $('#provinsiKODE').select2(
    {
      closeOnSelect: true,
      allowClear: true,
      placeholder: 'Pilih Kategori'
    });
  });
</script>
</main>
                <?php include "include/footer.php";?> 
            </div>
        </div>
    <?php include "include/jsscript.php";?>
</body>
</html>