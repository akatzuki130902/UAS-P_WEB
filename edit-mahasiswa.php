<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title" style="color:white;">Form Edit Mahasiswa</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            // Include koneksi
                            include('dbconnect.php');
                            
                            // Ambil ID mahasiswa dari query string
                            $id = $_GET['id'];
                            
                            // Query untuk mengambil data mahasiswa berdasarkan ID
                            $sql = "SELECT * FROM mahasiswa WHERE id = ?";
                            $stmt = $k->prepare($sql);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            // Tampilkan form edit
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                ?>
                                <form action="pages/proses-edit-mahasiswa.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nim">NIM:</label>
                                        <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $row['nim']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="1" <?php echo ($row['jenis_kelamin'] == 1) ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="0" <?php echo ($row['jenis_kelamin'] == 0) ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Program Studi:</label>
                                        <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?php echo $row['program_studi']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="jurusan">Alamat:</label>
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="ex : jl.Sukamaju D 15"><?php echo $row['alamat']; ?></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="data-mahasiswa.php" class="btn btn-default">Batal</a>
                                </form>
                                <?php
                            } else {
                                echo "Data mahasiswa tidak ditemukan.";
                            }
                            
                            // Tutup koneksi
                            $stmt->close();
                            $k->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->