CREATE DATABASE db_tp10;
USE db_tp10;

CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    deskripsi VARCHAR(255)
);

CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    harga DECIMAL(10, 2) NOT NULL,
    kategori_id INT NOT NULL,
    tersedia BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE CASCADE
);

CREATE TABLE pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    tanggal_pesanan DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_harga DECIMAL(10, 2) NOT NULL,
    status ENUM('menunggu', 'diproses', 'selesai', 'dibatalkan') DEFAULT 'menunggu'
);

CREATE TABLE detail_pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pesanan_id INT NOT NULL,
    menu_id INT NOT NULL,
    jumlah INT NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pesanan_id) REFERENCES pesanan(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menu(id)
);

-- Insert sample data for Mie Gacoan
INSERT INTO kategori (nama, deskripsi) VALUES 
('Mie', 'Berbagai pilihan mie dengan level kepedasan'),
('Snack', 'Makanan ringan pendamping mie'),
('Minuman', 'Minuman segar untuk menemani makan');

-- Menu items for Mie Gacoan
INSERT INTO menu (nama, deskripsi, harga, kategori_id) VALUES
('Mie Suit', 'Mie asin gak pedes', 10455, 1),
('Mie Hompimpa Level 1', 'Mie asin agak pedes', 10455, 1),
('Mie Hompimpa Level 2', 'Mie asin pedes dikit bgt', 10455, 1),
('Mie Hompimpa Level 3', 'Mie asin pedes dikit', 10455, 1),
('Mie Hompimpa Level 4', 'Mie asin pedes', 10455, 1),
('Mie Hompimpa Level 5', 'Mie asin agak pedes bgt', 11000, 1),
('Mie Hompimpa Level 6', 'Mie asin lumayan pedes bgt', 11000, 1),
('Mie Hompimpa Level 7', 'Mie asin pedes bgt', 11000, 1),
('Mie Hompimpa Level 8', 'MIE ASIN PEDES BGT', 11000, 1),
('Mie Gacoan Level 0', 'Mie manis gak pedes', 10455, 1),
('Mie Gacoan Level 1', 'Mie manis agak pedes', 10455, 1),
('Mie Gacoan Level 2', 'Mie manis pedes dikit bgt', 10455, 1),
('Mie Gacoan Level 3', 'Mie manis pedes dikit', 10455, 1),
('Mie Gacoan Level 4', 'Mie manis pedes', 10455, 1),
('Mie Gacoan Level 5', 'Mie manis agak pedes bgt', 11000, 1),
('Mie Gacoan Level 6', 'Mie manis lumayan pedes bgt', 11000, 1),
('Mie Gacoan Level 7', 'Mie manis pedes bgt', 11000, 1),
('Mie Gacoan Level 8', 'MIE MANIS PEDES BGT', 11000, 1),
('Pangsit Goreng', 'Pangsit goreng renyah', 10455, 2),
('Siomay', 'Siomay kukus dengan saus kacang', 9456, 2),
('Udang Rambutan', 'Udang goreng tepung dengan balutan tepung renyah', 9456, 2),
('Udang keju', 'Udang goreng tepung isian keju', 9456, 2),
('Es Teh', 'Teh manis dingin', 5000, 3),
('Orange', 'Jeruk segar dingin', 6000, 3),
('Es Sluku Bathok', 'Kopi susu (meren)', 8000, 3),
('Chocoan', 'Minuman coklat kental hytam dingin', 7000, 3);

-- Sample orders with Indonesian names
INSERT INTO pesanan (nama_pelanggan, total_harga, status) VALUES
('Joko Widodo', 32000, 'selesai'),
('Fufufafa', 27000, 'diproses'),
('Abang Wowo', 40000, 'menunggu'),
('Diddy Mulyadih', 35000, 'selesai');

-- Sample order details
INSERT INTO detail_pesanan (pesanan_id, menu_id, jumlah, subtotal) VALUES
(1, 3, 1, 12000),
(1, 8, 1, 8000),
(1, 12, 2, 10000),
(2, 5, 1, 12000),
(2, 9, 1, 10000),
(2, 13, 1, 6000),
(3, 7, 1, 15000),
(3, 10, 1, 12000),
(3, 14, 1, 8000),
(3, 8, 1, 8000),
(4, 2, 2, 24000),
(4, 11, 1, 10000);