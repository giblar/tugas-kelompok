<?php
require 'koneksi_mysqli.php';

abstract class Functions
{
    protected $nama;
    protected $nis;

    public function __construct($nama, $nis)
    {
        $this->nama = $nama;
        $this->nis = $nis;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getNis()
    {
        return $this->nis;
    }

    abstract public function hitungGrade();
}

class Siswa extends Functions
{
    private $nilai1;
    private $nilai2;
    private $nilai3;
    private $nilai4;
    private $nilai5;
    private $nilai6;

    public function __construct($nama, $nis, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6)
    {
        parent::__construct($nama, $nis);
        $this->nilai1 = $nilai1;
        $this->nilai2 = $nilai2;
        $this->nilai3 = $nilai3;
        $this->nilai4 = $nilai4;
        $this->nilai5 = $nilai5;
        $this->nilai6 = $nilai6;

        $conn = mysqli_connect("localhost" , "root", "", "db_asesment");
        $sql = "INSERT INTO profil (nama, nis, pipas, pjok, inggris, indo, mtk, paibp) VALUES ('$this->nama', '$this->nis', '$this->nilai1', '$this->nilai2', '$this->nilai3', '$this->nilai4', '$this->nilai5', '$this->nilai6')";
        mysqli_query($conn, $sql);
    }

    public function getTotal()
    {
        return $this->nilai1 + $this->nilai2 + $this->nilai3 + $this->nilai4 + $this->nilai5 + $this->nilai6;
    }

    public function getRata()
    {
        return $this->getTotal() / 6;
    }

    public function getTertinggi()
    {
        return max($this->nilai1, $this->nilai2, $this->nilai3, $this->nilai4, $this->nilai5, $this->nilai6);
    }

    public function getTerendah()
    {
        return min($this->nilai1, $this->nilai2, $this->nilai3, $this->nilai4, $this->nilai5, $this->nilai6);
    }

    public function hitungGrade()
    {
        $rata = $this->getRata();
        if ($rata > 90) {
            return "A";
        } elseif ($rata > 80) {
            return "B";
        } elseif ($rata > 70) {
            return "C";
        } elseif ($rata > 60) {
            return "D";
        } else {
            return "E";
        }
    }
}
