<?php

class Motor extends Controller
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
        $data['title'] = 'Data Motor Parkir';
        $data['motor'] = $this->model('MotorModel')->getAllMotor();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('motor/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Motor';
        $data['wilayah'] = $this->model('WilayahModel')->getAllWilayah();
        $data['juruparkir'] = $this->model('JuruparkirModel')->getAllJuruparkir();
        $data['koordinator'] = $this->model('KoordinatorModel')->getAllKoordinator();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('motor/create', $data);
        $this->view('templates/footer');
    }

    public function simpanMotor()
    {
        if ($this->model('MotorModel')->tambahMotor($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/motor');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/motor');
            exit;
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Motor';
        $data['motor'] = $this->model('MotorModel')->getMotorById($id);
        $data['wilayah'] = $this->model('WilayahModel')->getAllWilayah();
        $data['juruparkir'] = $this->model('JuruparkirModel')->getAllJuruparkir();
        $data['koordinator'] = $this->model('KoordinatorModel')->getAllKoordinator();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('motor/edit', $data);
        $this->view('templates/footer');
    }

    public function updateMotor()
    {
        if ($this->model('MotorModel')->updateDataMotor($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location: ' . base_url . '/motor');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location: ' . base_url . '/motor');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('MotorModel')->deleteMotor($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location: ' . base_url . '/motor');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/motor');
            exit;
        }
    }

    public function cari()
    {
        $data['title'] = 'Data Motor';
        $key = $_POST['key']; // Ambil nilai kunci pencarian
        $data['motor'] = $this->model('MotorModel')->cariMotor($key);
        $data['key'] = $key;
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('motor/index', $data);
        $this->view('templates/footer');
    }


    public function lihatlaporan()
    {
        $data['title'] = 'Data Laporan Motor';
        $data['motor'] = $this->model('MotorModel')->getAllMotor();
        $this->view('motor/lihatlaporan', $data);
    }


    public function laporan()
    {
        $data['motor'] = $this->model('MotorModel')->getAllMotor();
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
        $pdf->Cell(190, 7, 'LAPORAN DATA MOTOR PARKIR', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(30);
        $pdf->Cell(8, 6, 'No', 1);
        $pdf->Cell(25, 6, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Wilayah', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Juru Parkir', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Koordinator Parkir', 1);
        $pdf->Cell(20, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['motor'] as $row) {
            $pdf->SetX(30);
            $pdf->Cell(8, 6, $row['id_motor'], 1, 0, 'C');
            $pdf->Cell(25, 6, $row['tanggal'], 1, 0, 'C');
            $pdf->Cell(20, 6, $row['wilayah_id'], 1, 0, 'C');
            $pdf->Cell(40, 6, $row['nama_juru'], 1);
            $pdf->Cell(35, 6, $row['nama_koor'], 1);
            $pdf->Cell(20, 6, $row['jumlah'], 1, 0, 'C');
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

        $pdf->Output('I', 'Laporan Motor.pdf', true);
    }

    public function fetchMotorChartData()
    {
        $data['motorChartData'] = $this->model('MotorModel')->getDataGrafikMotor();
        echo json_encode($data);
    }
}
