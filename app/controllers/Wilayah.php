<?php
class Wilayah extends Controller
{
    public function __construct()
    {
        if ($_SESSION['session_login'] != 'sudah_login') {
            Flasher::setMessage('Login', 'Tidak ditemukan.', 'danger');
            header('location: ' . base_url . '/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Data Wilayah';
        $data['wilayah'] = $this->model('WilayahModel')->getAllWilayah();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('wilayah/index', $data);
        $this->view('templates/footer');
    }

    public function cari()
    {
        $data['title'] = 'Data Wilayah';
        $data['wilayah'] = $this->model('WilayahModel')->cariWilayah();
        $data['key'] = $_POST['key'];
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('wilayah/index', $data);
        $this->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Wilayah';
        $data['wilayah'] = $this->model('WilayahModel')->getWilayahById($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('wilayah/edit', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Wilayah';
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('wilayah/create', $data);
        $this->view('templates/footer');
    }

    public function simpanWilayah()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nama_wilayah' => $_POST['nama_wilayah']
            ];

            if ($this->model('WilayahModel')->tambahWilayah($data) > 0) {
                Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
                header('location: ' . base_url . '/wilayah');
                exit;
            } else {
                Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
                header('location: ' . base_url . '/wilayah');
                exit;
            }
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/wilayah');
            exit;
        }
    }

    public function updateWilayah()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate input
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $namaWilayah = filter_input(INPUT_POST, 'nama_wilayah', FILTER_SANITIZE_STRING);

            if ($id !== false && $namaWilayah !== false) {
                $data = [
                    'id' => $id,
                    'nama_wilayah' => $namaWilayah
                ];

                $wilayahModel = $this->model('WilayahModel');

                if ($wilayahModel->updateDataWilayah($data) > 0) {
                    Flasher::setMessage('Berhasil', 'diupdate', 'success');
                    header('location:' . base_url . '/wilayah');
                    exit;
                }
            }
        }

        Flasher::setMessage('Gagal', 'diupdate', 'danger');
        header('location:' . base_url . '/wilayah');
        exit;
    }

    public function hapus($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id !== false) {
            $wilayahModel = $this->model('WilayahModel');

            if ($wilayahModel->deleteWilayah($id) > 0) {
                Flasher::setMessage('Berhasil', 'dihapus', 'success');
                header('location:' . base_url . '/wilayah');
                exit;
            }
        }

        Flasher::setMessage('Gagal', 'dihapus', 'danger');
        header('location: ' . base_url . '/wilayah');
        exit;
    }
}
