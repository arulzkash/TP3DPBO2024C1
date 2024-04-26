<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jabatan.php');
include('classes/Template.php');
include('classes/Chef.php');

$listJabatan = new Jabatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$chef = new Chef($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$home = new Template('templates/tambahupdate.html');

$data = '';

$chef->open();
$listJabatan->open();
$listJabatan->getJabatan();

//jika update chef di klik
if (isset($_POST['submit'])) {
    $id = $_GET['id']; // Ambil id chef dari URL
    
    if ($chef->updateData($id, $_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'detail.php?id=$id';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'updateChef.php?id=$id';
            </script>";
    }
    
}

//mengisi data chef by id
$id = $_GET['id'];
$chef->getChefById($id);
$row = $chef->getResult();

$dataNama = $row['nama_chef'];
$dataNoTelp = $row['no_telp_chef'];
$dataAlamat = $row['alamat_chef'];
$dataJenisKelamin = $row['jenis_kelamin_chef'];
$dataJabatan = $row['id_jabatan'];
$dataFoto = $row['foto_chef'];

$data .= '<form action="updateChef.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nama_chef">Nama Chef:</label>
              <input
                type="text"
                class="form-control"
                id="nama_chef"
                name="nama_chef"
                value="' . $dataNama . '"
                required />
            </div>
            <div class="form-group">
              <label for="no_telp_chef">No. Telepon:</label>
              <input
                type="text"
                class="form-control"
                id="no_telp_chef"
                name="no_telp_chef"
                value="' . $dataNoTelp . '"
                required />
            </div>
            <div class="form-group">
              <label for="alamat_chef">Alamat:</label>
              <input
                type="text"
                class="form-control"
                id="alamat_chef"
                name="alamat_chef"
                value="' . $dataAlamat . '"
                required />
            </div>
            <div class="form-group">
              <label for="jenis_kelamin_chef">Jenis Kelamin:</label>
              <select
                class="form-control"
                id="jenis_kelamin_chef"
                name="jenis_kelamin_chef"
                required>
                <option value="Laki-laki"' . ($dataJenisKelamin == "Laki-laki" ? ' selected' : '') . '>Laki-laki</option>
                <option value="Perempuan"' . ($dataJenisKelamin == "Perempuan" ? ' selected' : '') . '>Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="id_jabatan">Jabatan:</label>
              <select
                class="form-control"
                id="id_jabatan"
                name="id_jabatan"
                required>';

while ($row = $listJabatan->getResult()) {
    $selected = ($row['id_jabatan'] == $dataJabatan) ? 'selected' : '';
    $data .= '<option value="' . $row['id_jabatan'] . '" ' . $selected . '>' . $row['nama_jabatan'] . '</option>';
}

$data .= '</select>
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
              Update Chef
            </button>
          </form>';

$listJabatan->close();
$chef->close();

$judul = 'Update Chef';
$title = 'Update Chef';

$home->replace('DATA_FORM', $data);
$home->replace('DATA_JUDUL', $judul);
$home->replace('DATA_TITLE', $title);
$home->write();
?>
