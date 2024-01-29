<?php

class MotorModel
{
    private $table = 'motor';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMotor()
    {
        $query = 'SELECT motor.*, wilayah.nama_wilayah, juruparkir.nama_juru, koordinator.nama_koor 
              FROM motor
              LEFT JOIN wilayah ON motor.wilayah_id = wilayah.id
              LEFT JOIN juruparkir ON motor.nama_juru = juruparkir.nama_juru
              LEFT JOIN koordinator ON motor.nama_koor = koordinator.nama_koor';

        $this->db->query($query);

        return $this->db->resultSet();
    }



    public function getMotorById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_motor=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // ...

    public function tambahMotor($data)
    {
        // Mendapatkan jumlah motor masuk dan keluar dari formulir
        $motor_masuk = $data['motor_masuk'];
        $motor_keluar = $data['motor_keluar'];
        $tanggal = $data['tanggal']; // Ambil nilai tanggal dari data

        // Menghitung jumlah motor yang tersedia
        $jumlah_tersedia = $motor_masuk - $motor_keluar;

        // Menambahkan data ke database
        $query = "INSERT INTO motor(tanggal, wilayah_id, nama_juru, nama_koor, motor_masuk, motor_keluar, jumlah) 
              VALUES (:tanggal, :wilayah_id, :nama_juru, :nama_koor, :motor_masuk, :motor_keluar, :jumlah)";

        $this->db->query($query);
        $this->db->bind('tanggal', $tanggal); // Binding parameter untuk tanggal
        $this->db->bind('wilayah_id', $data['wilayah_id']);
        $this->db->bind('nama_juru', $data['nama_juru']);
        $this->db->bind('nama_koor', $data['nama_koor']);
        $this->db->bind('motor_masuk', $motor_masuk);
        $this->db->bind('motor_keluar', $motor_keluar);
        $this->db->bind('jumlah', $jumlah_tersedia); // Menggunakan jumlah yang tersedia

        try {
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage(); // Tambahkan ini untuk menampilkan pesan kesalahan
        }
    }



    public function updateDataMotor($data)
    {
        // Check if the required fields are set
        if (!isset($data['id_motor'], $data['wilayah_id'], $data['nama_juru'], $data['nama_koor'], $data['motor_masuk'], $data['motor_keluar'])) {
            // Handle the case where some required fields are not set
            return 0; // or throw an exception or handle the error as appropriate
        }

        $query = "UPDATE motor SET wilayah_id=:wilayah_id, nama_juru=:nama_juru, nama_koor=:nama_koor, motor_masuk=:motor_masuk, motor_keluar=:motor_keluar WHERE id_motor=:id_motor";

        $this->db->query($query);
        $this->db->bind('id_motor', $data['id_motor']);
        $this->db->bind('wilayah_id', $data['wilayah_id']);
        $this->db->bind('nama_juru', $data['nama_juru']);
        $this->db->bind('nama_koor', $data['nama_koor']);
        $this->db->bind('motor_masuk', $data['motor_masuk']);
        $this->db->bind('motor_keluar', $data['motor_keluar']);


        try {
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage(); // Tambahkan ini untuk menampilkan pesan kesalahan
            return 0; // or throw an exception or handle the error as appropriate
        }
    }



    public function deleteMotor($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_motor=:id_motor');
        $this->db->bind('id_motor', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariMotor($key)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE tanggal LIKE :key'); // Ganti kolom sesuai dengan nama kolom tanggal di tabel
        $this->db->bind('key', "%$key%");
        return $this->db->resultSet();
    }

    public function getMotorChartData()
    {
        $query = 'SELECT DATE_FORMAT(tanggal, "%Y-%m") as bulan, wilayah.nama_wilayah, SUM(jumlah) as total_motor
                  FROM motor
                  LEFT JOIN wilayah ON motor.wilayah_id = wilayah.id
                  GROUP BY bulan, wilayah.nama_wilayah
                  ORDER BY bulan';

        $this->db->query($query);
        $result = $this->db->resultSet();

        // Ensure the data is not empty
        if (empty($result)) {
            return [];
        }

        // Adjust the format of the data to match the expected structure
        $formattedData = [];
        foreach ($result as $row) {
            $formattedData[] = [
                'bulan' => $row['bulan'],
                'wilayah' => $row['nama_wilayah'],
                'total_motor' => (int)$row['total_motor'],
            ];
        }

        return $formattedData;
    }

    public function getGrafikMotor()
    {
        // Use the data from getMotorChartData for the chart
        $chartData = $this->getMotorChartData();

        // Adjust the format of the data to match the expected structure
        $formattedData = [];
        foreach ($chartData as $row) {
            $formattedData[] = [
                'wilayah' => $row['wilayah'],
                'jumlah' => $row['total_motor'],
            ];
        }

        return $formattedData;
    }

    // Add the following method
    public function getDataGrafikMotor()
    {
        // Adjust the format of the data to match the expected structure
        return [
            ['label' => 'Wilayah A', 'value' => 10],  // Change 'label' and 'value' as needed
            ['label' => 'Wilayah B', 'value' => 15],  // Adjust the values based on your data
            // ... other data ...
        ];
    }
}
