<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class JawabanModel extends Model
{
    protected $table            = 'jawaban';
    protected $primaryKey       = 'no_jawaban';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'no_user',
        'hasil',
        'kategori',
        'ttl_pengerjaan',
    ];
    protected $createField  = 'ttl_pengerjaan';

    public function ListJawaban()
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function ListJawabanWhere($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function Hasil($kd_pengerjaan)
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban WHERE kode_pengerjaan = '$kd_pengerjaan' OR status = 'tidak'";
        $queryJawab = $db->query($sql);
        //$dapat_jawab = $queryJawab->resultID->num_rows;
        $jawab = $queryJawab->getResult('array');
        $hasil = $jawab;

        return $hasil;
    }

    public function ListJawabanByKdPengerjaan($kd_pengerjaan)
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban WHERE kode_pengerjaan = '$kd_pengerjaan'";
        $queryJawab = $db->query($sql);
        $jawab = $queryJawab->getResult('array');

        return $jawab;
    }

    public function ListJawabanByStatus()
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban WHERE no_jawaban IN (SELECT MAX(no_jawaban) FROM jawaban) AND status = 'tidak'";
        $queryJawab = $db->query($sql);
        $jawab = $queryJawab->getResult('array');

        return $jawab;
    }

    public function AddJawaban($no_user, $kategori, $jawaban, $no_soal, $kd_pengerjaan)
    {
        //$jawaban = array("", "", "", "", "", "", "", "", "", ""); //Ganti Sesuai Kebutuhan (default 10)
        $DateTime = new Time('now', 'Asia/Jakarta');
        $db = db_connect();
        //$sql = "INSERT INTO jawaban VALUES ('','$no_user','$jawaban[0]\r\n$jawaban[1]\r\n$jawaban[2]\r\n$jawaban[3]\r\n$jawaban[4]\r\n$jawaban[5]\r\n$jawaban[6]\r\n$jawaban[7]\r\n$jawaban[8]\r\n$jawaban[9]','$kategori','$DateTime','tidak')";
        $sql = "INSERT INTO jawaban VALUES ('','$no_user','$jawaban','$kategori','$DateTime','$no_soal','$kd_pengerjaan','tidak')";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }

    public function EditJawaban($kode_soal, $jawaban)
    {
        // $jawaban = array("", "", "", "", "", "", "", "", "", ""); //Ganti Sesuai Kebutuhan (default 10)
        // for ($no = 0; $no < $jumlahsoal; $no++) {
        //     $jawaban[$no] = $jawab[$no];
        // }
        // dd($no_jawaban);
        $db = db_connect();
        $sql = "UPDATE jawaban SET hasil = '$jawaban' WHERE no_soal = '$kode_soal' AND status = 'tidak'";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }

    public function SelesaiMengerjakan($kondisi)
    {
        $db = db_connect();
        $sql = "UPDATE jawaban SET status = 'selesai' WHERE $kondisi";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }
}
