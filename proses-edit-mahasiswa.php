<?php
// Include koneksi
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $program_studi = $_POST['program_studi'];
    $alamat = $_POST['alamat'];

    // Query untuk update data mahasiswa
    $sql = "UPDATE mahasiswa SET nama=?, nim=?, jenis_kelamin=?, program_studi=?, alamat=? WHERE id=?";
    $stmt = $k->prepare($sql);
    $stmt->bind_param("sssssi", $nama, $nim, $jenis_kelamin, $program_studi, $alamat, $id);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect ke halaman data mahasiswa dengan pesan sukses
        header("Location: ../index.php?page=data-mahasiswa");
    } else {
        // Redirect dengan pesan error jika gagal
        header("Location: ../index.php?page=data-mahasiswa");
    }

    // Tutup pernyataan dan koneksi
    $stmt->close();
    $k->close();
} else {
    // Redirect jika bukan dari metode POST
    header("Location: ../index.php?page=data-mahasiswa");
}
?>