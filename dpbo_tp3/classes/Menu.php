<?php

class Menu extends DB
{
    function getMenuJoin()
    {
        $query = "SELECT * FROM menu JOIN chef ON menu.id_chef=chef.id_chef ORDER BY menu.id_menu";

        return $this->execute($query);
    }

    function getMenu()
    {
        $query = "SELECT * FROM menu";
        return $this->execute($query);
    }

    function getMenuById($id)
    {
        $query = "SELECT * FROM menu JOIN chef ON menu.id_chef=chef.id_chef WHERE id_menu=$id";
        return $this->execute($query);
    }

    function searchPengurus($keyword)
    {
        // ...
    }

    function addData($data)
    {
        // ...
        // Memvalidasi data yang diterima dari form
        $nama_menu = $data['nama_menu'];
        $harga = $data['harga'];
        $deskripsi = $data['deskripsi'];
        // $jenis_kelamin_chef = $data['jenis_kelamin_chef'];
        $dibuat_oleh = $data['id_chef'];

        // Memproses file foto chef yang diunggah
        $foto_menu = $_FILES['foto_menu']['name']; // Dapatkan nama file foto chef
        $target_dir = "assets/images/"; // Direktori tempat menyimpan foto chef
        $target_file = $target_dir . basename($_FILES["foto_menu"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file yang diunggah
        if ($_FILES['foto_menu']['error'] !== UPLOAD_ERR_OK) {
            // Handle error upload file
            return false;
        }

        // Pindahkan file ke direktori yang ditentukan
        if (!move_uploaded_file($_FILES["foto_menu"]["tmp_name"], $target_file)) {
            // Handle error pindah file
            return false;
        }
        $query = "INSERT INTO menu (nama_menu, harga, deskripsi, foto_menu, id_chef) VALUES ('$nama_menu', '$harga', '$deskripsi', '$foto_menu', '$dibuat_oleh')";

        // Buka koneksi dan jalankan query
        $this->open();
        $result = $this->executeAffected($query);
        $this->close();

        return $result;
    }

    function updateData($id, $data)
    {
        // ...
        // Memvalidasi data yang diterima dari form
        $nama_menu = $data['nama_menu'];
        $harga = $data['harga'];
        $deskripsi = $data['deskripsi'];
        // $jenis_kelamin_chef = $data['jenis_kelamin_chef'];
        $dibuat_oleh = $data['id_chef'];

        // Memproses file foto chef yang diunggah
        $foto_menu = $_FILES['foto_menu']['name']; // Dapatkan nama file foto chef
        $target_dir = "assets/images/"; // Direktori tempat menyimpan foto chef
        $target_file = $target_dir . basename($_FILES["foto_menu"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file yang diunggah
        if ($_FILES['foto_menu']['error'] !== UPLOAD_ERR_OK) {
            // Handle error upload file
            return false;
        }

        // Pindahkan file ke direktori yang ditentukan
        if (!move_uploaded_file($_FILES["foto_menu"]["tmp_name"], $target_file)) {
            // Handle error pindah file
            return false;
        }


        // $query = "UPDATE menu SET nama_menu='$nama_menu' WHERE id_menu=$id";

        $query = "UPDATE menu SET nama_menu='$nama_menu', harga='$harga', deskripsi='$deskripsi', foto_menu='$foto_menu', id_chef='$dibuat_oleh' WHERE id_menu=$id";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        // ...
        // Query untuk menghapus data berdasarkan ID yang diberikan
        $query = "DELETE FROM menu WHERE id_menu = $id";

        // Eksekusi query
        return $this->executeAffected($query);
    }
}
