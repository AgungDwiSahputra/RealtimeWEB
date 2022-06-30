<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'no_user';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'username',
        'password',
        'nama',
        'level'
    ];

    public function ListUsers()
    {
        $db = db_connect();
        $sql = "SELECT * FROM users";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function ListUsersWhere($kondisi)
    {
        $db = db_connect();
        $sql = "SELECT * FROM users WHERE " . $kondisi;
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function ListUsersMax()
    {
        $db = db_connect();
        $sql = "SELECT * FROM users WHERE no_user IN (SELECT MAX(no_user) FROM users)";
        $query = $db->query($sql);
        $result = $query->getResult('array');

        return $result;
    }

    public function AddUser($no, $user, $pass, $nama, $level)
    {
        $db = db_connect();
        $sql = "INSERT INTO users VALUES ('$no','$user','$pass','$nama','$level')";
        $query = $db->query($sql);

        return $query;
    }

    public function EditUser($no, $user, $pass, $nama, $level)
    {
        $db = db_connect();
        $sql = "UPDATE users SET username = '$user', password = '$pass', nama = '$nama', level = '$level' WHERE no_user = '$no'";
        $query = $db->query($sql);

        return $query;
    }

    public function DeleteUser($no)
    {
        $db = db_connect();
        $sql = "DELETE FROM users WHERE no_user = '$no'";
        $query = $db->query($sql);

        return $query;
    }
}
