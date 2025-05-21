<?php
require_once 'viewmodel/KategoriViewModel.php';
require_once 'viewmodel/MenuViewModel.php';
require_once 'viewmodel/PesananViewModel.php';

$entity = isset($_GET['entity']) ? $_GET['entity'] : 'menu';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

if ($entity == 'kategori') {
    $viewModel = new KategoriViewModel();
    
    if ($action == 'list') {
        $kategoriList = $viewModel->getKategoriList();
        require_once 'views/kategori_list.php';
    } elseif ($action == 'add') {
        require_once 'views/kategori_form.php';
    } elseif ($action == 'edit') {
        $kategori = $viewModel->getKategoriById($_GET['id']);
        require_once 'views/kategori_form.php';
    } elseif ($action == 'save') {
        $viewModel->addKategori($_POST['nama'], $_POST['deskripsi']);
        header('Location: index.php?entity=kategori');
    } elseif ($action == 'update') {
        $viewModel->updateKategori($_GET['id'], $_POST['nama'], $_POST['deskripsi']);
        header('Location: index.php?entity=kategori');
    } elseif ($action == 'delete') {
        $viewModel->deleteKategori($_GET['id']);
        header('Location: index.php?entity=kategori');
    }
} elseif ($entity == 'menu') {
    $viewModel = new MenuViewModel();
    
    if ($action == 'list') {
        $menuList = $viewModel->getMenuList();
        require_once 'views/menu_list.php';
    } elseif ($action == 'add') {
        $kategori = $viewModel->getKategori();
        require_once 'views/menu_form.php';
    } elseif ($action == 'edit') {
        $menu = $viewModel->getMenuById($_GET['id']);
        $kategori = $viewModel->getKategori();
        require_once 'views/menu_form.php';
    } elseif ($action == 'save') {
        $viewModel->addMenu(
            $_POST['nama'], 
            $_POST['deskripsi'], 
            $_POST['harga'], 
            $_POST['kategori_id'], 
            $_POST['tersedia']
        );
        header('Location: index.php?entity=menu');
    } elseif ($action == 'update') {
        $viewModel->updateMenu(
            $_GET['id'], 
            $_POST['nama'], 
            $_POST['deskripsi'], 
            $_POST['harga'], 
            $_POST['kategori_id'], 
            $_POST['tersedia']
        );
        header('Location: index.php?entity=menu');
    } elseif ($action == 'delete') {
        $viewModel->deleteMenu($_GET['id']);
        header('Location: index.php?entity=menu');
    }
} elseif ($entity == 'pesanan') {
    $viewModel = new PesananViewModel();
    
    if ($action == 'list') {
        $pesananList = $viewModel->getPesananList();
        require_once 'views/pesanan_list.php';
    } elseif ($action == 'view') {
        $pesanan = $viewModel->getPesananById($_GET['id']);
        $detailPesanan = $viewModel->getDetailPesanan($_GET['id']);
        require_once 'views/pesanan_view.php';
    } elseif ($action == 'add') {
        $menuItems = $viewModel->getMenuItems();
        require_once 'views/pesanan_form.php';
    } elseif ($action == 'edit') {
        $pesanan = $viewModel->getPesananById($_GET['id']);
        $detailPesanan = $viewModel->getDetailPesanan($_GET['id']);
        $menuItems = $viewModel->getMenuItems();
        require_once 'views/pesanan_form.php';
    } elseif ($action == 'save') {
        $viewModel->addPesanan($_POST['nama_pelanggan'], $_POST['items']);
        header('Location: index.php?entity=pesanan');
    } elseif ($action == 'update') {
        $viewModel->updatePesanan($_GET['id'], $_POST['nama_pelanggan'], $_POST['status'], $_POST['items']);
        header('Location: index.php?entity=pesanan');
    } elseif ($action == 'update_status') {
        $viewModel->updatePesananStatus($_GET['id'], $_POST['status']);
        header('Location: index.php?entity=pesanan&action=view&id=' . $_GET['id']);
    } elseif ($action == 'delete') {
        $viewModel->deletePesanan($_GET['id']);
        header('Location: index.php?entity=pesanan');
    }
}
?>
