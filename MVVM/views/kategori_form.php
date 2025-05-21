<?php
require_once 'views/template/header.php';
?>

<h2 class="text-xl mb-4"><?php echo isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori'; ?></h2>
<form action="index.php?entity=kategori&action=<?php echo isset($kategori) ? 'update&id=' . $kategori['id'] : 'save'; ?>" method="POST" class="space-y-4">
    <div>
        <label class="block">Nama:</label>
        <input type="text" name="nama" value="<?php echo isset($kategori) ? $kategori['nama'] : ''; ?>" class="border p-2 w-full" required>
    </div>
    <div>
        <label class="block">Deskripsi:</label>
        <textarea name="deskripsi" class="border p-2 w-full" rows="3"><?php echo isset($kategori) ? $kategori['deskripsi'] : ''; ?></textarea>
    </div>
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php
require_once 'views/template/footer.php';
?>
