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

$chef->getChef();

//jika update menu di klik
if (isset($_POST['submit'])) {
    $id = $_GET['id']; 

    if ($menu->updateData($id, $_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'menu.php?id=$id';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'updateMenu.php?id=$id';
            </script>";
    }
}

//inisialisasi null
$chef_options = '';
$data = null;

//mengisi data menu by id
$id = $_GET['id'];
$menu->getMenuById($id);
$row = $menu->getResult();

$dataNama = $row['nama_menu'];
$dataHarga = $row['harga'];
$dataDeskripsi = $row['deskripsi'];
$dataChef = $row['id_chef'];
$dataFoto = $row['foto_menu'];



$data .= '<form action="updateMenu.php?id='.$id.'" method="POST" enctype="multipart/form-data">
<div class="form-group">
  <label for="nama_menu">Nama Menu:</label>
  <input
  
    type="text"
    class="form-control"
    id="nama_menu"
    name="nama_menu"
    value="'.$dataNama.'"
    required />
</div>
<div class="form-group">
  <label for="harga">Harga:</label>
  <input
    type="text"
    class="form-control"
    id="harga"
    name="harga"
    value="'.$dataHarga.'"
    required />
</div>
<div class="form-group">
  <label for="deskripsi">Deskripsi:</label>
  <input
    type="text"
    class="form-control"
    id="deskripsi"
    name="deskripsi"
    value="'.$dataDeskripsi.'"
    required />
</div>

<div class="form-group">
  <label for="id_chef">Dibuat oleh:</label>
  <select
    class="form-control"
    id="id_chef"
    name="id_chef"
    required>
    .';

while ($row = $chef->getResult()) {
    $selected = ($row['id_chef'] == $dataChef) ? 'selected' : '';
    $data .= '<option value="' . $row['id_chef'] . '" ' . $selected . '>' . $row['nama_chef'] . '</option>';
}

$data .= '</select>
</div>
<div class="form-group mb-3">
  <label for="foto_menu">Foto Menu:</label>
  <input
    type="file"
    class="form-control-file"
    id="foto_menu"
    name="foto_menu"
    required />
</div>
<button type="submit" class="btn btn-primary" id="submit" name="submit">
  Update Menu
</button>
</form>';

$chef->close();
$menu->close();

$judul = 'Update Menu';
$title = 'Update Menu';

$home->replace('DATA_FORM', $data);
$home->replace('DATA_JUDUL', $judul);
$home->replace('DATA_TITLE', $title);
$home->write();
