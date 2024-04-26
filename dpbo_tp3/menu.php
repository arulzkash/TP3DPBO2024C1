<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Jabatan.php');
include('classes/Menu.php');

//instansiasi menu
$menu = new Menu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$view = new Template('templates/skintabel.html');

$menu->open();
$menu->getMenuJoin();


$mainTitle = 'Menu';
$header =
  '<tr>
    <th scope="row">No</th>
    <th scope="col">Foto Menu</th>
    <th scope="col">Nama Menu</th>
    <th scope="col">Harga</th>
    <th scope="col">Deskripsi</th>
    <th scope="col">Dibuat oleh Chef</th>
    <th scope="row">Aksi</th>
  </tr>';
$data = null;
$no = 1;
$title = 'Daftar Menu';

//mengisi data menu
while ($men = $menu->getResult()) {
  $data .= '
    <tr>
        <th scope="row">' . $no . '</th>
          <td>
            <img src="assets/images/' . $men['foto_menu'] . '"" class="card-img-top""
            alt="' . $men['foto_menu'] . '" />
          </td>
          <td>' . $men['nama_menu'] . '</td>
          <td>' . $men['harga'] . '</td>
          <td>' . $men['deskripsi'] . '</td>
          <td>' . $men['nama_chef'] . '</td>
          <td style="font-size: 22px;">
            <a href="updateMenu.php?id=' . $men['id_menu'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="menu.php?hapus=' . $men['id_menu'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
          </td>
        </td>
    </tr>';
  $no++;
}

//jika hapus di klik
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  if ($id > 0) {
    if ($menu->deleteData($id) > 0) {
      echo "<script>
              alert('Data berhasil dihapus!');
              document.location.href = 'menu.php';
          </script>";
    } else {
      echo "<script>
              alert('Data gagal dihapus!');
              document.location.href = 'menu.php';
          </script>";
    }
  }
}


$judul_cari = 'menu';
$judul_tambah = 'Menu';
$link_tambah = 'tambahMenu.php';

$menu->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('JUDUL_CARI', $judul_cari);
$view->replace('JUDUL_TAMBAH', $judul_tambah);
$view->replace('LINK_TAMBAH', $link_tambah);
$view->replace('DATA_TABEL', $data);
$view->write();
