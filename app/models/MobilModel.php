<?php

class MobilModel
{
    private $table = 'mobil';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMobil()
    {
        $query = 'SELECT mobil.*, wilayah.nama_wilayah, juruparkir.nama_juru, koordinator.nama_koor 
              FROM mobil
              LEFT JOIN wilayah ON mobil.wilayah_id = wilayah.id
              LEFT JOIN juruparkir ON mobil.nama_juru = juruparkir.nama_juru
              LEFT JOIN koordinator ON mobil.nama_koor = koordinator.nama_koor';

        $this->db->query($query);

        return $this->db->resultSet();
    }



    public function getMobilById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_mobil=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // ...

    public function tambahMobil($data)
    {
        // Mendapatkan jumlah mobil masuk dan keluar dari formulir
        $mobil_masuk = $data['mobil_masuk'];
        $mobil_keluar = $data['mobil_keluar'];
        $tanggal = $data['tanggal']; // Ambil nilai tanggal dari data

        // Menghitung jumlah mobil yang tersedia
        $jumlah_tersedia = $mobil_masuk - $mobil_keluar;

        // Menambahkan data ke database
        $query = "INSERT INTO mobil(tanggal, wilayah_id, nama_juru, nama_koor, mobil_masuk, mobil_keluar, jumlah) 
              VALUES (:tanggal, :wilayah_id, :nama_juru, :nama_koor, :mobil_masuk, :mobil_keluar, :jumlah)";

        $this->db->query($query);
        $this->db->bind('tanggal', $tanggal); // Binding parameter untuk tanggal
        $this->db->bind('wilayah_id', $data['wilayah_id']);
        $this->db->bind('nama_juru', $data['nama_juru']);
        $this->db->bind('nama_koor', $data['nama_koor']);
        $this->db->bind('mobil_masuk', $mobil_masuk);
        $this->db->bind('mobil_keluar', $mobil_keluar);
        $this->db->bind('jumlah', $jumlah_tersedia); // Menggunakan jumlah yang tersedia

        try {
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage(); // Tambahkan ini untuk menampilkan pesan kesalahan
        }
    }

    public function updateDataMobil($data)
    {
        // Check if the required fields are set
        if (!isset($data['id_mobil'], $data['wilayah_id'], $data['nama_juru'], $data['nama_koor'], $data['mobil_masuk'], $data['mobil_keluar'])) {
            // Handle the case where some required fields are not set
            return 0; // or throw an exception or handle the error as appropriate
        }

        $query = "UPDATE mobil SET wilayah_id=:wilayah_id, nama_juru=:nama_juru, nama_koor=:nama_koor, mobil_masuk=:mobil_masuk, mobil_keluar=:mobil_keluar WHERE id_mobil=:id_mobil";

        $this->db->query($query);
        $this->db->bind('id_mobil', $data['id_mobil']);
        $this->db->bind('wilayah_id', $data['wilayah_id']);
        $this->db->bind('nama_juru', $data['nama_juru']);
        $this->db->bind('nama_koor', $data['nama_koor']);
        $this->db->bind('mobil_masuk', $data['mobil_masuk']);
        $this->db->bind('mobil_keluar', $data['mobil_keluar']);


        try {
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage(); // Tambahkan ini untuk menampilkan pesan kesalahan
            return 0; // or throw an exception or handle the error as appropriate
        }
    }

    public function deleteMobil($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_mobil=:id_mobil');
        $this->db->bind('id_mobil', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariMobil($key)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE tanggal LIKE :key'); // Ganti kolom sesuai dengan nama kolom tanggal di tabel
        $this->db->bind('key', "%$key%");
        return $this->db->resultSet();
    }
}
