<?php

namespace app\Penumpang\Model;

include_once "app\Config\Database.php";

use \app\Config\Database;
use mysqli;

class Penumpang extends Database
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function tampilkanSemua($id_terminal = null)
    {
        $sql = "SELECT * FROM penumpang";
        if ($id_terminal !== null) {
            $sql .= " WHERE id_terminal = ?";
        }

        $stmt = $this->conn->prepare($sql);
        if ($id_terminal !== null) {
            $stmt->bind_param("i", $id_terminal);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function tampilkanBerdasarkanId($id)
    {
        $sql = "SELECT * FROM penumpang WHERE id_penumpang = ?";
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

    public function tambah($nama, $umur, $id_terminal)
    {
        $sql = "INSERT INTO penumpang (nama, umur, id_terminal) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $nama, $umur, $id_terminal);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function ubah($id, $nama, $umur)
    {
        $sql = "UPDATE penumpang SET nama = ?, umur = ? WHERE id_penumpang = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $nama, $umur, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function hapus($id)
    {
        $sql = "DELETE FROM penumpang WHERE id_penumpang = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function findAllWithBus()
{
    $sql = "SELECT penumpang.*, bus.nama as nama_bus 
            FROM penumpang
            JOIN bus ON penumpang.id_bus = bus.id";
    $result = $this->conn->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

public function findByIdWithBus($id)
{
    $sql = "SELECT penumpang.*, bus.nama as nama_bus 
            FROM penumpang
            JOIN bus ON penumpang.id_bus = bus.id_bus
            WHERE penumpang.id_penumpang = ?";
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

}
