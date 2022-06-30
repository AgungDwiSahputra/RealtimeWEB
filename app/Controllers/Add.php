<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\SoalModel;
use App\Models\UsersModel;

class Add extends BaseController
{
    public function user()
    {
        $client = $this->client;
        $session = session();
        $model = new UsersModel();
        $nama = $this->request->getVar('nama');
        $user = $this->request->getVar('username');
        $pass = $this->request->getVar('password');
        $level = $this->request->getVar('level');
        $data = $model->AddUser('', $user, $pass, $nama, $level);
        if ($data) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success Add User',
                'pesan' => 'Success Add User with name (' . $nama . ')',
            ];
            $session->setFlashdata($msg);
            $userMax = $model->ListUsersMax();
            $client->initialize();
            $client->emit('add_user', ['no_user' => $userMax[0]['no_user'], 'nama' => $nama, 'username' => $user, 'level' => $level]);
            $client->close();
            return redirect()->to(base_url('/pages/users'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Add User'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/pages/users'));
        }
    }

    public function banksoal()
    {
        $client = $this->client;
        $session = session();
        $model = new SoalModel();
        $pertanyaan = $this->request->getVar('pertanyaan');
        $kategori = $this->request->getVar('kategori');
        $inisial = strtoupper($kategori[0] . $kategori[1] . $kategori[2]);
        $jumlahSoal = $model->JumlahSoal($kategori);
        $no_soal = $inisial . '.' . ($jumlahSoal + 1);
        $data = $model->AddSoal($no_soal, $pertanyaan, $kategori);
        if ($data) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success Add Soal',
                'pesan' => 'Success Add Soal (' . $pertanyaan . ')',
            ];
            $session->setFlashdata($msg);
            $soalMax = $model->ListSoalMax();
            $client->initialize();
            $client->emit('add_soal', ['no_soal' => $soalMax[0]['no_soal'], 'pertanyaan' => $pertanyaan, 'kategori' => $kategori]);
            $client->close();
            return redirect()->to(base_url('/pages/banksoal'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Add Soal'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/pages/banksoal'));
        }
    }

    public function kategori()
    {
        $session = session();
        $client = $this->client;
        $KategoriModel = new KategoriModel();
        $kategori = $this->request->getVar('kategori');
        $query = $KategoriModel->AddKategori($kategori);
        if ($query) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success Add Category',
                'pesan' => 'Success Add Category (' . $kategori . ')',
            ];
            $session->setFlashdata($msg);
            $jumlahKategori = $KategoriModel->ListKategoriMax();
            $client->initialize();
            $client->emit('add_kategori', ['no_kategori' => $jumlahKategori[0]['no_kategori'], 'kategori' => $kategori]);
            $client->close();
            return redirect()->to(base_url('/pages/banksoal'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Add Category'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/pages/banksoal'));
        }
    }
}
