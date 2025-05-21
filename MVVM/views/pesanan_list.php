<?php
require_once 'views/template/header.php';
?>

<h2 class="text-xl mb-4">Daftar Pesanan</h2>
<a href="index.php?entity=pesanan&action=add" class="bg-red-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Pesanan</a>
<table class="w-full border">
    <tr class="bg-gray-200">
        <th class="border p-2">ID Pesanan</th>
        <th class="border p-2">Pelanggan</th>
        <th class="border p-2">Tanggal</th>
        <th class="border p-2">Total</th>
        <th class="border p-2">Status</th>
        <th class="border p-2">Aksi</th>
    </tr>
    <?php foreach ($pesananList as $pesanan): ?>
    <tr>
        <td class="border p-2"><?php echo $pesanan['id']; ?></td>
        <td class="border p-2"><?php echo $pesanan['nama_pelanggan']; ?></td>
        <td class="border p-2"><?php echo date('d M Y H:i', strtotime($pesanan['tanggal_pesanan'])); ?></td>
        <td class="border p-2">Rp <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></td>
        <td class="border p-2">
            <span class="px-2 py-1 rounded text-white 
                <?php 
                    if ($pesanan['status'] == 'menunggu') echo 'bg-yellow-500';
                    else if ($pesanan['status'] == 'diproses') echo 'bg-blue-500';
                    else if ($pesanan['status'] == 'selesai') echo 'bg-green-500';
                    else echo 'bg-red-500';
                ?>">
                <?php 
                    if ($pesanan['status'] == 'menunggu') echo 'Menunggu';
                    else if ($pesanan['status'] == 'diproses') echo 'Diproses';
                    else if ($pesanan['status'] == 'selesai') echo 'Selesai';
                    else echo 'Dibatalkan';
                ?>
            </span>
        </td>
        <td class="border p-2">
            <a href="index.php?entity=pesanan&action=view&id=<?php echo $pesanan['id']; ?>" class="text-green-500">Lihat</a>
            <a href="index.php?entity=pesanan&action=edit&id=<?php echo $pesanan['id']; ?>" class="text-blue-500 ml-2">Edit</a>
            <a href="index.php?entity=pesanan&action=delete&id=<?php echo $pesanan['id']; ?>" class="text-red-500 ml-2" onclick="return confirm('Apakah Anda yakin?');">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
require_once 'views/template/footer.php';
?>
