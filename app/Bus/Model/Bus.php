<?php

namespace app\Bus\Model;

include_once "app\Config\Database.php";

use \app\Config\Database;
use mysqli;

class Bus extends Database
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function tampilkanSemua()
    {
        $sql = "SELECT * FROM Bus";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function tampilkanBerdasarkanId($id)
    {
        $sql = "SELECT * FROM Bus WHERE id_bus = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function tambah($nama, $nomor_polisi, $kapasitas, $harga)
    {
        $sql = "INSERT INTO Bus (nama, nomor_polisi, kapasitas, harga) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdi", $nama, $nomor_polisi, $kapasitas, $harga);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function ubah($id, $nama, $nomor_polisi, $kapasitas, $harga)
    {
        $sql = "UPDATE Bus SET nama = ?, nomor_polisi = ?, kapasitas = ?, harga = ? WHERE id_bus = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssdi", $nama, $nomor_polisi, $kapasitas, $harga, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function hapus($id)
    {
        $sql = "DELETE FROM Bus WHERE id_bus = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}
