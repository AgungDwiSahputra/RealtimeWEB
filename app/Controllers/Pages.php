<?php

namespace App\Controllers;

use App\Models\JawabanModel;
use App\Models\KategoriModel;
use App\Models\PengerjaanModel;
use App\Models\Perbandingan;
use App\Models\SoalModel;
use App\Models\UsersModel;

class Pages extends BaseController
{
    protected $UsersData;
    protected $Jawaban;
    protected $Perbandingan;
    protected $Pengerjaan;
    protected $Soal;
    protected $Kategori;

    public function __construct()
    {
        $this->UsersData    = new UsersModel();
        $this->Jawaban      = new JawabanModel();
        $this->Perbandingan = new Perbandingan();
        $this->Pengerjaan   = new PengerjaanModel();
        $this->Soal         = new SoalModel();
        $this->Kategori     = new KategoriModel();
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

        $data = [
            "title" => "Users | Realtime Web",
            'UserData'  => $users,
            'UserDataSession' => $userBySession[0],
            'listUserAdmin1'  => $listUserAdmin1,
            'listUserAdmin2'  => $listUserAdmin2,
            /* Untuk Navigasi */
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
        $data = [
            "title" => "Question Bank | Realtime Web",
            "ListSoal" => $ListSoal,
            "UserDataSession" => $userBySession[0],
            /* Untuk Navigasi */
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
        $data = [
            "title" => "Edit User | Realtime Web",
            'UserData'  => $users,
            'UserDataSession' => $userBySession[0],
            'UserByID'  => $UserByID[0],
            /* Untuk Navigasi */
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
        $data = [
            "title" => "Edit Soal | Realtime Web",
            'UserDataSession' => $userBySession[0],
            "SoalByID" => $SoalByID[0],
            /* Untuk Navigasi */
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
        $data = [
            "title" => "Edit Category | Realtime Web",
            'UserDataSession' => $userBySession[0],
            "KategoriByID" => $KategoriByID[0],
            /* Untuk Navigasi */
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

    public function perbandingan()
    {
        /* REQUIRED */
        // Elephant io
        $client = $this->client;

        // Keperluan Navigasi
        // Bagian Users
        $username = session()->get('username');
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");
        $no_user = $userBySession[0]['no_user'];

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();

        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        // Digunakan untuk mengambil banyaknya list jawaban tanpa no_soal yang sama
        // $ListPerbandingan = $this->Jawaban->ListJawabanWhereF("kd_soal = '$UP_kd_soal' AND status = 'tidak'");
        // Digunakan untuk mengambil banyaknya list jawaban tanpa no_soal yang sama
        $ListPerbandingan = $this->Perbandingan->ListPerbandingan("no_user = '$no_user'");
        $ListPerbandingan_2 = $this->Perbandingan->ListPerbandingan_2("no_user = '$no_user'");
        // dd($ListPerbandingan);

        $data = [
            "title" => "Comparison | Realtime Web",

            /* Untuk Navigasi */
            'UserDataSession' => $userBySession[0],
            'ListSoal' => $ListSoal,
            'ListKategori' => $ListKategori,

            /* ISI */
            'ListPerbandingan' => $ListPerbandingan,
            'ListPerbandingan_2' => $ListPerbandingan_2,
            /* ============ */

            /* Socket IO */
            'client' => $client,
            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'comparison',
        ];
        return view('pages/perbandingan', $data);
    }
    public function resultPerbandingan($ttl = '')
    {
        /* REQUIRED */
        // Elephant io
        $client = $this->client;

        // Keperluan Navigasi
        // Bagian Users
        $username = session()->get('username');
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();

        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        $ListPerbandingan = $this->Perbandingan->DataPerbandingan("ttl_selesai = '$ttl'");
        $ListPerbandinganNoSoal = $this->Perbandingan->DataPerbandinganNoSoal("ttl_selesai = '$ttl'");
        $ListPerbandinganKategori = $this->Perbandingan->DataPerbandinganKategori("ttl_selesai = '$ttl'");
        $ListPerbandingan_2 = $this->Perbandingan->DataPerbandingan_2("ttl_selesai = '$ttl'");
        $ListPerbandingan_2NoSoal = $this->Perbandingan->DataPerbandingan_2NoSoal("ttl_selesai = '$ttl'");
        $ListPerbandingan_2Kategori = $this->Perbandingan->DataPerbandingan_2Kategori("ttl_selesai = '$ttl'");
        $UserPerbandingan = $this->Perbandingan->UserPerbandingan("status = 'selesai'");
        $UserPerbandingan_2 = $this->Perbandingan->UserPerbandingan_2("status = 'selesai'");
        // foreach ($ListPerbandingan as $Perbandingan) {
        //     foreach ($ListKategori as $kategori) {
        //         if ($Perbandingan['kategori'] == $kategori['kategori']) {
        //             d($Perbandingan['kategori']);
        //             break;
        //         }
        //     }
        // }
        // dd($UserPerbandingan);
        $data = [
            "title" => "Comparison Result | Realtime Web",

            /* Untuk Navigasi */
            'UserDataSession' => $userBySession[0],
            'ListSoal' => $ListSoal,
            'ListKategori' => $ListKategori,

            /* ISI */
            'ListPerbandingan' => $ListPerbandingan,
            'ListPerbandinganNoSoal' => $ListPerbandinganNoSoal,
            'ListPerbandinganKategori' => $ListPerbandinganKategori,
            'ListPerbandingan_2' => $ListPerbandingan_2,
            'ListPerbandingan_2NoSoal' => $ListPerbandingan_2NoSoal,
            'ListPerbandingan_2Kategori' => $ListPerbandingan_2Kategori,
            'UserPerbandingan' => $UserPerbandingan,
            'UserPerbandingan_2' => $UserPerbandingan_2,
            /* ============ */

            /* Socket IO */
            'client' => $client,
            /* nodeServer */
            'nodeServer' => $this->nodeServer,

            /* Page Halaman */
            'get_page' => 'comparison_result',
        ];
        return view('pages/result_perbandingan', $data);
    }

    public function list_soal($kategori, $no = '', $segment = '0')
    {
        /* REQUIRED */
        // Elephant io
        $client = $this->client;

        // Keperluan Navigasi
        // Bagian Users
        $username = session()->get('username');
        $userBySession = $this->UsersData->ListUsersWhere("username = '$username'");

        /* List Soal */
        $ListSoal = $this->Soal->ListSoal();
        $SoalWhere = $this->Soal->ListSoalWhere("kategori = '$kategori'");
        $no_user = $userBySession[0]['no_user'];

        /* List Kategori */
        $ListKategori = $this->Kategori->ListKategori();

        /* LIST SOAL BY KATEGORI untuk Pemilihan soal */
        // $ListSoalByKategori = $this->Soal->ListSoalWhere("kategori = '$kategori'");
        $kd_soal = $kategori[0] . $kategori[1] . $kategori[2];
        $UP_kd_soal = strtoupper($kd_soal); //Yang digunakan

        /* List Jawaban */
        // Bagian level Admin dan user 1
        // Untuk Memunculkan List Penilaian pada tabel jawaban
        $ListJawabanKdSoal = $this->Jawaban->ListJawabanWhere("kd_soal = '$UP_kd_soal' AND status = 'tidak'");
        $ListJawabanNoJawaban = $this->Jawaban->ListJawabanWhere("no_jawaban IN (SELECT MIN(no_jawaban) FROM jawaban) AND status = 'tidak'");
        // Digunakan untuk mengambil banyaknya list jawaban tanpa no_soal yang sama
        $ListJawabanKdSoalF = $this->Jawaban->ListJawabanWhereF("kd_soal = '$UP_kd_soal' AND status = 'tidak'");
        // ------------------------------------------------------
        // Untuk Memunculkan List Penilaian pada tabel jawaban
        $ListJawabanKdSoal_2 = $this->Jawaban->ListJawabanWhere_2("no_user = '$no_user' AND kd_soal = '$UP_kd_soal' AND status = 'tidak'");
        // Digunakan untuk mengambil banyaknya list jawaban tanpa no_soal yang sama
        $ListJawabanKdSoalF_2 = $this->Jawaban->ListJawabanWhereF_2("no_user = '$no_user' AND kd_soal = '$UP_kd_soal' AND status = 'tidak'");
        // ------------------------------------------------------
        // dd($ListJawabanKdSoalF_2);
        // Untuk Memunculkan List Penilaian Pengerjaan
        $ListPengerjaanKategori = $this->Pengerjaan->ListPengerjaanWhere("kategori = '$kategori' AND status = 'tidak'");
        /* ======================================================= */
        // dd($ListJawabanNoJawaban);

        //List jawaban berdasarkan kode soal, no soal, dan status = tidak
        $Soal_GET = null; //Mendapatkan no_soal dari nomor pada GET
        if ($no != null) { //Kondisi ketika sudah mengklik salah satu soal
            foreach ($SoalWhere as $no_soal) {
                if ($no_soal['no_soal'] == $no) {
                    $Soal_GET = $no_soal['no_soal']; //Mendapatkan no_soal dari nomor pada GET
                }
            }
            // List SOal sesuai dengan no_soal
            // Untuk level admin dan user1
            $ListJawabanPerSoal = $this->Jawaban->ListJawabanWhere("no_soal = '$Soal_GET' AND kd_soal = '$UP_kd_soal' AND status = 'tidak'");
            //Untuk level user2
            $ListJawabanPerSoal_2 = $this->Jawaban->ListJawabanWhere_2("no_soal = '$Soal_GET' AND kd_soal = '$UP_kd_soal' AND status = 'tidak'");
        }

        /* Eksekusi Awal Pengerjaan */
        if ($segment == 'mengerjakan') { //Kondisi ketika awal klik soal
            $tersedia = 0;
            foreach ($ListJawabanKdSoal as $ListJawaban) {
                if ($ListJawaban['no_soal'] == $Soal_GET) {
                    $tersedia++;
                }
            }
            if ($tersedia < 1) {
                if ($userBySession[0]['level'] != 'user2') { //Kondisi ini di khusus kan untuk user selain user2
                    $this->Jawaban->AddJawaban($no_user, $kategori, null, $Soal_GET, $UP_kd_soal);
                    $this->Pengerjaan->AddPengerjaan($no_user, $kategori, $Soal_GET); //Add Pengerjaan trigger untuk akun latihan
                }
            }
            /* Realtime */
            $client->initialize();
            $client->emit('hasil_Tjawab', ['no_soal' => $Soal_GET, 'kategori' => $kategori]);
            $client->close();
            return redirect()->to(base_url("/pages/soal/$kategori/$no"));
        }


        /* Eksekusi Penilaian */
        if ($segment == 'eksekusi') {
            $jawaban = $this->request->getVar('jawab');
            $undo = $this->request->getVar('undo');
            $selesai = $this->request->getVar('selesai');
            $pengerjaan = $this->request->getVar('pengerjaan');
            $DateTime = date('Y-m-d H:i:s');

            if ($userBySession[0]['level'] != 'user2') { // Kondisi untuk level user2

                // BUAT eksekusi ke database
                foreach ($ListJawabanKdSoal as $ListJawaban) {
                    if ($ListJawaban['no_soal'] == $Soal_GET) { //Kondisi untuk menyesuaikan no_soal
                        if ($undo) {
                            $this->Jawaban->DeleteJawaban($ListJawabanPerSoal[count($ListJawabanPerSoal) - 1]['no_jawaban']);
                            /* REALTIME */
                            $client->initialize();
                            $client->emit('undo_jawab', ['STATUS' => 'UNDO', 'no_soal' => $Soal_GET, 'jawaban' => $jawaban]);
                            $client->close();
                        } else if ($selesai) {
                            if ($selesai == 'Selesai All Kategori') {
                                $this->Jawaban->SelesaiMengerjakan($DateTime, "no_user = '$no_user' AND status = 'tidak'");
                                $this->Jawaban->SelesaiMengerjakan_2($DateTime, "status = 'tidak'");
                                $this->Pengerjaan->SelesaiMengerjakan($DateTime, "status = 'tidak'");
                                /* REALTIME */
                                $client->initialize();
                                $client->emit('selesai', ['key' => 'selesai', 'pesan' => 'Selesai Mengerjakan']);
                                $client->close();
                            } else {
                                $this->Jawaban->SelesaiMengerjakan($DateTime, "kd_soal = '$UP_kd_soal' AND no_user = '$no_user' AND status = 'tidak'");
                                $this->Jawaban->SelesaiMengerjakan_2($DateTime, "kd_soal = '$UP_kd_soal' AND status = 'tidak'");
                                $this->Pengerjaan->SelesaiMengerjakan($DateTime, "kategori = '$kategori' AND status = 'tidak'");
                                /* REALTIME */
                                $client->initialize();
                                $client->emit('selesai_kategori', ['key' => 'selesai', 'pesan' => 'Selesai Mengerjakan']);
                                $client->close();
                            }
                        } else {
                            if ($ListJawaban['hasil'] == '' && $ListJawaban['status'] == 'tidak') {
                                $query = $this->Jawaban->EditJawaban($ListJawaban['no_soal'], $jawaban);
                            } else {
                                $query = $this->Jawaban->AddJawaban($no_user, $kategori, $jawaban, $Soal_GET, $UP_kd_soal);
                            }
                            if ($query) {
                                $client->initialize();
                                $client->emit('hasil_jawab', ['STATUS' => 'ADD', 'no_soal' => $Soal_GET, 'jawaban' => $jawaban]);
                                $client->close();
                            }
                        }
                        return redirect()->to(base_url("/pages/soal/$kategori/$no"));
                    }
                }
            } else { // Kondisi untuk level user2
                if ($pengerjaan) {
                    $this->Jawaban->AddJawaban_2($no_user, $kategori, $jawaban, $Soal_GET, $UP_kd_soal);
                    return redirect()->to(base_url("/pages/soal/$kategori/$no"));
                }
                // BUAT eksekusi ke database
                foreach ($ListJawabanKdSoal_2 as $ListJawaban_2) {
                    if ($ListJawaban_2['no_soal'] == $Soal_GET) { //Kondisi untuk menyesuaikan no_soal
                        if ($undo) {
                            $this->Jawaban->DeleteJawaban_2($ListJawabanPerSoal_2[count($ListJawabanPerSoal_2) - 1]['no_jawaban']);
                        } else {
                            if ($ListJawaban_2['hasil'] == '' && $ListJawaban_2['status'] == 'tidak') {
                                $this->Jawaban->EditJawaban_2($ListJawaban_2['no_soal'], $jawaban, $userBySession[0]['no_user']);
                            } else {
                                $this->Jawaban->AddJawaban_2($no_user, $kategori, $jawaban, $Soal_GET, $UP_kd_soal);
                            }
                        }
                        return redirect()->to(base_url("/pages/soal/$kategori/$no"));
                    }
                }
                // return redirect()->to(base_url("/pages/soal/$kategori/$no"));
            }
        }

        $data = [
            "title" => "Soal $kategori | Realtime Web",
            "get_page" => $kategori,
            "get_no" => $no,
            "Soal_GET" => $Soal_GET,
            "get_action" => $segment,
            // Bagian Level Admin dan User1
            "ListJawabanKdSoal" => $ListJawabanKdSoal,
            "ListJawabanNoJawaban" => $ListJawabanNoJawaban,
            "ListJawabanKdSoalF" => $ListJawabanKdSoalF,
            // Bagian Level USer2
            "ListJawabanKdSoal_2" => $ListJawabanKdSoal_2,
            "ListJawabanKdSoalF_2" => $ListJawabanKdSoalF_2,
            // List Pengerjaan dari Level Admin dan User1 untuk user2
            "ListPengerjaanKategori" => $ListPengerjaanKategori,
            /* ============================================ */

            /* Untuk Navigasi */
            'UserDataSession' => $userBySession[0],
            'ListSoal' => $ListSoal,
            'ListKategori' => $ListKategori,

            /* Socket IO */
            'client' => $client,
            /* nodeServer */
            'nodeServer' => $this->nodeServer,
        ];
        return view('soal/soal', $data);
    }
}
