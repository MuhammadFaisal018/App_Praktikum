<?php

class Juruparkir extends Controller
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
        $data['title'] = 'Data Juruparkir';
        $data['juruparkir'] = $this->model('JuruparkirModel')->getAllJuruparkir();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('juruparkir/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Juruparkir';
        $data['wilayah'] = $this->model('WilayahModel')->getAllWilayah();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('juruparkir/create', $data);
        $this->view('templates/footer');
    }

    public function simpanJuruparkir()
    {
        if ($this->model('JuruparkirModel')->tambahJuruparkir($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/juruparkir');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/juruparkir');
            exit;
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Juruparkir';
        $data['juruparkir'] = $this->model('JuruparkirModel')->getJuruparkirById($id);
        $data['wilayah'] = $this->model('WilayahModel')->getAllWilayah();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('juruparkir/edit', $data);
        $this->view('templates/footer');
    }

    public function updateJuruparkir()
    {
        if ($this->model('JuruparkirModel')->updateDataJuruparkir($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location: ' . base_url . '/juruparkir');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location: ' . base_url . '/juruparkir');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('JuruparkirModel')->deleteJuruparkir($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location: ' . base_url . '/juruparkir');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/juruparkir');
            exit;
        }
    }

    public function cari()
    {
        $data['title'] = 'Data Juruparkir';

        // Check if the key is set in $_POST before using it
        $data['key'] = isset($_POST['key']) ? $_POST['key'] : '';

        // Pass $data['key'] as an argument to the model function
        $data['juruparkir'] = $this->model('JuruparkirModel')->cariJuruparkir($data['key']);

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('juruparkir/index', $data);
        $this->view('templates/footer');
    }


    public function lihatlaporan()
    {
        $data['title'] = 'Data Laporan Juru parkir';
        $data['juruparkir'] = $this->model('JuruparkirModel')->getAllJuruparkir();
        $this->view('juruparkir/lihatlaporan', $data);
    }


    public function laporan()
    {
        $data['juruparkir'] = $this->model('JuruparkirModel')->getAllJuruparkir();
        $pdf = new FPDF('p', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Image(base_url . './dist/img/Dishub.png', $pdf->GetX(), $pdf->GetY(), 20); // Sesuaikan lebar gambar (200) sesuai kebutuhan
        $pdf->Ln();

        $pdf->Cell(190, 7, 'PEMERINTAH KOTA BANJARMASIN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 6, 'DINAS PERHUBUNGAN KOTA BANJARMASIN', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(190, 5, 'Jl. Karya Bakti No.54, Kuin Cerucuk, Banjarmasin Barat Kota Banjarmasin', 0, 1, 'C');
        $pdf->Cell(190, 3, 'Kalimantan Selatan 70128', 0, 1, 'C');
        $pdf->SetTextColor(0, 0, 255); // Set text color to blue
        $pdf->Cell(190, 7, 'Email : dishubkotabjm@gmail.com', 0, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetLineWidth(1); // Set ketebalan garis menjadi 1 mm
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 190, $pdf->GetY());
        $pdf->SetLineWidth(0.2);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 7, 'Cetak : Admin', 0, 0, 'C');
        $pdf->Cell(285, 7, 'Tanggal : ' . date('d F Y'), 0, 1, 'C');
        $pdf->Cell(25, 5, 'Filter : Semua', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'LAPORAN DATA JURU PARKIR', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(8, 6, 'No', 1);
        $pdf->Cell(25, 6, 'Nama Juruparkir', 1);
        $pdf->Cell(38, 6, 'Tempat/Tanggal Lahir', 1, 0, 'C');
        $pdf->Cell(30, 6, 'KTP', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Alamat', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Telepon', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Foto ', 1, 0, 'C');
        $pdf->Cell(15, 6, 'Wilayah ', 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);


        foreach ($data['juruparkir'] as $row) {
            $pdf->Cell(8, 6, $row['id_juru'], 1, 0, 'C');
            $pdf->Cell(25, 6, $row['nama_juru'], 1);
            $pdf->Cell(38, 6, $row['tempat_tgl_lahir'], 1);
            $pdf->Cell(30, 6, $row['ktp'], 1);
            $pdf->Cell(25, 6, $row['alamat'], 1);
            $pdf->Cell(25, 6, $row['telepon'], 1);
            $pdf->Cell(25, 6, $row['foto'], 1);
            $pdf->Cell(15, 6, $row['wilayah_id'], 1, 0, 'C');
            $pdf->Ln();
        }

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(335, 5, 'Banjarmasin, ' . date('d F Y'), 0, 1, 'C');
        $pdf->Cell(313, 3, 'Kepala Dinas', 0, 1, 'C');
        $pdf->Ln(25);
        $pdf->Cell(338, 5, 'H. SELAMET BEGJO A. TD. MD', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(313, 3, 'Kepala Dinas', 0, 1, 'C');

        $pdf->Output('I', 'Laporan Juruparkir.pdf', true);
    }
}
