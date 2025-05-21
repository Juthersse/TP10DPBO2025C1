<?php
require_once 'model/Pesanan.php';
require_once 'model/DetailPesanan.php';
require_once 'model/Menu.php';

class PesananViewModel {
    private $pesanan;
    private $detailPesanan;
    private $menu;

    public function __construct() {
        $this->pesanan = new Pesanan();
        $this->detailPesanan = new DetailPesanan();
        $this->menu = new Menu();
    }

    public function getPesananList() {
        return $this->pesanan->getAll();
    }

    public function getPesananById($id) {
        return $this->pesanan->getById($id);
    }

    public function getDetailPesanan($pesanan_id) {
        return $this->detailPesanan->getByPesananId($pesanan_id);
    }

    public function getMenuItems() {
        return $this->menu->getAll();
    }

    public function addPesanan($nama_pelanggan, $items) {
        // Calculate total amount
        $total_harga = 0;
        foreach ($items as $item) {
            $menu_item = $this->menu->getById($item['menu_id']);
            $subtotal = $menu_item['harga'] * $item['jumlah'];
            $total_harga += $subtotal;
        }

        // Create order
        $pesanan_id = $this->pesanan->create($nama_pelanggan, $total_harga);
        
        if ($pesanan_id) {
            // Add order items
            foreach ($items as $item) {
                $menu_item = $this->menu->getById($item['menu_id']);
                $subtotal = $menu_item['harga'] * $item['jumlah'];
                $this->detailPesanan->create($pesanan_id, $item['menu_id'], $item['jumlah'], $subtotal);
            }
            return $pesanan_id;
        }
        
        return false;
    }

    public function updatePesanan($id, $nama_pelanggan, $status, $items) {
        // Calculate total amount
        $total_harga = 0;
        foreach ($items as $item) {
            $menu_item = $this->menu->getById($item['menu_id']);
            $subtotal = $menu_item['harga'] * $item['jumlah'];
            $total_harga += $subtotal;
        }

        // Update order
        $result = $this->pesanan->update($id, $nama_pelanggan, $total_harga, $status);
        
        if ($result) {
            // Delete existing order items
            $this->detailPesanan->deleteByPesananId($id);
            
            // Add new order items
            foreach ($items as $item) {
                $menu_item = $this->menu->getById($item['menu_id']);
                $subtotal = $menu_item['harga'] * $item['jumlah'];
                $this->detailPesanan->create($id, $item['menu_id'], $item['jumlah'], $subtotal);
            }
            return true;
        }
        
        return false;
    }

    public function updatePesananStatus($id, $status) {
        return $this->pesanan->updateStatus($id, $status);
    }

    public function deletePesanan($id) {
        // Order items will be deleted automatically due to ON DELETE CASCADE
        return $this->pesanan->delete($id);
    }
}
?>
