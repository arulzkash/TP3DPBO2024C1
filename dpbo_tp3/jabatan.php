<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Jabatan.php');

//instantiasi jabatan
$jabatan = new Jabatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$view = new Template('templates/skintabel.html');
$jabatan->open();
$jabatan->getJabatan();



$mainTitle = 'Jabatan';
$header = '<th scope="col"><a href="?sort=id_jabatan">No.</a></th>
<th scope="col"><a href="?sort=nama_jabatan">Nama Jabatan</a></th>
<th scope="col">Aksi</th>';
$data = null;
$title = 'Daftar Jabatan';
$judul_cari = 'jabatan';
$no = 1;

//jika sort diklik
if (isset($_GET['sort'])) {
    $sortBy = $_GET['sort'];

    // Memastikan bahwa hanya nilai yang diperbolehkan yang dapat digunakan untuk mengurutkan
    if ($sortBy == 'id_jabatan' || $sortBy == 'nama_jabatan') {
        // Modifikasi query SQL untuk mengurutkan data sesuai permintaan pengguna
        $jabatan->getJabatan($sortBy);
    }
}

//isi data listjabatan
while ($jab = $jabatan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $jab['nama_jabatan'] . '</td>
    <td style="font-size: 22px;">
        <a href="updateJabatan.php?id=' . $jab['id_jabatan'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="jabatan.php?hapus=' . $jab['id_jabatan'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

//jika search di klik
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $jabatan->searchJabatan($keyword);

    // Periksa apakah ada hasil pencarian yang tersedia
    if ($jabatan) {
        $data = ''; // Kosongkan data sebelum menampilkan hasil pencarian
        $no = 1;
        // Tampilkan hasil pencarian
        while ($jab = $jabatan->getResult()) {
            $data .= '<tr>
                <th scope="row">' . $no . '</th>
                <td>' . $jab['nama_jabatan'] . '</td>
                <td style="font-size: 22px;">
                    <a href="updateJabatan.php?id=' . $jab['id_jabatan'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="divisi.php?hapus=' . $jab['id_jabatan'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
                    </td>
                </tr>';
            $no++;
        }
    } else {
        // Tampilkan pesan bahwa tidak ada hasil pencarian yang ditemukan
        $data = '<tr><td colspan="3">Tidak ada hasil pencarian yang ditemukan.</td></tr>';
    }
}


//jika hapus di klik
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($jabatan->deleteJabatan($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'jabatan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'jabatan.php';
            </script>";
        }
    }
}


$judul_tambah = 'Jabatan';
$link_tambah = 'tambahJabatan.php';

$jabatan->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('JUDUL_CARI', $judul_cari);
$view->replace('JUDUL_TAMBAH', $judul_tambah);
$view->replace('LINK_TAMBAH', $link_tambah);
$view->replace('DATA_TABEL', $data);
$view->write();
