<?php

class Grafik extends Controller
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
        $data['title'] = 'Data Grafik Parkir';
        $data['motor'] = $this->model('MotorModel')->getAllMotor();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('grafik/index', $data);
        $this->view('templates/footer');
    }
}
