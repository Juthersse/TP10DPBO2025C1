<?php
require_once 'config/Database.php';

class DetailPesanan {
    private $conn;
    private $table = 'detail_pesanan';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getByPesananId($pesanan_id) {
        $query = "SELECT dp.*, m.nama as nama_menu, m.harga 
                 FROM " . $this->table . " dp 
                 JOIN menu m ON dp.menu_id = m.id 
                 WHERE dp.pesanan_id = :pesanan_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pesanan_id', $pesanan_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($pesanan_id, $menu_id, $jumlah, $subtotal) {
        $query = "INSERT INTO " . $this->table . " (pesanan_id, menu_id, jumlah, subtotal) 
                 VALUES (:pesanan_id, :menu_id, :jumlah, :subtotal)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pesanan_id', $pesanan_id);
        $stmt->bindParam(':menu_id', $menu_id);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':subtotal', $subtotal);
        return $stmt->execute();
    }

    public function update($id, $pesanan_id, $menu_id, $jumlah, $subtotal) {
        $query = "UPDATE " . $this->table . " 
                 SET pesanan_id = :pesanan_id, menu_id = :menu_id, 
                     jumlah = :jumlah, subtotal = :subtotal 
                 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pesanan_id', $pesanan_id);
        $stmt->bindParam(':menu_id', $menu_id);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteByPesananId($pesanan_id) {
        $query = "DELETE FROM " . $this->table . " WHERE pesanan_id = :pesanan_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pesanan_id', $pesanan_id);
        return $stmt->execute();
    }
}
?>
