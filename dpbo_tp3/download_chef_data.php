<?php
// Koneksi ke database
include('config/db.php');
include('classes/DB.php');
include('classes/Chef.php');

// Inisialisasi objek Chef
$chef = new Chef($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$chef->open();

// Mendapatkan data chef dari database
$chef->getChef();


// Buat file CSV
$output = fopen('php://output', 'w');

// Header untuk file CSV
$header = array("ID Chef", "Nama Chef", "No Telp Chef","Alamat Chef", "Jenis_Kelamin", "Foto Chef", "ID Jabatan");

// Tulis header ke file CSV
fputcsv($output, $header);

// Tulis data chef ke file CSV
while ($row = $chef->getResult()) {
    // Pastikan $row adalah array
    if (is_array($row)) {
        // Ambil nilai dari masing-masing kolom
        $rowData = array(
            $row['id_chef'],
            $row['nama_chef'],
            $row['no_telp_chef'],
            $row['alamat_chef'],
            $row['jenis_kelamin_chef'],
            $row['foto_chef'],
            $row['id_jabatan']
        );

        // Tulis baris data ke file CSV
        fputcsv($output, $rowData);
    } else {
        // Jika $row bukan array, maka ada masalah
        // Anda dapat menambahkan penanganan kesalahan di sini, misalnya:
        echo "Error: Result is not an array!";
    }
}



// Set header untuk memicu unduhan file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="chef_data.csv"');

// Keluar dari skrip
exit;
