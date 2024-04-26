<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jabatan.php');
include('classes/Template.php');
include('classes/Chef.php');


//buat instance chef
$chef = new Chef($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$chef->open();

$data = nulL;

//mengisi data chef sesuai id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $chef->getChefById($id);
        $row = $chef->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_chef'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/chefs/' . $row['foto_chef'] . '" class="img-thumbnail" alt="' . $row['foto_chef'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama_chef'] . '</td>
                                </tr>
                                <tr>
                                    <td>No Telp</td>
                                    <td>:</td>
                                    <td>' . $row['no_telp_chef'] . '</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>' . $row['alamat_chef'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>' . $row['jenis_kelamin_chef'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>' . $row['nama_jabatan'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="UpdateChef.php?id=' . $id . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $id . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

//jika hapus di klik
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($chef->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'detail.php?id='.$id.';
            </script>";
        }
    }
}

$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_CHEF', $data);
$detail->write();
