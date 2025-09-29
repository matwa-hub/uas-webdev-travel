<?php
// Memanggil koneksi ke MySQL
include("../admin/includes/config.php");

// Periksa apakah parameter kodebooking ada
if (isset($_GET['kodebooking'])) {
    $kodeBooking = $_GET['kodebooking'];

    // Query untuk mendapatkan detail booking
    $query = mysqli_query($conn, "SELECT * FROM booking WHERE booking_ID = '$kodeBooking'");
    $data = mysqli_fetch_assoc($query);

    // Periksa apakah data ditemukan
    if ($data) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detail Booking</title>
        </head>
        <body>
            <h1>Detail Booking</h1>
            <p><strong>ID:</strong> <?php echo $data['booking_ID']; ?></p>
            <p><strong>Nama:</strong> <?php echo $data['booking_NAMA']; ?></p>
            <p><strong>Deskripsi:</strong> <?php echo $data['booking_DESKRIPSI']; ?></p>
            <p><strong>Tanggal:</strong> <?php echo $data['booking_TANGGAL']; ?></p>
        </body>
        </html>
        <?php
    } else {
        echo "Booking tidak ditemukan.";
    }
} else {
    echo "Parameter kodebooking tidak ditemukan.";
}
?>
