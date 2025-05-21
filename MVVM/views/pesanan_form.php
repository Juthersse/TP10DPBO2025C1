<?php
require_once 'views/template/header.php';
?>

<h2 class="text-xl mb-4"><?php echo isset($pesanan) ? 'Edit Pesanan' : 'Tambah Pesanan'; ?></h2>
<form action="index.php?entity=pesanan&action=<?php echo isset($pesanan) ? 'update&id=' . $pesanan['id'] : 'save'; ?>" method="POST" class="space-y-4">
    <div>
        <label class="block">Nama Pelanggan:</label>
        <input type="text" name="nama_pelanggan" value="<?php echo isset($pesanan) ? $pesanan['nama_pelanggan'] : ''; ?>" class="border p-2 w-full" required>
    </div>
    
    <?php if (isset($pesanan)): ?>
    <div>
        <label class="block">Status:</label>
        <select name="status" class="border p-2 w-full">
            <option value="menunggu" <?php echo $pesanan['status'] == 'menunggu' ? 'selected' : ''; ?>>Menunggu</option>
            <option value="diproses" <?php echo $pesanan['status'] == 'diproses' ? 'selected' : ''; ?>>Diproses</option>
            <option value="selesai" <?php echo $pesanan['status'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
            <option value="dibatalkan" <?php echo $pesanan['status'] == 'dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
        </select>
    </div>
    <?php endif; ?>
    
    <div>
        <h3 class="text-lg font-semibold mb-2">Item Pesanan</h3>
        <div id="pesanan-items">
            <?php 
            if (isset($detailPesanan) && count($detailPesanan) > 0):
                foreach ($detailPesanan as $index => $item):
            ?>
                <div class="pesanan-item grid grid-cols-4 gap-2 mb-2">
                    <select name="items[<?php echo $index; ?>][menu_id]" class="menu-item-select border p-2" required>
                        <?php foreach ($menuItems as $menuItem): ?>
                        <option value="<?php echo $menuItem['id']; ?>" 
                                data-price="<?php echo $menuItem['harga']; ?>"
                                <?php echo $item['menu_id'] == $menuItem['id'] ? 'selected' : ''; ?>>
                            <?php echo $menuItem['nama']; ?> - Rp <?php echo number_format($menuItem['harga'], 0, ',', '.'); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="items[<?php echo $index; ?>][jumlah]" value="<?php echo $item['jumlah']; ?>" min="1" class="quantity-input border p-2" required>
                    <div class="subtotal p-2 border bg-gray-100">Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></div>
                    <button type="button" class="remove-item bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                </div>
            <?php 
                endforeach;
            else:
            ?>
                <div class="pesanan-item grid grid-cols-4 gap-2 mb-2">
                    <select name="items[0][menu_id]" class="menu-item-select border p-2" required>
                        <?php foreach ($menuItems as $menuItem): ?>
                        <option value="<?php echo $menuItem['id']; ?>" data-price="<?php echo $menuItem['harga']; ?>">
                            <?php echo $menuItem['nama']; ?> - Rp <?php echo number_format($menuItem['harga'], 0, ',', '.'); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="items[0][jumlah]" value="1" min="1" class="quantity-input border p-2" required>
                    <div class="subtotal p-2 border bg-gray-100">Rp <?php echo number_format($menuItems[0]['harga'], 0, ',', '.'); ?></div>
                    <button type="button" class="remove-item bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                </div>
            <?php endif; ?>
        </div>
        <button type="button" id="add-item" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Tambah Item</button>
    </div>
    
    <div class="text-right">
        <div class="text-lg font-semibold">Total: Rp <span id="total-amount">0</span></div>
    </div>
    
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Simpan Pesanan</button>
</form>

<script>
$(document).ready(function() {
    // Calculate initial total
    calculateTotal();
    
    // Add new item
    $('#add-item').click(function() {
        var index = $('.pesanan-item').length;
        var newItem = `
            <div class="pesanan-item grid grid-cols-4 gap-2 mb-2">
                <select name="items[${index}][menu_id]" class="menu-item-select border p-2" required>
                    <?php foreach ($menuItems as $menuItem): ?>
                    <option value="<?php echo $menuItem['id']; ?>" data-price="<?php echo $menuItem['harga']; ?>">
                        <?php echo $menuItem['nama']; ?> - Rp <?php echo number_format($menuItem['harga'], 0, ',', '.'); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="items[${index}][jumlah]" value="1" min="1" class="quantity-input border p-2" required>
                <div class="subtotal p-2 border bg-gray-100">Rp <?php echo number_format($menuItems[0]['harga'], 0, ',', '.'); ?></div>
                <button type="button" class="remove-item bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
            </div>
        `;
        $('#pesanan-items').append(newItem);
        calculateSubtotal($('#pesanan-items .pesanan-item:last-child'));
        calculateTotal();
    });
    
    // Remove item
    $(document).on('click', '.remove-item', function() {
        if ($('.pesanan-item').length > 1) {
            $(this).closest('.pesanan-item').remove();
            // Reindex items
            $('.pesanan-item').each(function(i) {
                $(this).find('select').attr('name', `items[${i}][menu_id]`);
                $(this).find('input').attr('name', `items[${i}][jumlah]`);
            });
            calculateTotal();
        } else {
            alert('Pesanan harus memiliki minimal satu item');
        }
    });
    
    // Update subtotal when menu item or quantity changes
    $(document).on('change', '.menu-item-select, .quantity-input', function() {
        calculateSubtotal($(this).closest('.pesanan-item'));
        calculateTotal();
    });
    
    // Calculate subtotal for an item
    function calculateSubtotal(item) {
        var price = parseFloat(item.find('.menu-item-select option:selected').data('price'));
        var quantity = parseInt(item.find('.quantity-input').val());
        var subtotal = price * quantity;
        item.find('.subtotal').text('Rp ' + formatNumber(subtotal));
    }
    
    // Calculate total amount
    function calculateTotal() {
        var total = 0;
        $('.pesanan-item').each(function() {
            var subtotalText = $(this).find('.subtotal').text();
            var subtotal = parseFloat(subtotalText.replace('Rp ', '').replace(/\./g, '').replace(',', '.'));
            total += subtotal;
        });
        $('#total-amount').text(formatNumber(total));
    }
    
    // Format number to Indonesian currency format
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
});
</script>

<?php
require_once 'views/template/footer.php';
?>
