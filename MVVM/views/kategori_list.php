<?php
require_once 'views/template/header.php';
?>

<h2 class="text-xl mb-4">Daftar Kategori</h2>
<a href="index.php?entity=kategori&action=add" class="bg-red-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Kategori</a>
<table class="w-full border">
    <tr class="bg-gray-200">
        <th class="border p-2">Nama</th>
        <th class="border p-2">Deskripsi</th>
        <th class="border p-2">Aksi</th>
    </tr>
    <?php foreach ($kategoriList as $kategori): ?>
    <tr>
        <td class="border p-2"><?php echo $kategori['nama']; ?></td>
        <td class="border p-2"><?php echo $kategori['deskripsi']; ?></td>
        <td class="border p-2">
            <a href="index.php?entity=kategori&action=edit&id=<?php echo $kategori['id']; ?>" class="text-blue-500">Edit</a>
            <a href="index.php?entity=kategori&action=delete&id=<?php echo $kategori['id']; ?>" class="text-red-500 ml-2" onclick="return confirm('Apakah Anda yakin? Ini akan menghapus semua menu dalam kategori ini.');">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
require_once 'views/template/footer.php';
?>
