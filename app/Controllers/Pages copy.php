<?php

namespace App\Controllers;

use App\Models\JawabanModel;
use App\Models\KategoriModel;
use App\Models\SoalModel;
use App\Models\UsersModel;

class Pages extends BaseController
{
    protected $UsersData;
    protected $Jawaban;
    protected $Soal;
    protected $Kategori;
    protected $kode_pengerjaan;

    public function __construct()
    {
        $this->UsersData = new UsersModel();
        $this->Jawaban   = new JawabanModel();
        $this->Soal      = new SoalModel();
        $this->Kategori  = new KategoriModel();
    }

    public function dashboard()
    {
        $users = $this->UsersData->ListUsers();
        $username = session()->get('username');

        // Bagian Users
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");
        $listUserAdmin1 = $this->UsersData->ListUsersWhere("level != 'admin1'");
        $listUserAdmin2 = $this->UsersData->ListUsersWhere("level != 'admin1' AND level != 'admin2'");

        // Bagian Jawaban
        $no_user = $userBySession[0]['no_user'];
        $ListJawaban = $this->Jawaban->ListJawaban();
        $JawabanUsers = $this->Jawaban->ListJawabanWhere("no_user = '$no_user'");

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();
        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        /* FILTER JAWABAN BY SELESAI */
        // DIgunakan Untuk Navigasi di Dashboard
        $SoalWhereBerhitung = $this->Soal->ListSoalWhere("kategori = 'berhitung'");
        $SoalWhereMembaca = $this->Soal->ListSoalWhere("kategori = 'membaca'");
        $SoalWhereMenulis = $this->Soal->ListSoalWhere("kategori = 'menulis'");
        if ($this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan')) == NULL) {
            $ListJawabanByKdPengerjaan = 0;
        } else {
            $ListJawabanByKdPengerjaan = $this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan'));
        }
        $data = [
            "title"     => "Dahsboard | Realtime Web",
            'UserModel' => $this->UsersData,
            'UserData'  => $users,
            'UserDataSession' => $userBySession[0],
            'listUserAdmin1'  => $listUserAdmin1,
            'listUserAdmin2'  => $listUserAdmin2,
            'ListJawaban'     => $ListJawaban,
            'JawabanUsers'    => $JawabanUsers,
            /* Untuk Navigasi */
            'ListJawabanByKdPengerjaan' => $ListJawabanByKdPengerjaan,
            'jumlahSoalBerhitung' => count($SoalWhereBerhitung),
            'jumlahSoalMembaca' => count($SoalWhereMembaca),
            'jumlahSoalMenulis' => count($SoalWhereMenulis),
            /* List Soal */
            'ListSoal' => $ListSoal,
            /* Kategori */
            'ListKategori' => $ListKategori,

            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'dashboard',
        ];

        return view('pages/dashboard', $data);
    }

    public function users()
    {
        $users = $this->UsersData->ListUsers();
        $username = session()->get('username');

        // Bagian Users
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");
        $listUserAdmin1 = $this->UsersData->ListUsersWhere("level != 'admin1'");
        $listUserAdmin2 = $this->UsersData->ListUsersWhere("level != 'admin1' AND level != 'admin2'");

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();
        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        //FILTER JAWABAN BY SELESAI
        // DIgunakan Untuk Navigasi di Dashboard
        $SoalWhereBerhitung = $this->Soal->ListSoalWhere("kategori = 'berhitung'");
        $SoalWhereMembaca = $this->Soal->ListSoalWhere("kategori = 'membaca'");
        $SoalWhereMenulis = $this->Soal->ListSoalWhere("kategori = 'menulis'");
        if ($this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan')) == NULL) {
            $ListJawabanByKdPengerjaan = 0;
        } else {
            $ListJawabanByKdPengerjaan = $this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan'));
        }

        $data = [
            "title" => "Users | Realtime Web",
            'UserData'  => $users,
            'UserDataSession' => $userBySession[0],
            'listUserAdmin1'  => $listUserAdmin1,
            'listUserAdmin2'  => $listUserAdmin2,
            /* Untuk Navigasi */
            'ListJawabanByKdPengerjaan' => $ListJawabanByKdPengerjaan,
            'jumlahSoalBerhitung' => count($SoalWhereBerhitung),
            'jumlahSoalMembaca' => count($SoalWhereMembaca),
            'jumlahSoalMenulis' => count($SoalWhereMenulis),
            /* List Soal */
            'ListSoal' => $ListSoal,
            /* Kategori */
            'ListKategori' => $ListKategori,

            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'users',
        ];
        return view('pages/users', $data);
    }

    public function banksoal()
    {
        $ListSoal = $this->Soal->ListSoal();
        //$SoalWhere = $this->SOal->ListSoalWhere();

        // Bagian Users
        $username = session()->get('username');
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");

        //Kategori SOal
        $ListKategori = $this->Kategori->ListKategori();

        //FILTER JAWABAN BY SELESAI
        // DIgunakan Untuk Navigasi di Dashboard
        $SoalWhereBerhitung = $this->Soal->ListSoalWhere("kategori = 'berhitung'");
        $SoalWhereMembaca = $this->Soal->ListSoalWhere("kategori = 'membaca'");
        $SoalWhereMenulis = $this->Soal->ListSoalWhere("kategori = 'menulis'");
        if ($this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan')) == NULL) {
            $ListJawabanByKdPengerjaan = 0;
        } else {
            $ListJawabanByKdPengerjaan = $this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan'));
        }
        $data = [
            "title" => "Question Bank | Realtime Web",
            "ListSoal" => $ListSoal,
            "UserDataSession" => $userBySession[0],
            /* Untuk Navigasi */
            'ListJawabanByKdPengerjaan' => $ListJawabanByKdPengerjaan,
            'jumlahSoalBerhitung' => count($SoalWhereBerhitung),
            'jumlahSoalMembaca' => count($SoalWhereMembaca),
            'jumlahSoalMenulis' => count($SoalWhereMenulis),

            /* Kategori */
            'ListKategori' => $ListKategori,

            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'banksoal',
        ];
        return view('pages/banksoal', $data);
    }

    public function result()
    {
        // Bagian User
        $username = session()->get('username');
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");

        // Bagian Jawaban
        $no_user = $userBySession[0]['no_user'];
        $ListJawaban = $this->Jawaban->ListJawaban();
        if ($ListJawaban != null) {
            foreach ($ListJawaban as $Jawaban) {
                $ListKode[] = $Jawaban['kode_pengerjaan'];
            }
        } else {
            $ListKode = 0;
        }
        // d(array_unique($kondisi));

        // foreach (array_unique($ListKode) as $kode) {
        //     $ListJawabanWhere = $this->Jawaban->ListJawabanWhere("kode_pengerjaan = '$kode'");
        //     for ($i = 0; $i < count($ListJawabanWhere); $i++) {
        //         # code...
        //         echo $ListJawabanWhere[$i]['hasil'];
        //     }
        //     echo "<br>";
        // }
        // dd($ListKode);

        $JawabanUsers = $this->Jawaban->ListJawabanWhere("no_user = '$no_user'");
        if ($JawabanUsers != null) {
            foreach ($JawabanUsers as $Jawaban) {
                $ListKodeUser[] = $Jawaban['kode_pengerjaan'];
            }
        } else {
            $ListKodeUser = 0;
        }
        // dd($ListKodeUser);

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();
        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        //FILTER JAWABAN BY SELESAI
        // DIgunakan Untuk Navigasi di Dashboard
        $SoalWhereBerhitung = $this->Soal->ListSoalWhere("kategori = 'berhitung'");
        $SoalWhereMembaca = $this->Soal->ListSoalWhere("kategori = 'membaca'");
        $SoalWhereMenulis = $this->Soal->ListSoalWhere("kategori = 'menulis'");
        if ($this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan')) == NULL) {
            $ListJawabanByKdPengerjaan = 0;
        } else {
            $ListJawabanByKdPengerjaan = $this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan'));
        }
        $data = [
            "title" => "Result | Realtime Web",
            "UserDataSession"  => $userBySession[0],
            "ListJawaban"      => $ListJawaban,
            // "ListJawabanWhere" => $ListJawabanWhere,
            "ListKode"         => $ListKode,
            "ListKodeUser"     => $ListKodeUser,
            "JawabanUsers"     => $JawabanUsers,
            /* Untuk Navigasi */
            'ListJawabanByKdPengerjaan' => $ListJawabanByKdPengerjaan,
            'jumlahSoalBerhitung' => count($SoalWhereBerhitung),
            'jumlahSoalMembaca' => count($SoalWhereMembaca),
            'jumlahSoalMenulis' => count($SoalWhereMenulis),
            'ListSoal' => $ListSoal,
            'ListKategori' => $ListKategori,

            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'result',
        ];
        return view('pages/result', $data);
    }

    public function edituser($no = '')
    {
        $users = $this->UsersData->ListUsers();
        $username = session()->get('username');

        // Bagian Users
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");
        $UserByID = $this->UsersData->ListUsersWhere("no_user = '$no'");

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();
        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        // DIgunakan Untuk Navigasi di Dashboard
        $SoalWhereBerhitung = $this->Soal->ListSoalWhere("kategori = 'berhitung'");
        $SoalWhereMembaca = $this->Soal->ListSoalWhere("kategori = 'membaca'");
        $SoalWhereMenulis = $this->Soal->ListSoalWhere("kategori = 'menulis'");
        if ($this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan')) == NULL) {
            $ListJawabanByKdPengerjaan = 0;
        } else {
            $ListJawabanByKdPengerjaan = $this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan'));
        }
        $data = [
            "title" => "Edit User | Realtime Web",
            'UserData'  => $users,
            'UserDataSession' => $userBySession[0],
            'UserByID'  => $UserByID[0],
            /* Untuk Navigasi */
            'ListJawabanByKdPengerjaan' => $ListJawabanByKdPengerjaan,
            'jumlahSoalBerhitung' => count($SoalWhereBerhitung),
            'jumlahSoalMembaca' => count($SoalWhereMembaca),
            'jumlahSoalMenulis' => count($SoalWhereMenulis),
            'ListSoal' => $ListSoal,
            'ListKategori' => $ListKategori,

            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'edituser',
        ];
        return view('pages/edit/edituser', $data);
    }

    public function editsoal($no = '')
    {
        $username = session()->get('username');

        // Bagian Users
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");

        $SoalByID = $this->Soal->ListSoalWhere("no_soal = '$no'");

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();
        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        // DIgunakan Untuk Navigasi di Dashboard
        $SoalWhereBerhitung = $this->Soal->ListSoalWhere("kategori = 'berhitung'");
        $SoalWhereMembaca = $this->Soal->ListSoalWhere("kategori = 'membaca'");
        $SoalWhereMenulis = $this->Soal->ListSoalWhere("kategori = 'menulis'");
        if ($this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan')) == NULL) {
            $ListJawabanByKdPengerjaan = 0;
        } else {
            $ListJawabanByKdPengerjaan = $this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan'));
        }
        $data = [
            "title" => "Edit Soal | Realtime Web",
            'UserDataSession' => $userBySession[0],
            "SoalByID" => $SoalByID[0],
            /* Untuk Navigasi */
            'ListJawabanByKdPengerjaan' => $ListJawabanByKdPengerjaan,
            'jumlahSoalBerhitung' => count($SoalWhereBerhitung),
            'jumlahSoalMembaca' => count($SoalWhereMembaca),
            'jumlahSoalMenulis' => count($SoalWhereMenulis),
            'ListSoal' => $ListSoal,
            'ListKategori' => $ListKategori,

            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'editsoal',
        ];
        return view('pages/edit/editsoal', $data);
    }

    public function editkategori($no = '')
    {
        $username = session()->get('username');

        // Bagian Users
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");

        $KategoriByID = $this->Kategori->ListKategoriWhere("no_kategori = '$no'");

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();
        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        // DIgunakan Untuk Navigasi di Dashboard
        $SoalWhereBerhitung = $this->Soal->ListSoalWhere("kategori = 'berhitung'");
        $SoalWhereMembaca = $this->Soal->ListSoalWhere("kategori = 'membaca'");
        $SoalWhereMenulis = $this->Soal->ListSoalWhere("kategori = 'menulis'");
        if ($this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan')) == NULL) {
            $ListJawabanByKdPengerjaan = 0;
        } else {
            $ListJawabanByKdPengerjaan = $this->Jawaban->ListJawabanByKdPengerjaan(session()->get('mengerjakan'));
        }
        $data = [
            "title" => "Edit Category | Realtime Web",
            'UserDataSession' => $userBySession[0],
            "KategoriByID" => $KategoriByID[0],
            /* Untuk Navigasi */
            'ListJawabanByKdPengerjaan' => $ListJawabanByKdPengerjaan,
            'jumlahSoalBerhitung' => count($SoalWhereBerhitung),
            'jumlahSoalMembaca' => count($SoalWhereMembaca),
            'jumlahSoalMenulis' => count($SoalWhereMenulis),
            'ListSoal' => $ListSoal,
            'ListKategori' => $ListKategori,

            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'editkategori',
        ];
        return view('pages/edit/editkategori', $data);
    }

    public function list_soal($kategori, $no, $segment = '0')
    {
        /* Elephan IO */
        $client = $this->client;

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();
        /* List Jawaban */
        $ListJawaban = $this->Jawaban->ListJawaban();
        $ListJawabanByStatus = $this->Jawaban->ListJawabanByStatus();
        if ($ListJawabanByStatus) {
            $Kd_Jawaban = $ListJawabanByStatus[0]['kode_pengerjaan'];
        } else {
            $Kd_Jawaban = 0;
        }
        // dd($Kd_Jawaban);
        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();
        $KategoriByKategori = $this->Kategori->ListKategoriWhere("kategori = '$kategori'");

        $SoalWhere = $this->Soal->ListSoalWhere("kategori = '$kategori'");
        /* Data Jawaban */
        $kode_soal = $SoalWhere[($no - 1)]['no_soal'];
        // d($kode_soal);
        $K_NoSoal_Status = $this->Jawaban->ListJawabanWhere("no_soal = '$kode_soal' AND status = 'tidak'");
        // Data Pertama dengan status tidak
        $K_NoJawaban_Status = $this->Jawaban->ListJawabanWhere("no_jawaban IN (SELECT MIN(no_jawaban) FROM jawaban) AND status = 'tidak'");
        // dd(count($K_NoSoal_Status));
        $hasil = $this->Jawaban->Hasil($Kd_Jawaban);
        if ($this->Jawaban->ListJawabanByKdPengerjaan($Kd_Jawaban) == NULL) {
            $ListJawabanByKdPengerjaan = 0;
            $KategoriByJawaban = 0;
            $JawabNoUser = 0;
        } else {
            $ListJawabanByKdPengerjaan = $this->Jawaban->ListJawabanByKdPengerjaan($Kd_Jawaban);
            $no_kategori = $ListJawabanByKdPengerjaan[0]['kategori'];
            $KategoriByJawaban = $this->Kategori->ListKategoriWhere("no_kategori = '$no_kategori'");
            $JawabNoUser = $ListJawabanByKdPengerjaan[0]['no_user'];
        }
        /* FILTER JAWABAN BY SELESAI */
        // dd($ListJawabanByKdPengerjaan[0]['no_user']);
        // Bagian Users
        $username = session()->get('username');
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");
        $UserByJawaban = $this->UsersData->ListUsersWhere("no_user = '$JawabNoUser'");

        /* Pengerjaan Soal */
        $no_user = $userBySession[0]['no_user'];
        $this->kode_pengerjaan = md5($no_user . rand(0, 999999999999999999));
        foreach ($ListJawaban as $Jawaban) {
            if ($this->kode_pengerjaan == $Jawaban['kode_pengerjaan']) {
                $this->kode_pengerjaan = md5($no_user . rand(0, 999999999999999999));
            }
        }
        /* Pengerjaan Awal */
        // dd($K_NoJawaban_Status[0]['no_soal'][4]);
        if ($segment == 'mengerjakan') {
            $Add = $this->Jawaban->AddJawaban($no_user, $KategoriByKategori[0]['no_kategori'], null, $SoalWhere[($no - 1)]['no_soal'], $this->kode_pengerjaan);
            if ($Add) {
                $client->initialize();
                $client->emit('pengerjaan', ['key' => $this->kode_pengerjaan, 'pesan' => 'Mulai Mengerjakan']);
                $client->close();
                // Redirect oleh server node
                $K_NoSoal_Status = $this->Jawaban->ListJawabanWhere("no_soal = '$kode_soal' AND status = 'tidak'");
                $no_soal = (int)$K_NoSoal_Status[0]['no_soal'][4];
                return redirect()->to(base_url("/pages/soal/$kategori/$no_soal"));
            }
        }

        /* GET URL EKSEKUSI */
        if ($segment == 'eksekusi') {
            $undo = $this->request->getVar("undo$no") == 'undo';
            $selesai = $this->request->getVar("selesai") == 'selesai';
            $no_soal = $no; //Mengambil nomor soal dari URL
            /* Kondisi dimana save nilai pada button next dan back hanya aktif dengan no_user yang sama dengan no_user yang ada pada tabel jawaban dengan no_jawaban terbesar */
            if ($userBySession[0]['no_user'] == $ListJawabanByKdPengerjaan[0]['no_user']) {
                if ($selesai) { //Kondisi jika button Selesai di pencet
                    if (session()->get('no_jawaban') != '') {
                        $no_jawaban = session()->get('no_jawaban');
                        $query = $this->Jawaban->SelesaiMengerjakan("status = 'tidak' AND no_user = '$no_user' AND kategori = '$no_kategori'");
                        if ($query) {
                            session()->remove('no_jawaban', 'lihat');
                            $client->initialize();
                            $client->emit('selesai', ['key' => 'selesai', 'pesan' => 'Selesai Mengerjakan']);
                            $client->close();
                            return redirect()->to(base_url('/pages/result'));
                        }
                    }
                } else {
                    /* Statement jika ketika button penilaian tersebut di pencet */
                    if ($hasil != null) { // Konjisi mengecek data hasil (default 10)
                        /* Melakukan penimpaan data ke array $jawaban dengan nilai dari hasil input */
                        $jawaban = $this->request->getVar('jawab'); // Eksekusi penimpaan
                        if ($undo) {
                            /* EKSEKUSI JIKA KLIK TOMBOL UNDO */
                            $jawaban[($no_soal - 1)] = "";
                            $no_jawaban = (session()->get('no_jawaban') + $no_soal) - 1;
                            $query = $this->Jawaban->EditJawaban($jawaban[$no_soal - 1], $no_jawaban);
                            if ($query) {
                                $jawaban = $jawaban[($no_soal - 1)];
                                $UserByJawaban = $UserByJawaban[0]['nama'];
                                $client->initialize();
                                $client->emit('hasil_jawab', ['no_soal' => $no_soal, 'jawaban' => $jawaban, 'hasil' => $hasil, 'pesan' => "$UserByJawaban Menghapus Jawaban nomor $no_soal"]);
                                $client->close();
                            }
                        } else {
                            if (session()->get('no_jawaban') != '') {
                                $no_jawaban = (session()->get('no_jawaban') + $no_soal) - 1;
                                /* Eksekusi Edit Data pada tabel jawaban dengan no_jawaban tertinggi dan status selesai "tidak" */
                                if (count($K_NoSoal_Status) == 1 && $K_NoSoal_Status[0]['hasil'] == null) {
                                    $query = $this->Jawaban->EditJawaban($kode_soal, $jawaban);
                                } else {
                                    $query = $this->Jawaban->AddJawaban($no_user, $KategoriByKategori[0]['no_kategori'], $jawaban, $SoalWhere[($no - 1)]['no_soal'], $this->kode_pengerjaan);
                                }

                                // $query = $this->Jawaban->AddJawaban($no_user, $kategori, $jawaban, session()->get('mengerjakan'));
                                if ($query) {
                                    $jawaban = $jawaban;
                                    $UserByJawaban = $UserByJawaban[0]['nama'];
                                    $client->initialize();
                                    $client->emit('hasil_jawab', ['no_soal' => $no_soal, 'jawaban' => $jawaban, 'hasil' => $hasil, 'pesan' => "$UserByJawaban Mengisi Jawaban nomor $no_soal"]);
                                    $client->close();
                                }
                            }
                        }
                        return redirect()->to(base_url("/pages/soal/$kategori/" . $no_soal));
                    }
                }
            }
        }

        /* GET URL LIHAT */
        if ($segment == 'lihat') {
            /* Menambah session lihat jika ingin melihat pengerjaan */
            session()->set(['lihat' => 'Aktif']);
            return redirect()->to(base_url("/pages/soal/$kategori/$no"));
            //dd(session()->get('lihat'));
        }


        $data = [
            "title" => "Soal $kategori | Realtime Web",
            "ListSoal" => $ListSoal,
            'ListKategori' => $ListKategori,
            "ListSoalByKategori" => $SoalWhere,
            "UserDataSession" => $userBySession[0],
            "hasil" => $hasil,
            "data_hasil" => $hasil,
            "ListJawabanByKdPengerjaan" => $ListJawabanByKdPengerjaan,
            "ListJawabanByStatus" => $ListJawabanByStatus,
            "K_NoSoal_Status" => $K_NoSoal_Status,
            "K_NoJawaban_Status" => $K_NoJawaban_Status,
            "jumlahSoal" => count($SoalWhere),
            "UserByJawaban" => $UserByJawaban,
            "KategoriByJawaban" => $KategoriByJawaban,
            "get_page" => $kategori,
            "get_no" => $no,
            "get_action" => $segment,
            /* Socket IO */
            'client' => $client,
            /* nodeServer */
            'nodeServer' => $this->nodeServer,
        ];
        return view('soal/soal', $data);
    }
}
