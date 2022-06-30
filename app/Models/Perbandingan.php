<?php

namespace App\Models;

use CodeIgniter\Model;

class Perbandingan extends Model
{
    /* LIST PERBANDINGAN BERDASARKAN ID USER */
    public function ListPerbandingan($kondisi) //Digunakan untuk mengambil list jawaban dengan no_soal tidak boleh sama
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT kategori, status, ttl_selesai FROM jawaban WHERE " . $kondisi . " GROUP BY ttl_selesai";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function ListPerbandingan_2($kondisi) //Digunakan untuk mengambil list jawaban dengan no_soal tidak boleh sama
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT status, ttl_selesai FROM jawaban_user2 WHERE " . $kondisi . " GROUP BY ttl_selesai";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    /* =========================================== */
    /* LIST PERBANDINGAN BERDASARKAN ttl_selesai*/
    public function UserPerbandingan($kondisi) //Digunakan untuk mengambil list jawaban dengan no_soal tidak boleh sama
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT no_user FROM jawaban WHERE " . $kondisi . " ORDER BY no_user";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function UserPerbandingan_2($kondisi) //Digunakan untuk mengambil list jawaban dengan no_soal tidak boleh sama
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT no_user FROM jawaban_user2 WHERE " . $kondisi . " ORDER BY no_user";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    /* =========================================== */

    public function DataPerbandingan($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban WHERE " . $kondisi . "ORDER BY no_jawaban ASC";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    public function DataPerbandinganNoSoal($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT no_soal, kategori FROM jawaban WHERE " . $kondisi . " GROUP BY no_soal ORDER BY no_soal ASC";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    public function DataPerbandinganKategori($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT no_soal, kategori FROM jawaban WHERE " . $kondisi . " GROUP BY kategori ORDER BY kategori ASC";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function DataPerbandingan_2($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM jawaban_user2 WHERE " . $kondisi . "ORDER BY no_jawaban ASC";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    public function DataPerbandingan_2NoSoal($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT no_soal, kategori FROM jawaban_user2 WHERE " . $kondisi . " GROUP BY no_soal ORDER BY no_soal ASC";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
    public function DataPerbandingan_2Kategori($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT DISTINCT no_soal, kategori FROM jawaban_user2 WHERE " . $kondisi . " GROUP BY kategori ORDER BY kategori ASC";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }
}
