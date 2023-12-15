<?php

namespace app\Penumpang\Controller;

include_once "app\Traits\ApiResponse.php";
include "app\Penumpang\Model\Penumpang.php";

use app\Traits\ApiResponse;
use app\Penumpang\Model\Penumpang as PenumpangModel;

class PenumpangController
{
    use ApiResponse;

    public function tampilkanSemua($id_bus = null)
    {
        $model = new PenumpangModel();
        $response = $model->tampilkanSemua($id_bus);
        return $this->apiResponse(200, "Sukses", $response);
    }

    public function tampilkanBerdasarkanId($id)
    {
        $model = new PenumpangModel();
        $response = $model->tampilkanBerdasarkanId($id);
        return $this->apiResponse(200, "Sukses", $response);
    }
    public function join($id)
    {
        $model = new PenumpangModel();
        $response = $model->findByIdWithBus($id);
        return $this->apiResponse(200, "Sukses", $response);
    }

    public function tambah()
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        $model = new PenumpangModel();
        $response = $model->tambah(
            $inputData['nama'],
            $inputData['umur'],
            $inputData['id_bus'] // Sesuaikan dengan atribut hubungan dengan bus
        );

        return $this->apiResponse(200, "Sukses", $response);
    }

    public function ubah($id)
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        $model = new PenumpangModel();
        $response = $model->ubah(
            $id,
            $inputData['nama'],
            $inputData['umur']
        );

        return $this->apiResponse(200, "Sukses", $response);
    }

    public function hapus($id)
    {
        $model = new PenumpangModel();
        $response = $model->hapus($id);

        return $this->apiResponse(200, "Sukses", $response);
    }
}
