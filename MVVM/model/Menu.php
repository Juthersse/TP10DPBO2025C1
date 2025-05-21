<?php
require_once 'config/Database.php';

class Menu {
    private $conn;
    private $table = 'menu';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT m.*, k.nama as nama_kategori 
                 FROM " . $this->table . " m 
                 JOIN kategori k ON m.kategori_id = k.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT m.*, k.nama as nama_kategori 
                 FROM " . $this->table . " m 
                 JOIN kategori k ON m.kategori_id = k.id 
                 WHERE m.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByKategori($kategori_id) {
        $query = "SELECT m.*, k.nama as nama_kategori 
                 FROM " . $this->table . " m 
                 JOIN kategori k ON m.kategori_id = k.id 
                 WHERE m.kategori_id = :kategori_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kategori_id', $kategori_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nama, $deskripsi, $harga, $kategori_id, $tersedia) {
        $query = "INSERT INTO " . $this->table . " (nama, deskripsi, harga, kategori_id, tersedia) 
                 VALUES (:nama, :deskripsi, :harga, :kategori_id, :tersedia)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':kategori_id', $kategori_id);
        $stmt->bindParam(':tersedia', $tersedia);
        return $stmt->execute();
    }

    public function update($id, $nama, $deskripsi, $harga, $kategori_id, $tersedia) {
        $query = "UPDATE " . $this->table . " 
                 SET nama = :nama, deskripsi = :deskripsi, harga = :harga, 
                     kategori_id = :kategori_id, tersedia = :tersedia 
                 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':kategori_id', $kategori_id);
        $stmt->bindParam(':tersedia', $tersedia);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
