<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jabatan.php');
include('classes/Template.php');


// buat instance jabatan
$listJabatan = new Jabatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$home = new Template('templates/tambahupdate.html');

$listJabatan->open();

//jika tambah jabatan di klik
if (isset($_POST['submit'])) {

    if ($listJabatan->addJabatan($_POST) > 0) {
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

$data = null;


$data .= '<form action="tambahJabatan.php" method="POST" enctype="multipart/form-data">
<div class="form-group mb-3">
  <label for="nama_jabatan">Nama Jabatan:</label>
  <input
  
    type="text"
    class="form-control"
    id="nama_jabatan"
    name="nama_jabatan"
    required />
</div>

<button type="submit" class="btn btn-primary" id="submit" name="submit">
  Tambah Jabatan
</button>
</form>';


// tutup koneksi
$listJabatan->close();

// buat instance template
$judul = 'Tambah Jabatan';
$title = 'Tambah Jabatan';

// simpan data ke template
// $home->replace('OPSI JABATAN', $jabatan_options);
$home->replace('DATA_FORM', $data);
$home->replace('DATA_JUDUL', $judul);
$home->replace('DATA_TITLE', $title);
$home->write();
