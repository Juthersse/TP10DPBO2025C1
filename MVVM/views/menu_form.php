<?php
require_once 'views/template/header.php';
?>

<h2 class="text-xl mb-4"><?php echo isset($menu) ? 'Edit Menu' : 'Tambah Menu'; ?></h2>
<form action="index.php?entity=menu&action=<?php echo isset($menu) ? 'update&id=' . $menu['id'] : 'save'; ?>" method="POST" class="space-y-4">
    <div>
        <label class="block">Nama:</label>
        <input type="text" name="nama" value="<?php echo isset($menu) ? $menu['nama'] : ''; ?>" class="border p-2 w-full" required>
    </div>
    <div>
        <label class="block">Deskripsi:</label>
        <textarea name="deskripsi" class="border p-2 w-full" rows="3"><?php echo isset($menu) ? $menu['deskripsi'] : ''; ?></textarea>
    </div>
    <div>
        <label class="block">Harga (Rp):</label>
        <input type="number" name="harga" step="500" min="0" value="<?php echo isset($menu) ? $menu['harga'] : ''; ?>" class="border p-2 w-full" required>
    </div>
    <div>
        <label class="block">Kategori:</label>
        <select name="kategori_id" class="border p-2 w-full" required>
            <?php foreach ($kategori as $kat): ?>
            <option value="<?php echo $kat['id']; ?>" <?php echo isset($menu) && $menu['kategori_id'] == $kat['id'] ? 'selected' : ''; ?>><?php echo $kat['nama']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="block">Tersedia:</label>
        <select name="tersedia" class="border p-2 w-full">
            <option value="1" <?php echo isset($menu) && $menu['tersedia'] == 1 ? 'selected' : ''; ?>>Ya</option>
            <option value="0" <?php echo isset($menu) && $menu['tersedia'] == 0 ? 'selected' : ''; ?>>Tidak</option>
        </select>
    </div>
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php
require_once 'views/template/footer.php';
?>
