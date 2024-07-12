<?php

include('dbconnect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $program_studi = $_POST['program_studi'];
    $alamat = $_POST['alamat'];


    $stmt = $k->prepare("INSERT INTO mahasiswa (nama, nim, jenis_kelamin, program_studi, alamat) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $nim, $jenis_kelamin, $program_studi, $alamat);


    if ($stmt->execute()) {

        header("Location: ../index.php?page=data-mahasiswa");
        exit();
    } else {

        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $k->close();
}
?>
