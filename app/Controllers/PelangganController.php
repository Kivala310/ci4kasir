<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PelangganModel;

class PelangganController extends BaseController
{
    protected $pelangganmodel;

    public function __construct()
    {
        $this->pelangganmodel = new PelangganModel();
    }

    public function index()
    {
        return view('v_pelanggan');
    }

    public function simpan_pelanggan()
    {
        // Validasi input dari AJAX
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'notelp' => 'required|numeric', // 'decimal' diganti menjadi 'numeric' karena lebih sesuai untuk no. telepon
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'notelp' => $this->request->getVar('notelp'),
        ];

        $this->pelangganmodel->save($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data pelanggan berhasil disimpan',
        ]);
    }

    public function tampil_pelanggan()
    {
        $pelanggan = $this->pelangganmodel->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan' => $pelanggan // Variabel $pelanggan digunakan dengan benar
        ]);
    }

    public function hapus()
    {
        $pelanggan_id = $this->request->getVar('pelanggan_id'); // Memperbaiki nama parameter

        if ($pelanggan_id) {
            // Menghapus pelanggan berdasarkan ID
            $hasil = $this->pelangganmodel->delete($pelanggan_id);

            if ($hasil) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Pelanggan berhasil dihapus']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus pelanggan']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID pelanggan tidak ditemukan']);
        }
    }

    // Fungsi untuk mendapatkan pelanggan berdasarkan ID
    public function get_pelanggan_by_id()
    {
        $pelanggan_id = $this->request->getVar('pelanggan_id'); // Memperbaiki parameter

        if ($pelanggan_id) {
            $pelanggan = $this->pelangganmodel->find($pelanggan_id); // Menggunakan find() untuk mencari berdasarkan ID
            if ($pelanggan) {
                return $this->response->setJSON(['status' => 'success', 'pelanggan' => $pelanggan]);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Pelanggan tidak ditemukan']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID pelanggan tidak valid']);
        }
    }

    // Fungsi untuk update pelanggan
    public function update_pelanggan()
    {
        $pelanggan_id = $this->request->getVar('pelanggan_id'); // Memperbaiki nama parameter
        $nama_pelanggan = $this->request->getVar('nama_pelanggan');
        $alamat = $this->request->getVar('alamat');
        $notelp = $this->request->getVar('notelp');

        if ($pelanggan_id && $nama_pelanggan && $alamat && $notelp) {
            $data = [
                'nama_pelanggan' => $nama_pelanggan,
                'alamat' => $alamat,
                'notelp' => $notelp,
            ];

            $hasil = $this->pelangganmodel->update($pelanggan_id, $data); // Gunakan update()

            if ($hasil) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Pelanggan berhasil diupdate']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengupdate pelanggan']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak lengkap']);
        }
    }
}
