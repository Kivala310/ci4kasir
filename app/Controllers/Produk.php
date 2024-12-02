<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;

class Produk extends BaseController {
    protected $produkmodel;

    public function __construct()
    {
        $this->produkmodel = new ProdukModel();
        
    }

    public function index()
    {
        return view('v_produk');
    }

    public function simpan_produk()
    {
        //validasi input dari AJAX
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_produk'   => 'required',
            'harga'         => 'required|decimal',
            'stok'          => 'required|integer',
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return $this->response->setJSON([
                'status'    => 'error',
                'errors'    => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
        ];

        $this->produkmodel->save($data);

        return $this->response->setJSON([
            'status'    => 'success',
            'message'   => 'Data produk berhasil disimpan',
        ]);
    }

    public function tampil_produk()
    {
        $produk = $this->produkmodel->findAll();

        return $this->response->setJSON([
            'status'    => 'success',
            'produk'    => $produk
        ]);
    }

    public function hapus(){
        $produk_id = $this->request->getVar('produk_id');

        if($produk_id){
            // Memanggil model untuk menghapus produk
            $hasil = $this->produkmodel->delete($produk_id);

            if($hasil){
                echo json_encode(['status' => 'success', 'message' => 'Produk berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus produk']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Produk ID tidak ditemukan']);
        }
    }

        // Fungsi untuk mendapatkan produk berdasarkan ID
    public function get_produk_by_id(){
        $produk_id = $this->request->getVar('produk_id');

        if($produk_id){
            $produk = $this->produkmodel->find($produk_id);
            if($produk){
                return response()->setJSON(['status' => 'success', 'produk' => $produk]);
            } else {
                return response()->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
            }
        } else {
            return response()->setJSON(['status' => 'error', 'message' => 'ID produk tidak valid']);
        }
    }

    // Fungsi untuk update produk
    public function update_produk(){
        $produk_id = $this->request->getVar('produk_id');
        $nama_produk = $this->request->getVar('nama_produk');
        $harga = $this->request->getVar('harga');
        $stok = $this->request->getVar('stok');

        if($produk_id && $nama_produk && $harga && $stok){
            $data = [
                'nama_produk' => $nama_produk,
                'harga' => $harga,
                'stok' => $stok
            ];

            $hasil = $this->produkmodel->update($produk_id, $data);

            if($hasil){
                echo json_encode(['status' => 'success', 'message' => 'Produk berhasil diupdate']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate produk']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        }
    }
}