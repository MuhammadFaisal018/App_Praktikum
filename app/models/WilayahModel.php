<?php
class WilayahModel
{
    private $table = 'wilayah';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllWilayah()
    {
        $this->db->query('SELECT * FROM ' . $this->table);

        return $this->db->resultSet();
    }

    public function getWilayahById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function tambahWilayah($data)
    {
        $query = "INSERT INTO wilayah(nama_wilayah) VALUES (:nama_wilayah)";
        $this->db->query($query);
        $this->db->bind('nama_wilayah', $data['nama_wilayah']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDataWilayah($data)
    {
        $query = 'UPDATE wilayah SET nama_wilayah=:nama_wilayah WHERE id=:id';
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama_wilayah', $data['nama_wilayah']);

        return $this->db->rowCount();
    }

    public function deleteWilayah($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariWilayah()
    {
        $key = $_POST['key'];
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama_wilayah LIKE :key');
        $this->db->bind('key', "%$key%");

        return $this->db->resultSet();
    }
}
