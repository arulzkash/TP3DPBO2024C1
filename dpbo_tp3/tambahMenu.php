<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Chef.php');
include('classes/Menu.php');


// buat instance chef, menu
$chef = new Chef($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$menu = new Menu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$home = new Template('templates/tambahupdate.html');

$chef->open();
$menu->open();

//jika tambah menu diklik
if (isset($_POST['submit'])) {

    if ($menu->addData($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'menu.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'menu.php';
            </script>";
    }
}

$chef->getChef();

$chef_options = '';
$data = null;

// Susun opsi chef
while ($row = $chef->getResult()) {
    $chef_options .= '<option value="' . $row['id_chef'] . '">' . $row['nama_chef'] . '</option>';
}

$data .= '<form action="tambahMenu.php" method="POST" enctype="multipart/form-data">
<div class="form-group">
  <label for="nama_menu">Nama Menu:</label>
  <input
  
    type="text"
    class="form-control"
    id="nama_menu"
    name="nama_menu"
    required />
</div>
<div class="form-group">
  <label for="harga">Harga:</label>
  <input
    type="text"
    class="form-control"
    id="harga"
    name="harga"
    required />
</div>
<div class="form-group">
  <label for="deskripsi">Deskripsi:</label>
  <input
    type="text"
    class="form-control"
    id="deskripsi"
    name="deskripsi"
    required />
</div>

<div class="form-group">
  <label for="id_chef">Dibuat oleh:</label>
  <select
    class="form-control"
    id="id_chef"
    name="id_chef"
    required>
    <!-- Place options for job titles here -->
    ' . $chef_options . '
    <!-- Add more options as needed -->
  </select>
</div>
<div class="form-group mb-3" >
  <label for="foto_menu">Foto Menu:</label>
  <input
    type="file"
    class="form-control-file"
    id="foto_menu"
    name="foto_menu"
    required />
</div>
<button type="submit" class="btn btn-primary" id="submit" name="submit">
  Tambah Menu
</button>
</form>';


$chef->close();
$menu->close();

// buat instance template
$judul = 'Tambah Menu';
$title = 'Tambah Menu';

// simpan data ke template
$home->replace('DATA_FORM', $data);
$home->replace('DATA_JUDUL', $judul);
$home->replace('DATA_TITLE', $title);
$home->write();
