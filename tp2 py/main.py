class PetShop:
    def __init__(self, id, nama_produk, harga_produk, stok_produk):
        self.id = id
        self.nama_produk = nama_produk
        self.harga_produk = harga_produk
        self.stok_produk = stok_produk


class Aksesoris(PetShop):
    def __init__(self, id, nama_produk, harga_produk, stok_produk, jenis, bahan, warna):
        super().__init__(id, nama_produk, harga_produk, stok_produk)
        self.jenis = jenis
        self.bahan = bahan
        self.warna = warna


class Baju(Aksesoris):
    def __init__(self, id, nama_produk, harga_produk, stok_produk, jenis, bahan, warna, ukuran, merk):
        super().__init__(id, nama_produk, harga_produk, stok_produk, jenis, bahan, warna)
        self.ukuran = ukuran
        self.merk = merk


daftar_produk = []
auto_increment_id = 1


def tambah_produk_awal():
    global auto_increment_id
    daftar_produk.append(Baju(auto_increment_id, "Kaos Anjing", 50000, 10, "Pakaian", "Katun", "Merah", "M", "PetBrand"))
    auto_increment_id += 1
    daftar_produk.append(Baju(auto_increment_id, "Jaket Kucing", 75000, 5, "Pakaian", "Wool", "Hitam", "L", "FurWear"))
    auto_increment_id += 1
    daftar_produk.append(Aksesoris(auto_increment_id, "Kerah Anjing", 30000, 20, "Aksesoris", "Kulit", "Coklat"))
    auto_increment_id += 1
    daftar_produk.append(Aksesoris(auto_increment_id, "Topi Kelinci", 25000, 7, "Aksesoris", "Polyester", "Putih"))
    auto_increment_id += 1
    daftar_produk.append(Baju(auto_increment_id, "Baju Hamster", 20000, 15, "Pakaian", "Katun", "Biru", "XS", "TinyWear"))
    auto_increment_id += 1


def tambah_produk_dari_user():
    global auto_increment_id
    
    nama_produk = input("Nama Produk: ")
    
    while True:
        try:
            harga_produk = float(input("Harga Produk: "))
            break
        except ValueError:
            print("Harap masukkan angka!")
    
    while True:
        try:
            stok_produk = int(input("Stok Produk: "))
            break
        except ValueError:
            print("Harap masukkan angka!")
    
    jenis = input("Jenis (Pakaian/Aksesoris): ")
    bahan = input("Bahan: ")
    warna = input("Warna: ")
    
    if jenis.lower() == "pakaian":
        ukuran = input("Ukuran: ")
        merk = input("Merk: ")
        daftar_produk.append(Baju(auto_increment_id, nama_produk, harga_produk, stok_produk, jenis, bahan, warna, ukuran, merk))
    else:
        daftar_produk.append(Aksesoris(auto_increment_id, nama_produk, harga_produk, stok_produk, jenis, bahan, warna))
    
    auto_increment_id += 1
    print("Produk berhasil ditambahkan!")


def print_dashes(count):
    return "-" * count


def print_spaces(count):
    return " " * count


def print_horizontal_line(max_id, max_nama, max_harga, max_jenis, max_bahan, max_warna, max_ukuran, max_merk):
    line = "+"
    line += print_dashes(max_id) + "+"
    line += print_dashes(max_nama) + "+"
    line += print_dashes(max_harga) + "+"
    line += print_dashes(max_jenis) + "+"
    line += print_dashes(max_bahan) + "+"
    line += print_dashes(max_warna) + "+"
    line += print_dashes(max_ukuran) + "+"
    line += print_dashes(max_merk) + "+"
    print(line)


def tampilkan_tabel():
    # Menentukan panjang maksimum untuk setiap kolom
    max_id = 2  # Default untuk "ID"
    max_nama = len("Nama Produk")
    max_harga = len("Harga")
    max_jenis = len("Jenis")
    max_bahan = len("Bahan")
    max_warna = len("Warna")
    max_ukuran = len("Ukuran")
    max_merk = len("Merk")
    
    # Hitung lebar maksimum untuk setiap kolom
    for a in daftar_produk:
        max_id = max(max_id, len(str(a.id)))
        max_nama = max(max_nama, len(a.nama_produk))
        max_harga = max(max_harga, len(f"{a.harga_produk:,.0f}"))
        max_jenis = max(max_jenis, len(a.jenis))
        max_bahan = max(max_bahan, len(a.bahan))
        max_warna = max(max_warna, len(a.warna))
        
        if isinstance(a, Baju):
            max_ukuran = max(max_ukuran, len(a.ukuran))
            max_merk = max(max_merk, len(a.merk))
    
    # Tambahkan padding
    max_id += 2
    max_nama += 2
    max_harga += 2
    max_jenis += 2
    max_bahan += 2
    max_warna += 2
    max_ukuran += 2
    max_merk += 2
    
    # Membuat garis pemisah horizontal
    print_horizontal_line(max_id, max_nama, max_harga, max_jenis, max_bahan, max_warna, max_ukuran, max_merk)
    
    # Cetak header
    header = "|ID" + print_spaces(max_id - 2)
    header += "|Nama Produk" + print_spaces(max_nama - 11)
    header += "|Harga" + print_spaces(max_harga - 5)
    header += "|Jenis" + print_spaces(max_jenis - 5)
    header += "|Bahan" + print_spaces(max_bahan - 5)
    header += "|Warna" + print_spaces(max_warna - 5)
    header += "|Ukuran" + print_spaces(max_ukuran - 6)
    header += "|Merk" + print_spaces(max_merk - 4) + "|"
    print(header)
    
    # Garis pemisah
    print_horizontal_line(max_id, max_nama, max_harga, max_jenis, max_bahan, max_warna, max_ukuran, max_merk)
    
    # Cetak data
    for a in daftar_produk:
        id_str = str(a.id)
        harga_str = f"{a.harga_produk:,.0f}"
        
        row = "|" + id_str + print_spaces(max_id - len(id_str))
        row += "|" + a.nama_produk + print_spaces(max_nama - len(a.nama_produk))
        row += "|" + harga_str + print_spaces(max_harga - len(harga_str))
        row += "|" + a.jenis + print_spaces(max_jenis - len(a.jenis))
        row += "|" + a.bahan + print_spaces(max_bahan - len(a.bahan))
        row += "|" + a.warna + print_spaces(max_warna - len(a.warna))
        
        if isinstance(a, Baju):
            row += "|" + a.ukuran + print_spaces(max_ukuran - len(a.ukuran))
            row += "|" + a.merk + print_spaces(max_merk - len(a.merk))
        else:
            row += "|-" + print_spaces(max_ukuran - 1)
            row += "|-" + print_spaces(max_merk - 1)
        
        row += "|"
        print(row)
    
    # Garis penutup
    print_horizontal_line(max_id, max_nama, max_harga, max_jenis, max_bahan, max_warna, max_ukuran, max_merk)


def main():
    tambah_produk_awal()
    
    while True:
        print("\nMenu:")
        print("1. Tampilkan Tabel")
        print("2. Tambah Data")
        print("3. Keluar")
        
        try:
            pilihan = int(input("Pilih menu: "))
        except ValueError:
            print("Input tidak valid. Masukkan angka!")
            continue
        
        if pilihan == 1:
            tampilkan_tabel()
        elif pilihan == 2:
            tambah_produk_dari_user()
        elif pilihan == 3:
            print("Terima kasih!")
            break
        else:
            print("Pilihan tidak valid. Coba lagi.")


if __name__ == "__main__":
    main()