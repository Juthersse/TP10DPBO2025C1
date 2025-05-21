<?php
require_once 'model/Kategori.php';

class KategoriViewModel {
    private $kategori;

    public function __construct() {
        $this->kategori = new Kategori();
    }

    public function getKategoriList() {
        return $this->kategori->getAll();
    }

    public function getKategoriById($id) {
        return $this->kategori->getById($id);
    }

    public function addKategori($nama, $deskripsi) {
        return $this->kategori->create($nama, $deskripsi);
    }

    public function updateKategori($id, $nama, $deskripsi) {
        return $this->kategori->update($id, $nama, $deskripsi);
    }

    public function deleteKategori($id) {
        return $this->kategori->delete($id);
    }
}
?>
