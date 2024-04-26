<?php

class Chef extends DB
{
    function getChefJoin()
    {
        $query = "SELECT * FROM chef JOIN jabatan ON chef.id_jabatan=jabatan.id_jabatan ORDER BY chef.id_chef";

        return $this->execute($query);
    }

    function getChef()
    {
        $query = "SELECT * FROM chef";
        return $this->execute($query);
    }

    function getChefById($id)
    {
        $query = "SELECT * FROM chef JOIN jabatan ON chef.id_jabatan=jabatan.id_jabatan WHERE id_chef=$id";
        return $this->execute($query);
    }

    function searchPengurus($keyword)
    {
        // ...
    }

    function addData($data)
    {
        // ...
        // // Memvalidasi data yang diterima dari form
        // $nama_chef = $data['nama_chef'];
        // $no_telp_chef = $data['no_telp_chef'];
        // $alamat_chef = $data['alamat_chef'];
        // $jenis_kelamin_chef = $data['jenis_kelamin_chef'];
        // $jabatan_chef = $data['jabatan_chef']; // Dapatkan jabatan yang dipilih dari form
        // $foto_chef = $_FILES['foto_chef']['name']; // Dapatkan nama file foto chef

        // // Memproses file foto chef yang diunggah
        // $target_dir = "assets/images/chefs"; // Direktori tempat menyimpan foto chef
        // $target_file = $target_dir . basename($_FILES["foto_chef"]["name"]);
        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // $query = "INSERT INTO chef VALUES('', '$nama_chef', '$no_telp_chef', '$alamat_chef', '$jenis_kelamin_chef', '$foto_chef', '$jabatan_chef')";
        // return $this->executeAffected($query);
        // Memvalidasi data yang diterima dari form
        $nama_chef = $data['nama_chef'];
        $no_telp_chef = $data['no_telp_chef'];
        $alamat_chef = $data['alamat_chef'];
        $jenis_kelamin_chef = $data['jenis_kelamin_chef'];
        $jabatan_chef = $data['id_jabatan']; // Dapatkan jabatan yang dipilih dari form

        // Memproses file foto chef yang diunggah
        $foto_chef = $_FILES['foto_chef']['name']; // Dapatkan nama file foto chef
        $target_dir = "assets/images/chefs/"; // Direktori tempat menyimpan foto chef
        $target_file = $target_dir . basename($_FILES["foto_chef"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file yang diunggah
        if ($_FILES['foto_chef']['error'] !== UPLOAD_ERR_OK) {
            // Handle error upload file
            return false;
        }

        // Pindahkan file ke direktori yang ditentukan
        if (!move_uploaded_file($_FILES["foto_chef"]["tmp_name"], $target_file)) {
            // Handle error pindah file
            return false;
        }

        // Eksekusi query
        $query = "INSERT INTO chef (nama_chef, no_telp_chef, alamat_chef, jenis_kelamin_chef, foto_chef, id_jabatan) VALUES ('$nama_chef', '$no_telp_chef', '$alamat_chef', '$jenis_kelamin_chef', '$foto_chef', '$jabatan_chef')";

        // Buka koneksi dan jalankan query
        $this->open();
        $result = $this->executeAffected($query);
        $this->close();

        return $result;
    }

    function updateData($id, $data)
    {
        // Memvalidasi data yang diterima dari form
        $nama_chef = $data['nama_chef'];
        $no_telp_chef = $data['no_telp_chef'];
        $alamat_chef = $data['alamat_chef'];
        $jenis_kelamin_chef = $data['jenis_kelamin_chef'];
        $jabatan_chef = $data['id_jabatan'];

        // Memproses file foto chef yang diunggah
        $foto_chef = $_FILES['foto_chef']['name']; // Dapatkan nama file foto chef
        $target_dir = "assets/images/chefs/"; // Direktori tempat menyimpan foto chef
        $target_file = $target_dir . basename($_FILES["foto_chef"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file yang diunggah
        if ($_FILES['foto_chef']['error'] !== UPLOAD_ERR_OK) {
            // Handle error upload file
            return false;
        }

        // Pindahkan file ke direktori yang ditentukan
        if (!move_uploaded_file($_FILES["foto_chef"]["tmp_name"], $target_file)) {
            // Handle error pindah file
            return false;
        }




        $query = "UPDATE chef SET nama_chef='$nama_chef', no_telp_chef='$no_telp_chef', alamat_chef='$alamat_chef', jenis_kelamin_chef='$jenis_kelamin_chef', foto_chef='$foto_chef', id_jabatan='$jabatan_chef' WHERE id_chef=$id";
        return $this->executeAffected($query);
    }


    function deleteData($id)
    {
        // ...
        // Query untuk menghapus data berdasarkan ID yang diberikan
        $query = "DELETE FROM chef WHERE id_chef = $id";

        // Eksekusi query
        return $this->executeAffected($query);
    }
}
