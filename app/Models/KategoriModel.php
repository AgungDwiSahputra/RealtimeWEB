<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    public function ListKategori()
    {
        $db = db_connect();
        $sql = "SELECT * FROM kategori";
        $query = $db->query($sql);
        $result = $query->getResultArray();

        return $result;
    }

    public function ListKategoriWhere($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM kategori WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResultArray();

        return $result;
    }

    public function ListKategoriMax()
    {
        $db = db_connect();
        $sql = "SELECT * FROM kategori WHERE no_kategori IN(SELECT MAX(no_kategori) FROM kategori)";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    /* CRUD Kategori */
    public function AddKategori($kategori)
    {
        $db = db_connect();
        $sql = "INSERT INTO kategori VALUES ('', '$kategori')";
        $query = $db->query($sql);

        return $query;
    }

    public function EditKategori($no, $kategori)
    {
        $db = db_connect();
        $sql = "UPDATE kategori SET kategori = '$kategori' WHERE no_kategori = '$no'";
        $query = $db->query($sql);

        return $query;
    }

    public function DeleteKategori($no)
    {
        $db = db_connect();
        $sql = "DELETE FROM kategori WHERE no_kategori = '$no'";
        $query = $db->query($sql);

        return $query;
    }
}
