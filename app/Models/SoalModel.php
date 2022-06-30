<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table            = 'soal';
    protected $primaryKey       = 'no_soal';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'pertanyaan',
        'kategori',
    ];

    public function ListSoal()
    {
        $db = db_connect();
        $sql = "SELECT * FROM soal";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function ListSoalWhere($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM soal WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function ListSoalMax()
    {
        $db = db_connect();
        $sql = "SELECT * FROM soal WHERE no_soal IN(SELECT MAX(no_soal) FROM soal)";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function AddSoal($no, $pertanyaan, $kategori)
    {
        $db = db_connect();
        $sql = "INSERT INTO soal VALUES ('$no','$pertanyaan','$kategori')";
        $query = $db->query($sql);

        return $query;
    }

    public function EditSoal($no, $pertanyaan, $kategori)
    {
        $db = db_connect();
        $sql = "UPDATE soal SET pertanyaan = '$pertanyaan', kategori = '$kategori' WHERE no_soal = '$no'";
        $query = $db->query($sql);

        return $query;
    }

    public function DeleteSoal($no)
    {
        $db = db_connect();
        $sql = "DELETE FROM soal WHERE no_soal = '$no'";
        $query = $db->query($sql);

        return $query;
    }

    public function JumlahSoal($kategori)
    {
        $db = db_connect();
        $sql = "SELECT * FROM soal WHERE kategori = '$kategori'";
        $query = $db->query($sql);
        $result = $query->getNumRows();

        return $result;
    }
}
