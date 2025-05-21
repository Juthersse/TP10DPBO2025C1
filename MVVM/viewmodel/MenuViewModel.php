<?php
require_once 'model/Menu.php';
require_once 'model/Kategori.php';

class MenuViewModel {
    private $menu;
    private $kategori;

    public function __construct() {
        $this->menu = new Menu();
        $this->kategori = new Kategori();
    }

    public function getMenuList() {
        return $this->menu->getAll();
    }

    public function getMenuById($id) {
        return $this->menu->getById($id);
    }

    public function getMenuByKategori($kategori_id) {
        return $this->menu->getByKategori($kategori_id);
    }

    public function getKategori() {
        return $this->kategori->getAll();
    }

    public function addMenu($nama, $deskripsi, $harga, $kategori_id, $tersedia) {
        return $this->menu->create($nama, $deskripsi, $harga, $kategori_id, $tersedia);
    }

    public function updateMenu($id, $nama, $deskripsi, $harga, $kategori_id, $tersedia) {
        return $this->menu->update($id, $nama, $deskripsi, $harga, $kategori_id, $tersedia);
    }

    public function deleteMenu($id) {
        return $this->menu->delete($id);
    }
}
?>
