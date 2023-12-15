<?php

namespace app\Routes;

include "app\Bus\Controller\BusController.php";
include "app\Penumpang\Controller\PenumpangController.php";

use app\Bus\Controller\BusController;
use app\Penumpang\Controller\PenumpangController;

class Routes
{
    public function handle($method, $path)
    {
        // Initialize controllers
        $busController = new BusController();
        $penumpangController = new PenumpangController();

        // Handle routes for Bus
        if ($method == 'GET' && $path == '/api/bus') {
            echo $busController->tampilkanSemua();
        }

        if ($method == 'GET' && strpos($path, '/api/bus/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            echo $busController->tampilkanBerdasarkanId($id);
        }

        if ($method == 'POST' && $path == '/api/bus') {
            echo $busController->tambah();
        }

        if ($method == 'PUT' && strpos($path, '/api/bus/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            echo $busController->ubah($id);
        }

        if ($method == 'DELETE' && strpos($path, '/api/bus/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            echo $busController->hapus($id);
        }

        // Handle routes for Penumpang
        if ($method == 'GET' && $path == '/api/penumpang') {
            echo $penumpangController->tampilkanSemua();
        }

        if ($method == 'GET' && strpos($path, '/api/penumpang/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            echo $penumpangController->tampilkanBerdasarkanId($id);
        }

        if ($method == 'POST' && $path == '/api/penumpang') {
            echo $penumpangController->tambah();
        }

        if ($method == 'PUT' && strpos($path, '/api/penumpang/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            echo $penumpangController->ubah($id);
        }

        if ($method == 'DELETE' && strpos($path, '/api/penumpang/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            echo $penumpangController->hapus($id);
        }
        if ($method == 'GET' && strpos($path, '/api/penumpang/join/') === 0) {
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];
            echo $penumpangController->join($id);
        }
    }
}
