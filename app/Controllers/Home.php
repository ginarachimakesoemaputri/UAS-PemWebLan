<?php

namespace App\Controllers;

use App\Models\User_model;
use App\Models\BarangModel;
use App\Models\TransaksiModel;
use App\Libraries\DataTables;

class Home extends BaseController
{

    public function __construct()
    {
        $this->DataTables = new DataTables();
    }

    public function index()
    {
        $session = session();
        if ($session->get('role') == null) {
            return redirect()->to(base_url("/public/login"));
        }
        $user = new User_model();

        $dataUser = $user->find($session->get('username'));
        $data["user"] = $dataUser->nama;
        return view('Home/index_barang', $data);
    }

    public function mainindex()
    {
        $session = session();
        if ($session->get('role') == null) {
            return redirect()->to(base_url("/public/login"));
        }
        $user = new User_model();
        $barang = new BarangModel();

        $dataUser = $user->find($session->get('username'));
        $data = [
            'user' => $dataUser->nama,
            'getData' => $barang->getData()

        ];
        return view('Home/mainindex', $data);
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url("/public/login"));
    }

    public function grid()
    {
        $query = "SELECT * FROM barang";
        $where = null;
        $isWhere = null;
        $search = array('id', 'nama');
        echo $this->DataTables->BuildDataTables($query, $where, $isWhere, $search);
    }

    public function mainGrid()
    {
        $query = "SELECT transaksi_keluar.id_transaksi, barang.nama, transaksi_keluar.jumlah, transaksi_keluar.keterangan, transaksi_keluar.tanggal_transaksi, transaksi_keluar.total FROM transaksi_keluar INNER JOIN barang ON transaksi_keluar.id = barang.id";
        $where = null;
        $isWhere = null;
        $search = array('id_transaksi', 'nama', 'tanggal_transaksi');
        echo $this->DataTables->BuildDataTables($query, $where, $isWhere, $search);
    }

    public function save()
    {
        $id = $this->request->getPost("id");
        $nama = $this->request->getPost("nama");
        $jumlah = $this->request->getPost("jumlah");
        $keterangan = $this->request->getPost("keterangan");
        $harga = $this->request->getPost("harga");
        $hargapcs = $this->request->getPost("harga_satuan");
        $jumlahpcs = $this->request->getPost("jumlah_satuan");

        if ($jumlah == "") {
            $jumlah = NULL;
        }
        if ($harga == "") {
            $harga = NULL;
        }
        if ($hargapcs == "") {
            $hargapcs = NULL;
        }
        if ($jumlahpcs == "") {
            $jumlahpcs = NULL;
        }

        $barang = new BarangModel();
        $dataBarang = $barang->find($id);
        if ($dataBarang == NULL) {
            $dataInsert = array(
                "id" => $id,
                "nama" => $nama,
                "jumlah" => $jumlah,
                "keterangan" => $keterangan,
                "harga" => $harga,
                "harga_satuan" => $hargapcs,
                "jumlah_satuan" => $jumlahpcs
            );
            $barang->insert($dataInsert);
            echo "success";
        } else {
            echo "failed";
        }
    }

    public function delete()
    {
        $id = $this->request->getPost("deleteId");
        $barang = new BarangModel();
        $dataBarang = $barang->find($id);
        if ($dataBarang == NULL) {
            echo "failed";
        } else {
            $barang->delete($id);
            echo "success";
        }
    }

    public function edit()
    {
        $id = $this->request->getPost("editId");
        $barang = new BarangModel();
        $dataBarang = $barang->find($id);
        if ($dataBarang == NULL) {
            echo "failed";
        } else {
            echo json_encode($dataBarang);
        }
    }

    public function updateData()
    {
        $id = $this->request->getPost("id");
        $nama = $this->request->getPost("nama");
        $jumlah = $this->request->getPost("jumlah");
        $keterangan = $this->request->getPost("keterangan");
        $harga = $this->request->getPost("harga");
        $hargapcs = $this->request->getPost("harga_satuan");
        $jumlahpcs = $this->request->getPost("jumlah_satuan");

        if ($jumlah == "") {
            $jumlah = NULL;
        }
        if ($harga == "") {
            $harga = NULL;
        }
        if ($hargapcs == "") {
            $hargapcs = NULL;
        }
        if ($jumlahpcs == "") {
            $jumlahpcs = NULL;
        }

        $editId = $this->request->getPost("editId");
        $barang = new BarangModel();
        $dataBarang = $barang->find($editId);

        if ($dataBarang == NULL) {
            echo "failed";
        } else {
            $dataUpdate = array(
                "id" => $id,
                "nama" => $nama,
                "jumlah" => $jumlah,
                "keterangan" => $keterangan,
                "harga" => $harga,
                "harga_satuan" => $hargapcs,
                "jumlah_satuan" => $jumlahpcs
            );
            $barang->update($id, $dataUpdate);
            echo "success";
        }
    }

    //Main

    public function mainSave()
    {
        $id = $this->request->getPost("id");
        $jumlah = $this->request->getPost("jumlah");
        $keterangan = $this->request->getPost("keterangan");

        $barang = new BarangModel();
        $dataBarang = $barang->find($id);
        if ($keterangan == "pcs") {
            $total = $jumlah * $dataBarang->harga_satuan;
            $stokUpdate = array(
                "id" => $id,
                "jumlah_satuan" => $dataBarang->jumlah_satuan - $jumlah
            );
            $barang->update($id, $stokUpdate);
        } else {
            $total = $jumlah * $dataBarang->harga;
            $stokUpdate = array(
                "id" => $id,
                "jumlah" => $dataBarang->jumlah - $jumlah
            );
            $barang->update($id, $stokUpdate);
        }

        date_default_timezone_set('Asia/Singapore');
        $date = date('Y-m-d H:i:s');

        $dataInsert = array(
            "id" => $id,
            "jumlah" => $jumlah,
            "keterangan" => $keterangan,
            "tanggal_transaksi" => $date,
            "total" => $total
        );
        $transaksi = new TransaksiModel();
        $transaksi->insert($dataInsert);
        echo "success";
    }

    public function mainDelete()
    {
        $id = $this->request->getPost("deleteId");
        $transaksi = new TransaksiModel();
        $dataBarang = $transaksi->find($id);
        if ($dataBarang == NULL) {
            echo "failed";
        } else {
            $transaksi->delete($id);
            echo "success";
        }
    }

    public function mainEdit()
    {
        $id = $this->request->getPost("editId");
        $transaksi = new TransaksiModel();
        $dataBarang = $transaksi->find($id);
        if ($dataBarang == NULL) {
            echo "failed";
        } else {
            echo json_encode($dataBarang);
        }
    }

    public function mainUpdateData()
    {
        $idTrans = $this->request->getPost("id_trans");
        $date = $this->request->getPost("date_trans");
        $total = $this->request->getPost("total");
        $id = $this->request->getPost("id");
        $jumlah = $this->request->getPost("jumlah");
        $keterangan = $this->request->getPost("keterangan");

        $barang = new BarangModel();
        $dataBarang = $barang->find($id);
        if ($keterangan == "pcs") {
            $total = $jumlah * $dataBarang->harga_satuan;
        } else {
            $total = $jumlah * $dataBarang->harga;
        }

        //

        $editId = $this->request->getPost("editId");

        $transaksi = new TransaksiModel();
        $dataTrans = $transaksi->find($editId);

        if ($dataTrans == NULL) {
            echo "failed";
        } else {
            $dataUpdate = array(
                "id_transaksi" => $idTrans,
                "id" => $id,
                "jumlah" => $jumlah,
                "keterangan" => $keterangan,
                "tanggal_transaksi" => $date,
                "total" => $total
            );
            $transaksi->update($idTrans, $dataUpdate);
            echo "success";
        }
    }

}
