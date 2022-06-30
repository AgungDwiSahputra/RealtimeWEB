<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class PengerjaanModel extends Model
{
    public function AddPengerjaan($no_user, $kategori, $no_soal)
    {
        $DateTime = new Time('now', 'Asia/Jakarta');
        $db = db_connect();
        $sql = "INSERT INTO pengerjaan VALUES ('','$no_user','$kategori','$DateTime','$no_soal','','tidak')";
        $queryJawab = $db->query($sql);
        return $queryJawab;
    }

    public function ListPengerjaanWhere($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM pengerjaan WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    public function SelesaiMengerjakan($DateTime, $kondisi)
    {
        $db = db_connect();
        $sql = "UPDATE pengerjaan SET status = 'selesai', ttl_selesai = '$DateTime' WHERE $kondisi";
        $queryJawab = $db->query($sql);

        return $queryJawab;
    }
}
