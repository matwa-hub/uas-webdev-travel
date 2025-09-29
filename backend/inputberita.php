<html>
<?php
 ob_start();
 session_start();

 if(!isset($_SESSION['admin_USER'])){
  header("location : login.php");
 }
?>
<?php
/** Memanggil koneksi ke MySQL **/
include("include/config.php");

/** Mengecek apakah tombol simpan suda di pilih/klik atau belum **/
    if (isset($_POST['Simpan']))
    {
        $beritaID = $_POST['inputID'];
        $beritaJUDUL = $_POST['inputJUDUL'];
        $beritaISI = $_POST['inputISI'];
        $beritaSUMBER = $_POST['inputSUMBER'];

    mysqli_query($conn, "insert into berita values('$beritaID', '$beritaJUDUL', '$beritaISI', '$beritaSUMBER')");
    header("location:inputberita.php");
    }

    $query = mysqli_query($conn, "select * from berita");
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<!-- Membuat form input data kategori -->
<div class="row">
<div class="col-1"></div>
<div class="col-10">
<form method="POST">
  <div class="row mb-3 mt-5">
    <label for="beritaID" class="col-sm-2 col-form-label">Kode Berita Wisata</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="beritaID" name="inputID" placeholder="Kode Berita Wisata">
    </div>
  </div>

  <div class="row mb-3">
    <label for="beritaJUDUL" class="col-sm-2 col-form-label">Judul Berita Wisata</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="beritaJUDUL" name="inputJUDUL" placeholder="Judul Berita Wisata">
    </div>
  </div>

  <div class="row mb-3">
    <label for="beritaISI" class="col-sm-2 col-form-label">Isi Berita Wisata</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="beritaISI" name="inputISI" placeholder="Isi Berita Wisata">
    </div>
  </div>

  <div class="row mb-3">
    <label for="beritaSUMBER" class="col-sm-2 col-form-label">Sumber Berita Wisata</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="beritaSUMBER" name="inputSUMBER" placeholder="Sumber Berita Wisata">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-2"></div>
        <div class="col-sm-10">
        <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
        <input type="reset" class="btn btn-danger" value="Batal">
        </div>
    </div>
</form>
<table class="table table-striped table-success table-hover mt-5">
<!-- Membuat judul -->
    <tr class="info">
                <th>Kode</th>
                <th>Judul Berita</th>
                <th>Isi Berita</th>
                <th>Sumber Berita</th>
    </tr>

<!-- Menampilkan data dari tabel kategori -->
    <?php { ?>
    <?php while ($row = mysqli_fetch_array($query))
        { ?>
            <tr>
                <td><?php echo $row['berita_ID']; ?> </td>
                <td><?php echo $row['berita_JUDUL']; ?></td>
                <td><?php echo $row['berita_ISI']; ?></td>
                <td><?php echo $row['berita_SUMBER']; ?></td>
            </tr>
    <?php } ?>
    <?php } ?>
</table>
</body>
<?php
mysqli_close($conn);
ob_end_flush();
?>
</html>