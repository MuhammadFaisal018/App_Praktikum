<?php

class KoordinatorModel
{
    private $table = 'koordinator';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllKoordinator()
    {
        $query = 'SELECT koordinator.*, wilayah.nama_wilayah 
                  FROM koordinator
                  LEFT JOIN wilayah ON koordinator.wilayah_id = wilayah.id';

        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getKoordinatorById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_id_koor=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahKoordinator($data)
    {
        $query = "INSERT INTO koordinator(nama_koor, tempat_tgl_lahir, ktp, alamat, telepon, foto, wilayah_id) VALUES (:nama_koor, :tempat_tgl_lahir, :ktp, :alamat, :telepon, :foto, :wilayah_id)";
        $this->db->query($query);
        $this->db->bind('nama_koor', $data['nama_koor']);
        $this->db->bind('tempat_tgl_lahir', $data['tempat_tgl_lahir']);
        $this->db->bind('ktp', $data['ktp']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('telepon', $data['telepon']);
        $this->db->bind('wilayah_id', $data['wilayah_id']);

        // Check if foto is uploaded
        if (isset($data['foto']) && !empty($data['foto'])) {
            // Save the uploaded file to a specific directory
            $uploadDirectory = "pkl/public/dist/img/";
            $uploadedFileName = $this->saveUploadedFile($data['foto'], $uploadDirectory);

            // Bind the filename (or path) to the database
            $this->db->bind('foto', $uploadedFileName);
        } else {
            // Provide a default value if no foto is uploaded
            $this->db->bind('foto', 'default_filename.jpg');
        }

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Function to save uploaded file and return the filename
    private function saveUploadedFile($file, $uploadDirectory)
    {
        $fileName = uniqid() . '_' . basename($file['name']);
        $targetPath = $uploadDirectory . $fileName;

        move_uploaded_file($file['tmp_name'], $targetPath);

        return $fileName;
    }


    public function updateDataKoordinator($data)
    {
        $query = "UPDATE " . $this->table . " SET nama_koor=:nama_koor, tempat_tgl_lahir=:tempat_tgl_lahir, ktp=:ktp, alamat=:alamat, telepon=:telepon, wilayah_id=:wilayah_id";

        // Check if 'foto' key exists in the data array
        if (isset($data['foto'])) {
            $query .= ", foto=:foto";
        }

        $query .= " WHERE id_id_koor=:id_id_koor";

        $this->db->query($query);
        $this->db->bind('id_id_koor', $data['id_id_koor']);
        $this->db->bind('nama_koor', $data['nama_koor']);
        $this->db->bind('tempat_tgl_lahir', $data['tempat_tgl_lahir']);
        $this->db->bind('ktp', $data['ktp']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('telepon', $data['telepon']);

        // Check if 'foto' key exists in the data array
        if (isset($data['foto'])) {
            $this->db->bind('foto', $data['foto']);
        }

        $this->db->bind('wilayah_id', $data['wilayah_id']);

        $this->db->execute();
        return $this->db->rowCount();
    }


    public function deleteKoordinator($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_id_koor=:id_id_koor');
        $this->db->bind('id_id_koor', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariKoordinator($key)
    {
        // Use a proper SQL query with placeholders for the search
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama_koor LIKE :key OR wilayah_id LIKE :key');
        $this->db->bind('key', "%$key%");
        return $this->db->resultSet();
    }
}
