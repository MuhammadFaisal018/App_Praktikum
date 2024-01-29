<?php

class JuruparkirModel
{
    private $table = 'juruparkir';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllJuruparkir()
    {
        $query = 'SELECT juruparkir.*, wilayah.nama_wilayah 
                  FROM juruparkir
                  LEFT JOIN wilayah ON juruparkir.wilayah_id = wilayah.id';

        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getJuruparkirById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_juru=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahJuruparkir($data)
    {
        $query = "INSERT INTO juruparkir(nama_juru, tempat_tgl_lahir, ktp, alamat, telepon, foto, wilayah_id) VALUES (:nama_juru, :tempat_tgl_lahir, :ktp, :alamat, :telepon, :foto, :wilayah_id)";
        $this->db->query($query);
        $this->db->bind(':nama_juru', $data['nama_juru']);
        $this->db->bind(':tempat_tgl_lahir', $data['tempat_tgl_lahir']);
        $this->db->bind(':ktp', $data['ktp']);
        $this->db->bind(':alamat', $data['alamat']);
        $this->db->bind(':telepon', $data['telepon']);
        $this->db->bind(':wilayah_id', $data['wilayah_id']);

        // Check if foto is uploaded
        $foto = $_FILES['foto'];

        if ($foto['error'] == 0) {
            // Save the uploaded file to a specific directory
            $uploadDirectory = "images/";
            $uploadedFileName = $this->saveUploadedFile($foto, $uploadDirectory);
            // Bind the filename (or path) to the database
            $this->db->bind(':foto', $uploadedFileName);
        } else {
            // Provide a default value if no foto is uploaded
            $this->db->bind(':foto', 'default_filename.jpg');
        }

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Function to save uploaded file and return the filename
    private function saveUploadedFile($file, $uploadDirectory)
    {
        $uploadedFileName = $uploadDirectory . uniqid() . '_' . $file['name'];
        move_uploaded_file($file['tmp_name'], $uploadedFileName);
        return $uploadedFileName;
    }


    public function updateDataJuruparkir($data)
    {
        $query = "UPDATE " . $this->table . " SET nama_juru=:nama_juru, tempat_tgl_lahir=:tempat_tgl_lahir, ktp=:ktp, alamat=:alamat, telepon=:telepon, wilayah_id=:wilayah_id";

        // Check if 'foto' key exists in the data array
        if (isset($data['foto'])) {
            $query .= ", foto=:foto";
        }

        $query .= " WHERE id_juru=:id_juru";

        $this->db->query($query);
        $this->db->bind('id_juru', $data['id_juru']);
        $this->db->bind('nama_juru', $data['nama_juru']);
        $this->db->bind('tempat_tgl_lahir', $data['tempat_tgl_lahir']);
        $this->db->bind('ktp', $data['ktp']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('telepon', $data['telepon']);
        $this->db->bind('wilayah_id', $data['wilayah_id']);

        // Check if 'foto' key exists in the data array
        if (isset($data['foto'])) {
            // Save the uploaded file to a specific directory
            $uploadDirectory = "../images/";
            $uploadedFileName = $this->saveUploadedFile($data['foto'], $uploadDirectory);

            // Bind the filename (or path) to the database
            $this->db->bind('foto', $uploadedFileName);
        }

        $this->db->execute();
        return $this->db->rowCount();
    }


    public function deleteJuruparkir($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_juru=:id_juru');
        $this->db->bind('id_juru', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariJuruparkir($key)
    {
        // Use a proper SQL query with placeholders for the search
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama_juru LIKE :key OR wilayah_id LIKE :key');
        $this->db->bind('key', "%$key%");
        return $this->db->resultSet();
    }
}
