<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jabatan.php');
include('classes/Template.php');
include('classes/Chef.php');


// buat instance jabatan, chef
$listJabatan = new Jabatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$chef = new Chef($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$home = new Template('templates/tambahupdate.html');

$chef->open();
$listJabatan->open();

//jika tambah chef di klik
if (isset($_POST['submit'])) {

  if ($chef->addData($_POST) > 0) {
    echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>";
  } else {
    echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'tambahchef.php';
            </script>";
  }
}


$listJabatan->getJabatan();

//inisialisasi null
$jabatan_options = '';
$data = null;

// Susun opsi jabatan
while ($row = $listJabatan->getResult()) {
  $jabatan_options .= '<option value="' . $row['id_jabatan'] . '">' . $row['nama_jabatan'] . '</option>';
}

$data .= '<form action="tambahChef.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nama_chef">Nama Chef:</label>
              <input
              
                type="text"
                class="form-control"
                id="nama_chef"
                name="nama_chef"
                required />
            </div>
            <div class="form-group">
              <label for="no_telp_chef">No. Telepon:</label>
              <input
                type="text"
                class="form-control"
                id="no_telp_chef"
                name="no_telp_chef"
                required />
            </div>
            <div class="form-group">
              <label for="alamat_chef">Alamat:</label>
              <input
                type="text"
                class="form-control"
                id="alamat_chef"
                name="alamat_chef"
                required />
            </div>
            <div class="form-group">
              <label for="jenis_kelamin_chef">Jenis Kelamin:</label>
              <select
                class="form-control"
                id="jenis_kelamin_chef"
                name="jenis_kelamin_chef"
                required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="id_jabatan">Jabatan:</label>
              <select
                class="form-control"
                id="id_jabatan"
                name="id_jabatan"
                required>
                <!-- Place options for job titles here -->
                ' . $jabatan_options . '
                <!-- Add more options as needed -->
              </select>
            </div>
            <div class="form-group">
              <label for="foto_chef">Foto Chef:</label>
              <input
                type="file"
                class="form-control-file"
                id="foto_chef"
                name="foto_chef"
                required />
            </div>
            <button type="submit" class="btn btn-primary" id="submit" name="submit">
              Tambah Chef
            </button>
            </form>';

// tutup koneksi
$listJabatan->close();
$chef->close();

// buat instance template
$judul = 'Tambah Chef';
$title = 'Tambah Chef';

// simpan data ke template
$home->replace('DATA_FORM', $data);
$home->replace('DATA_JUDUL', $judul);
$home->replace('DATA_TITLE', $title);
$home->write();
