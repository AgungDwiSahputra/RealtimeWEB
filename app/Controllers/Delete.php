<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\SoalModel;
use App\Models\UsersModel;

class Delete extends BaseController
{
    public function user($get)
    {
        $client = $this->client;
        $session = session();
        $model = new UsersModel();
        $userByNo = $model->ListUsersWhere("no_user = '$get'");
        $hapus = $model->DeleteUser($get);

        if ($hapus) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success',
                'pesan' => 'Seccess Delete User'
            ];
            $session->setFlashdata($msg);
            $client->initialize();
            $client->emit('delete_user', ['no_user' => $userByNo[0]['no_user'], 'username' => $userByNo[0]['username'], 'nama' => $userByNo[0]['nama']]);
            $client->close();
            return redirect()->to(base_url('/pages/users'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Delete User'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/pages/users'));
        }
    }

    public function soal($get)
    {
        $client = $this->client;
        $session = session();
        $model = new SoalModel();
        $soalByNo = $model->ListSoalWhere("no_soal = '$get'");
        $hapus = $model->DeleteSoal($get);

        if ($hapus) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success',
                'pesan' => 'Seccess Delete Soal'
            ];
            $session->setFlashdata($msg);
            $client->initialize();
            $client->emit('delete_soal', ['no_soal' => $soalByNo[0]['no_soal'], 'pertanyaan' => $soalByNo[0]['pertanyaan'], 'kategori' => $soalByNo[0]['kategori']]);
            $client->close();
            return redirect()->to(base_url('/pages/banksoal'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Delete Soal'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/pages/banksoal'));
        }
    }

    public function kategori($no_kategori)
    {
        $client = $this->client;
        $session = session();
        $KategoriModel = new KategoriModel();
        $kategoriByNo = $KategoriModel->ListKategoriWhere("no_kategori = '$no_kategori'");
        $hapus = $KategoriModel->DeleteKategori($no_kategori);

        if ($hapus) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success',
                'pesan' => 'Seccess Delete Category'
            ];
            $session->setFlashdata($msg);
            $client->initialize();
            $client->emit('delete_kategori', ['no_kategori' => $kategoriByNo[0]['no_kategori'], 'kategori' => $kategoriByNo[0]['kategori']]);
            $client->close();
            return redirect()->to(base_url('/pages/banksoal'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Delete Soal'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/pages/banksoal'));
        }
    }
}
