<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\SoalModel;
use App\Models\UsersModel;

class Edit extends BaseController
{
    public function user()
    {
        $client = $this->client;
        $session = session();
        $model = new UsersModel();
        $no_list = $this->request->getVar('no_user');
        $no = $this->request->getVar('no_user');
        $nama = $this->request->getVar('nama');
        $user = $this->request->getVar('username');
        $pass = $this->request->getVar('password');
        $level = $this->request->getVar('level');
        $data = $model->EditUser($no, $user, $pass, $nama, $level);
        if ($data) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success',
                'pesan' => 'Success Edit User',
            ];
            $session->setFlashdata($msg);
            $client->initialize();
            $client->emit('edit_user', ['no_user' => $no, 'nama' => $nama, 'username' => $user, 'password' => $pass, 'level' => $level]);
            $client->close();
            return redirect()->to(base_url('/pages/users'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Edit User'
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
        $no = $this->request->getVar('no_soal');
        $pertanyaan = $this->request->getVar('pertanyaan');
        $kategori = $this->request->getVar('kategori');
        $data = $model->EditSoal($no, $pertanyaan, $kategori);
        if ($data) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success',
                'pesan' => 'Success Edit Soal',
            ];
            $session->setFlashdata($msg);
            $client->initialize();
            $client->emit('edit_soal', ['no_soal' => $no, 'pertanyaan' => $pertanyaan, 'kategori' => $kategori]);
            $client->close();
            return redirect()->to(base_url('/pages/banksoal'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Edit Soal'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/pages/banksoal'));
        }
    }

    public function kategori()
    {
        $client = $this->client;
        $session = session();
        $KategoriModel = new KategoriModel();
        $no = $this->request->getVar('no_kategori');
        $kategori = $this->request->getVar('kategori');
        $data = $KategoriModel->EditKategori($no, $kategori);
        if ($data) {
            $msg = [
                'alert' => 'success',
                'judul' => 'Success',
                'pesan' => 'Success Edit Category',
            ];
            $session->setFlashdata($msg);
            $client->initialize();
            $client->emit('edit_kategori', ['no_kategori' => $no, 'kategori' => $kategori]);
            $client->close();
            return redirect()->to(base_url('/pages/banksoal'));
        } else {
            $msg = [
                'alert' => 'danger',
                'judul' => 'Failed',
                'pesan' => 'Failed Edit Category'
            ];
            $session->setFlashdata($msg);
            return redirect()->to(base_url('/pages/banksoal'));
        }
    }
}
