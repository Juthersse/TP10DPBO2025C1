# TP10DPBO2025C1

# Janji
Saya Muhammad Ichsan Khairullah dengan NIM 2306924 mengerjakan Latihan Modul dan Tugas Praktikum 10 dalam mata kuliah Desain dan Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program
Program ini menggunakan arsitektur MVVM (Model-View-ViewModel) dengan struktur sebagai berikut:
```mermaid
graph TD
    subgraph Views
        K[Kategori List & Form]
        M[Menu List & Form]
        P[Pesanan List, Form, & View]
    end

    subgraph ViewModels
        KVM[KategoriViewModel]
        MVM[MenuViewModel]
        PVM[PesananViewModel]
    end

    subgraph Models
        KM[Kategori Model]
        MM[Menu Model]
        PM[Pesanan Model]
        DPM[DetailPesanan Model]
        DB[(Database)]
    end

    %% View to ViewModel connections
    K --> KVM
    M --> MVM
    P --> PVM

    %% ViewModel to Model connections
    KVM --> KM
    MVM --> MM
    MVM --> KM
    PVM --> PM
    PVM --> DPM
    PVM --> MM

    %% Model to Database connections
    KM --> DB
    MM --> DB
    PM --> DB
    DPM --> DB

    %% Styling with darker text
    classDef viewStyle fill:#f9f,stroke:#333,stroke-width:2px,color:#000
    classDef vmStyle fill:#bbf,stroke:#333,stroke-width:2px,color:#000
    classDef modelStyle fill:#bfb,stroke:#333,stroke-width:2px,color:#000
    classDef dbStyle fill:#fff,stroke:#333,stroke-width:4px,color:#000

    class K,M,P viewStyle
    class KVM,MVM,PVM vmStyle
    class KM,MM,PM,DPM modelStyle
    class DB dbStyle
```
### 1. Model Layer
Database: Menangani koneksi ke database MySQL
Kelas-Kelas Model:
- Kategori: Mengelola data kategori menu
- Menu: Mengelola data menu makanan/minuman
- Pesanan: Mengelola data pesanan
- DetailPesanan: Mengelola detail item dalam pesanan
### 2. ViewModel Layer
Kelas-kelas ViewModel:
- KategoriViewModel: Logic untuk operasi kategori
- MenuViewModel: Logic untuk operasi menu
- PesananViewModel: Logic untuk operasi pesanan
### 3. View Layer
Template:
- header.php: Layout header universal
- footer.php: Layout footer universal
Form & List:
- Form kategori, menu, dan pesanan
- List/tabel untuk menampilkan data
- Detail view untuk pesanan

# Penjelasan Alur
Berikut adalah penjelasan alur program sistem manajemen restoran Mie Gacoan yang menggunakan arsitektur MVVM (Model-View-ViewModel).
```mermaid
sequenceDiagram
    actor User
    participant View
    participant ViewModel
    participant Model
    participant Database

    User->>+View: Memanggil Aksi (Tambah/Baca/Ubah/Hapus)
    View->>+ViewModel: prosesAksi(data)
    ViewModel->>+Model: eksekusiOperasi(dataValid)
    Model->>+Database: Query (INSERT/SELECT/UPDATE/DELETE)
    Database-->>-Model: Hasil/Status
    Model-->>-ViewModel: DataTerproses/Status
    ViewModel-->>-View: PerbaruiTampilan(respon)
    View-->>-User: Tampilkan View

    Note over View,ViewModel: Validasi & Format Data
    Note over ViewModel,Model: Pemrosesan Logika Bisnis
    Note over Model,Database: Lapisan Akses Data
```
1. User melakukan aksi melalui UI (View), seperti mengklik tombol atau mengisi form.
2. View menangkap aksi tersebut dan meneruskan data ke ViewModel untuk diproses lebih lanjut.
3. ViewModel melakukan validasi data dan menerapkan logika bisnis sebelum meneruskannya ke Model.
4. Model berkomunikasi dengan Database untuk melakukan operasi yang diperlukan (tambah/baca/ubah/hapus).
5. Hasil dari operasi database dikembalikan melalui jalur yang sama - dari Database ke Model, ke ViewModel, ke View, dan akhirnya ditampilkan ke User.

# Dokumentasi
![2025-05-21 10-37-32 (1)](https://github.com/user-attachments/assets/56e5f63e-c375-4515-99f7-f077cf60ee78)
