<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">Mahasiswa</h3> -->

          <div class="card-tools" style="margin-left: auto;">
            <a href="?page=add-mahasiswa"  class="btn btn-success" >
              <i class="fas fa-plus"> Tambah</i>
            </a>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Aksi</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Program Studi</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
              </tr>
          </thead>
          <tbody>
              <?php
              // Include koneksi
              include('dbconnect.php');
              
              // Query untuk mengambil data mahasiswa
              $sql = "SELECT * FROM mahasiswa ORDER BY nama";
              $result = $k->query($sql);
              
              // Tampilkan data mahasiswa
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>
                        <a class='btn btn-danger delete-btn' data-id='" . $row['id'] . "'><i class='fas fa-trash'></i></a>
                        <a href='?page=edit-mahasiswa&id=" . $row['id'] . "'  class='btn btn-warning' >
                          <i class='fas fa-pencil-alt'></i>
                        </a>
                      </td>";
                      echo "<td>" . $row['nama'] . "</td>";
                      echo "<td>" . $row['nim'] . "</td>";
                      echo "<td>" . $row['program_studi'] . "</td>";
                      echo "<td>" . ($row['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan') . "</td>";
                      echo "<td>" . $row['alamat'] . "</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
              }
              
              // Tutup koneksi
              $k->close();
              ?>
          </tbody>
      </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: 'pages/hapus-mahasiswa.php',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response == 'success') {
                                alert('Data berhasil dihapus');
                                location.reload(); // Reload halaman setelah data dihapus
                            } else {
                                alert('Gagal menghapus data');
                            }
                        }
                    });
                }
            });
        });
      </script>
    <!-- /.content -->