<?php
require_once 'views/template/header.php';
?>

<h2 class="text-xl mb-4">Daftar Menu</h2>
<a href="index.php?entity=menu&action=add" class="bg-red-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Menu</a>
<table class="w-full border">
    <tr class="bg-gray-200">
        <th class="border p-2">Nama</th>
        <th class="border p-2">Deskripsi</th>
        <th class="border p-2">Harga</th>
        <th class="border p-2">Kategori</th>
        <th class="border p-2">Tersedia</th>
        <th class="border p-2">Aksi</th>
    </tr>
    <?php foreach ($menuList as $item): ?>
    <tr>
        <td class="border p-2"><?php echo $item['nama']; ?></td>
        <td class="border p-2"><?php echo $item['deskripsi']; ?></td>
        <td class="border p-2">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
        <td class="border p-2"><?php echo $item['nama_kategori']; ?></td>
        <td class="border p-2"><?php echo $item['tersedia'] ? 'Ya' : 'Tidak'; ?></td>
        <td class="border p-2">
            <a href="index.php?entity=menu&action=edit&id=<?php echo $item['id']; ?>" class="text-blue-500">Edit</a>
            <a href="index.php?entity=menu&action=delete&id=<?php echo $item['id']; ?>" class="text-red-500 ml-2" onclick="return confirm('Apakah Anda yakin?');">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
require_once 'views/template/footer.php';
?>
