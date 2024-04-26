<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jabatan.php');
include('classes/Template.php');



// buat instance jabatan
$listJabatan = new Jabatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$home = new Template('templates/tambahupdate.html');

$listJabatan->open();

//jika update jabatan di klik
if (isset($_POST['submit'])) {
    $id = $_GET['id']; // Ambil id jabatan dari URL
    
    if ($listJabatan->updateJabatan($id, $_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'jabatan.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'updateJabatan.php?id=$id';
            </script>";
    }
    
}

//mengisi data jabatan
$id = $_GET['id'];
$listJabatan->getJabatanById($id);
$row = $listJabatan->getResult();

$dataNama = $row['nama_jabatan'];
$data = null;


$data .= '<form action="UpdateJabatan.php?id='.$id.'" method="POST" enctype="multipart/form-data">
<div class="form-group mb-3">
  <label for="nama_jabatan">Nama Jabatan:</label>
  <input
  
    type="text"
    class="form-control"
    id="nama_jabatan"
    name="nama_jabatan"
    value="'.$dataNama.'"
    required />
</div>

<button type="submit" class="btn btn-primary" id="submit" name="submit">
  Update Jabatan
</button>
</form>';



// tutup koneksi
$listJabatan->close();

// buat instance template
$judul = 'Update Jabatan';
$title = 'Update Jabatan';

// simpan data ke template
$home->replace('DATA_FORM', $data);
$home->replace('DATA_JUDUL', $judul);
$home->replace('DATA_TITLE', $title);
$home->write();
