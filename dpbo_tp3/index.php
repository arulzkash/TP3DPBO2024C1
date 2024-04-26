<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Chef.php');

// buat instance chef
$listChef = new Chef($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);


// buka koneksi
$listChef->open();
// tampilkan data pengurus
$listChef->getChefJoin();



$data = null;

while ($row = $listChef->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['id_chef'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/chefs/' . $row['foto_chef'] . '" class="card-img-top" alt="' . $row['foto_chef'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['nama_chef'] . '</p>
                <p class="card-text divisi-nama">' . $row['no_telp_chef'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['nama_jabatan'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listChef->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_CHEF', $data);
$home->write();
