<?php

class Jabatan extends DB
{
    function getJabatan($sortBy = null) {
        $query = "SELECT * FROM jabatan";
        
        if ($sortBy) {
            $query .= " ORDER BY $sortBy";
        }

        return $this->execute($query);
    }

    function getJabatanById($id)
    {
        $query = "SELECT * FROM jabatan WHERE id_jabatan=$id";
        return $this->execute($query);
    }

    function searchJabatan($keyword) {
        $query = "SELECT * FROM jabatan WHERE nama_jabatan LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addJabatan($data)
    {
        // ...
        $nama_jabatan = $data['nama_jabatan'];
        

        // Eksekusi query
        $query = "INSERT INTO jabatan (nama_jabatan) VALUES ('$nama_jabatan')";

        // Buka koneksi dan jalankan query
        $this->open();
        $result = $this->executeAffected($query);
        $this->close();

        return $result;
    }

    function updateJabatan($id, $data)
    {
        // ...
        $nama_jabatan = $data['nama_jabatan'];
        

        // Eksekusi query
        $query = "UPDATE jabatan SET nama_jabatan='$nama_jabatan' WHERE id_jabatan=$id";

        // Buka koneksi dan jalankan query
        $this->open();
        $result = $this->executeAffected($query);
        $this->close();

        return $result;
    }

    function deleteJabatan($id)
    {
        // ...
        // Query untuk menghapus data berdasarkan ID yang diberikan
        $query = "DELETE FROM jabatan WHERE id_jabatan = $id";

        // Eksekusi query
        return $this->executeAffected($query);
    }
}
