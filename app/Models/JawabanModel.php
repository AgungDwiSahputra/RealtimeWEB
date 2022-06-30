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

    /* LIST JAWABAN DENGAN KONDISI */
    // Bagian Admin dan User 1
    public function ListJawabanWhere($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    public function ListJawabanWhereF($kondisi) //Digunakan untuk mengambil list jawaban dengan no_soal tidak boleh sama
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT no_soal FROM jawaban WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function AddJawaban($no_user, $kategori, $jawaban, $no_soal, $kode_soal)
    {
        $DateTime = new Time('now', 'Asia/Jakarta');
        $db = db_connect();
        $sql = "INSERT INTO jawaban VALUES ('','$no_user','$jawaban','$kategori','$DateTime','$no_soal','$kode_soal','tidak','')";
        $queryJawab = $db->query($sql);
        return $queryJawab;
    }
    /* MENGAMBIL LIST JAWABAN DENGAN PERBEDAAN LEVEL
    Jika Level user2 maka ngambil list jawaban_user2
    Jika Admin/user1 maka mengambil list jawaban */

    public function EditJawaban($no_soal, $jawaban)
    {
        $db = db_connect();
        $sql = "UPDATE jawaban SET hasil = '$jawaban' WHERE no_soal = '$no_soal' AND status = 'tidak'";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }

    public function DeleteJawaban($no_jawaban)
    {
        // DELETE FROM `jawaban` WHERE `jawaban`.`no_jawaban` = 175
        $db = db_connect();
        $sql = "DELETE FROM jawaban WHERE no_jawaban = '$no_jawaban'";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }

    public function SelesaiMengerjakan($DateTime, $kondisi)
    {
        $db = db_connect();
        $sql = "UPDATE jawaban SET status = 'selesai', ttl_selesai = '$DateTime' WHERE $kondisi";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }
    //-------------------------------------------------------------------
    // Bagian level User 2
    public function AddJawaban_2($no_user, $kategori, $jawaban, $no_soal, $kode_soal)
    {
        $DateTime = new Time('now', 'Asia/Jakarta');
        $db = db_connect();
        $sql = "INSERT INTO jawaban_user2 VALUES ('','$no_user','$jawaban','$kategori','$DateTime','$no_soal','$kode_soal','tidak','')";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }

    public function ListJawabanWhere_2($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban_user2 WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    public function ListJawabanWhereF_2($kondisi) //Digunakan untuk mengambil list jawaban dengan no_soal tidak boleh sama
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT no_soal FROM jawaban_user2 WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function EditJawaban_2($no_soal, $jawaban, $no_user)
    {
        $db = db_connect();
        $sql = "UPDATE jawaban_user2 SET hasil = '$jawaban', no_user = '$no_user' WHERE no_soal = '$no_soal' AND status = 'tidak'";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }

    public function DeleteJawaban_2($no_jawaban)
    {
        // DELETE FROM `jawaban` WHERE `jawaban`.`no_jawaban` = 175
        $db = db_connect();
        $sql = "DELETE FROM jawaban_user2 WHERE no_jawaban = '$no_jawaban'";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }

    public function SelesaiMengerjakan_2($DateTime, $kondisi)
    {
        $db = db_connect();
        $sql = "UPDATE jawaban_user2 SET status = 'selesai', ttl_selesai = '$DateTime' WHERE $kondisi";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }
    /* ==================================================================== */

    // public function AddJawaban($no_user, $kategori, $jawaban, $no_soal, $kode_soal)
    // {
    //     $DateTime = new Time('now', 'Asia/Jakarta');
    //     $db = db_connect();
    //     $sql = "INSERT INTO jawaban VALUES ('','$no_user','$jawaban','$kategori','$DateTime','$no_soal','$kode_soal','tidak','')";
    //     $queryJawab = $db->query($sql);
    //     $sql1 = "INSERT INTO jawaban_user2 VALUES ('','$no_user','$jawaban','$kategori','$DateTime','$no_soal','$kode_soal','tidak','')";
    //     $db->query($sql1);
    //     return $queryJawab;
    // }
}
