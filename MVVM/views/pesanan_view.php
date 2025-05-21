<?php
require_once 'views/template/header.php';
?>

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl">Detail Pesanan</h2>
    <div>
        <a href="index.php?entity=pesanan" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali ke Pesanan</a>
        <a href="index.php?entity=pesanan&action=edit&id=<?php echo $pesanan['id']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Edit Pesanan</a>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <p class="text-gray-600">ID Pesanan:</p>
            <p class="font-semibold">#<?php echo $pesanan['id']; ?></p>
        </div>
        <div>
            <p class="text-gray-600">Tanggal:</p>
            <p class="font-semibold"><?php echo date('d M Y H:i', strtotime($pesanan['tanggal_pesanan'])); ?></p>
        </div>
        <div>
            <p class="text-gray-600">Pelanggan:</p>
            <p class="font-semibold"><?php echo $pesanan['nama_pelanggan']; ?></p>
        </div>
        <div>
            <p class="text-gray-600">Status:</p>
            <p>
                <span class="px-2 py-1 rounded text-white font-semibold
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
            </p>
        </div>
    </div>

    <form action="index.php?entity=pesanan&action=update_status&id=<?php echo $pesanan['id']; ?>" method="POST" class="mb-6">
        <div class="flex items-center">
            <label class="mr-2">Update Status:</label>
            <select name="status" class="border p-2 mr-2">
                <option value="menunggu" <?php echo $pesanan['status'] == 'menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                <option value="diproses" <?php echo $pesanan['status'] == 'diproses' ? 'selected' : ''; ?>>Diproses</option>
                <option value="selesai" <?php echo $pesanan['status'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                <option value="dibatalkan" <?php echo $pesanan['status'] == 'dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
            </select>
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>

    <h3 class="text-lg font-semibold mb-2">Item Pesanan</h3>
    <table class="w-full border">
        <tr class="bg-gray-200">
            <th class="border p-2">Item</th>
            <th class="border p-2">Harga</th>
            <th class="border p-2">Jumlah</th>
            <th class="border p-2">Subtotal</th>
        </tr>
        <?php foreach ($detailPesanan as $item): ?>
        <tr>
            <td class="border p-2"><?php echo $item['nama_menu']; ?></td>
            <td class="border p-2">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
            <td class="border p-2"><?php echo $item['jumlah']; ?></td>
            <td class="border p-2">Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="bg-gray-100">
            <td colspan="3" class="border p-2 text-right font-semibold">Total:</td>
            <td class="border p-2 font-semibold">Rp <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></td>
        </tr>
    </table>
</div>

<?php
require_once 'views/template/footer.php';
?>
