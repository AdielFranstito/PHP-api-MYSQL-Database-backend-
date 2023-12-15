<?php

namespace app\Bus\Controller;

include_once "app\Traits\ApiResponse.php";
include "app\Bus\Model\Bus.php";

use app\Traits\ApiResponse;
use app\Bus\Model\Bus as BusModel;

class BusController
{
    use ApiResponse;

    public function tampilkanSemua()
    {
        $model = new BusModel();
        $response = $model->tampilkanSemua();
        return $this->apiResponse(200, "Sukses", $response);
    }

    public function tampilkanBerdasarkanId($id)
    {
        $model = new BusModel();
        $response = $model->tampilkanBerdasarkanId($id);
        return $this->apiResponse(200, "Sukses", $response);
    }

    public function tambah()
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        $model = new BusModel();
        $response = $model->tambah(
            $inputData['nama'],
            $inputData['nomor_polisi'],
            $inputData['kapasitas'],
            $inputData['harga']
        );

        return $this->apiResponse(200, "Sukses", $response);
    }

    public function ubah($id)
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        $model = new BusModel();
        $response = $model->ubah(
            $id,
            $inputData['nama'],
            $inputData['nomor_polisi'],
            $inputData['kapasitas'],
            $inputData['harga']
        );

        return $this->apiResponse(200, "Sukses", $response);
    }

    public function hapus($id)
    {
        $model = new BusModel();
        $response = $model->hapus($id);

        return $this->apiResponse(200, "Sukses", $response);
    }
}
