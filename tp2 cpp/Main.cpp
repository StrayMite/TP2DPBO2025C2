#include <iostream>
#include <vector>
#include <string>
#include <iomanip>
#include <algorithm>
#include <cmath>

class PetShop {
protected:
    int id;
    std::string namaProduk;
    double hargaProduk;
    int stokProduk;

public:
    PetShop(int id, const std::string& namaProduk, double hargaProduk, int stokProduk)
        : id(id), namaProduk(namaProduk), hargaProduk(hargaProduk), stokProduk(stokProduk) {}
    
    virtual ~PetShop() {}
};

class Aksesoris : public PetShop {
protected:
    std::string jenis;
    std::string bahan;
    std::string warna;

public:
    Aksesoris(int id, const std::string& namaProduk, double hargaProduk, int stokProduk,
              const std::string& jenis, const std::string& bahan, const std::string& warna)
        : PetShop(id, namaProduk, hargaProduk, stokProduk), jenis(jenis), bahan(bahan), warna(warna) {}
    
    // Getter methods for accessing from main
    int getId() const { return id; }
    std::string getNamaProduk() const { return namaProduk; }
    double getHargaProduk() const { return hargaProduk; }
    std::string getJenis() const { return jenis; }
    std::string getBahan() const { return bahan; }
    std::string getWarna() const { return warna; }
    
    virtual std::string getUkuran() const { return "-"; }
    virtual std::string getMerk() const { return "-"; }
    
    virtual ~Aksesoris() {}
};

class Baju : public Aksesoris {
protected:
    std::string ukuran;
    std::string merk;

public:
    Baju(int id, const std::string& namaProduk, double hargaProduk, int stokProduk,
         const std::string& jenis, const std::string& bahan, const std::string& warna,
         const std::string& ukuran, const std::string& merk)
        : Aksesoris(id, namaProduk, hargaProduk, stokProduk, jenis, bahan, warna),
          ukuran(ukuran), merk(merk) {}
    
    std::string getUkuran() const override { return ukuran; }
    std::string getMerk() const override { return merk; }
    
    ~Baju() override {}
};

// Function prototypes
void tambahProdukAwal(std::vector<Aksesoris*>& daftarProduk, int& autoIncrementID);
void tambahProdukDariUser(std::vector<Aksesoris*>& daftarProduk, int& autoIncrementID);
void tampilkanTabel(const std::vector<Aksesoris*>& daftarProduk);
void printHorizontalLine(int maxID, int maxNama, int maxHarga, int maxJenis, int maxBahan, int maxWarna, int maxUkuran, int maxMerk);
void printDashes(int count);
void printSpaces(int count);
bool isNumber(const std::string& s);

int main() {
    std::vector<Aksesoris*> daftarProduk;
    int autoIncrementID = 1;
    
    tambahProdukAwal(daftarProduk, autoIncrementID);
    
    while (true) {
        std::string input;
        int pilihan;
        
        std::cout << "\nMenu:" << std::endl;
        std::cout << "1. Tampilkan Tabel" << std::endl;
        std::cout << "2. Tambah Data" << std::endl;
        std::cout << "3. Keluar" << std::endl;
        std::cout << "Pilih menu: ";
        
        std::cin >> input;
        
        if (!isNumber(input)) {
            std::cout << "Input tidak valid. Masukkan angka!" << std::endl;
            std::cin.clear();
            std::cin.ignore(10000, '\n');
            continue;
        }
        
        pilihan = std::stoi(input);
        std::cin.ignore(10000, '\n');  // Clear the input buffer
        
        switch (pilihan) {
            case 1:
                tampilkanTabel(daftarProduk);
                break;
            case 2:
                tambahProdukDariUser(daftarProduk, autoIncrementID);
                break;
            case 3:
                std::cout << "Terima kasih!" << std::endl;
                // Free memory
                for (auto produk : daftarProduk) {
                    delete produk;
                }
                return 0;
            default:
                std::cout << "Pilihan tidak valid. Coba lagi." << std::endl;
        }
    }
    
    return 0;
}

void tambahProdukAwal(std::vector<Aksesoris*>& daftarProduk, int& autoIncrementID) {
    daftarProduk.push_back(new Baju(autoIncrementID++, "Kaos Anjing", 50000, 10, "Pakaian", "Katun", "Merah", "M", "PetBrand"));
    daftarProduk.push_back(new Baju(autoIncrementID++, "Jaket Kucing", 75000, 5, "Pakaian", "Wool", "Hitam", "L", "FurWear"));
    daftarProduk.push_back(new Aksesoris(autoIncrementID++, "Kerah Anjing", 30000, 20, "Aksesoris", "Kulit", "Coklat"));
    daftarProduk.push_back(new Aksesoris(autoIncrementID++, "Topi Kelinci", 25000, 7, "Aksesoris", "Polyester", "Putih"));
    daftarProduk.push_back(new Baju(autoIncrementID++, "Baju Hamster", 20000, 15, "Pakaian", "Katun", "Biru", "XS", "TinyWear"));
}

void tambahProdukDariUser(std::vector<Aksesoris*>& daftarProduk, int& autoIncrementID) {
    std::string namaProduk, jenis, bahan, warna, ukuran, merk, input;
    double hargaProduk;
    int stokProduk;
    
    std::cout << "Nama Produk: ";
    std::getline(std::cin, namaProduk);
    
    while (true) {
        std::cout << "Harga Produk: ";
        std::getline(std::cin, input);
        
        if (isNumber(input)) {
            hargaProduk = std::stod(input);
            break;
        }
        
        std::cout << "Harap masukkan angka!" << std::endl;
    }
    
    while (true) {
        std::cout << "Stok Produk: ";
        std::getline(std::cin, input);
        
        if (isNumber(input)) {
            stokProduk = std::stoi(input);
            break;
        }
        
        std::cout << "Harap masukkan angka!" << std::endl;
    }
    
    std::cout << "Jenis (Pakaian/Aksesoris): ";
    std::getline(std::cin, jenis);
    
    std::cout << "Bahan: ";
    std::getline(std::cin, bahan);
    
    std::cout << "Warna: ";
    std::getline(std::cin, warna);
    
    if (jenis == "Pakaian" || jenis == "pakaian") {
        std::cout << "Ukuran: ";
        std::getline(std::cin, ukuran);
        
        std::cout << "Merk: ";
        std::getline(std::cin, merk);
        
        daftarProduk.push_back(new Baju(autoIncrementID++, namaProduk, hargaProduk, stokProduk, jenis, bahan, warna, ukuran, merk));
    } else {
        daftarProduk.push_back(new Aksesoris(autoIncrementID++, namaProduk, hargaProduk, stokProduk, jenis, bahan, warna));
    }
    
    std::cout << "Produk berhasil ditambahkan!" << std::endl;
}

void tampilkanTabel(const std::vector<Aksesoris*>& daftarProduk) {
    // Menentukan panjang maksimum untuk setiap kolom
    int maxID = 2; // Default untuk "ID"
    int maxNama = 11; // "Nama Produk".length()
    int maxHarga = 5; // "Harga".length()
    int maxJenis = 5; // "Jenis".length()
    int maxBahan = 5; // "Bahan".length()
    int maxWarna = 5; // "Warna".length()
    int maxUkuran = 6; // "Ukuran".length()
    int maxMerk = 4; // "Merk".length()
    
    // Hitung lebar maksimum untuk setiap kolom
    for (const auto& a : daftarProduk) {
        maxID = std::max(maxID, static_cast<int>(std::to_string(a->getId()).length()));
        maxNama = std::max(maxNama, static_cast<int>(a->getNamaProduk().length()));
        
        // Format harga as string with commas
        std::string hargaStr = std::to_string(static_cast<int>(a->getHargaProduk()));
        maxHarga = std::max(maxHarga, static_cast<int>(hargaStr.length()));
        
        maxJenis = std::max(maxJenis, static_cast<int>(a->getJenis().length()));
        maxBahan = std::max(maxBahan, static_cast<int>(a->getBahan().length()));
        maxWarna = std::max(maxWarna, static_cast<int>(a->getWarna().length()));
        maxUkuran = std::max(maxUkuran, static_cast<int>(a->getUkuran().length()));
        maxMerk = std::max(maxMerk, static_cast<int>(a->getMerk().length()));
    }
    
    // Tambahkan padding
    maxID += 2;
    maxNama += 2;
    maxHarga += 2;
    maxJenis += 2;
    maxBahan += 2;
    maxWarna += 2;
    maxUkuran += 2;
    maxMerk += 2;
    
    // Membuat garis pemisah horizontal
    printHorizontalLine(maxID, maxNama, maxHarga, maxJenis, maxBahan, maxWarna, maxUkuran, maxMerk);
    
    // Cetak header
    std::cout << "|ID";
    printSpaces(maxID - 2);
    std::cout << "|Nama Produk";
    printSpaces(maxNama - 11);
    std::cout << "|Harga";
    printSpaces(maxHarga - 5);
    std::cout << "|Jenis";
    printSpaces(maxJenis - 5);
    std::cout << "|Bahan";
    printSpaces(maxBahan - 5);
    std::cout << "|Warna";
    printSpaces(maxWarna - 5);
    std::cout << "|Ukuran";
    printSpaces(maxUkuran - 6);
    std::cout << "|Merk";
    printSpaces(maxMerk - 4);
    std::cout << "|" << std::endl;
    
    // Garis pemisah
    printHorizontalLine(maxID, maxNama, maxHarga, maxJenis, maxBahan, maxWarna, maxUkuran, maxMerk);
    
    // Cetak data
    for (const auto& a : daftarProduk) {
        std::string idStr = std::to_string(a->getId());
        std::string hargaStr = std::to_string(static_cast<int>(a->getHargaProduk()));
        
        std::cout << "|" << idStr;
        printSpaces(maxID - idStr.length());
        std::cout << "|" << a->getNamaProduk();
        printSpaces(maxNama - a->getNamaProduk().length());
        std::cout << "|" << hargaStr;
        printSpaces(maxHarga - hargaStr.length());
        std::cout << "|" << a->getJenis();
        printSpaces(maxJenis - a->getJenis().length());
        std::cout << "|" << a->getBahan();
        printSpaces(maxBahan - a->getBahan().length());
        std::cout << "|" << a->getWarna();
        printSpaces(maxWarna - a->getWarna().length());
        std::cout << "|" << a->getUkuran();
        printSpaces(maxUkuran - a->getUkuran().length());
        std::cout << "|" << a->getMerk();
        printSpaces(maxMerk - a->getMerk().length());
        std::cout << "|" << std::endl;
    }
    
    // Garis penutup
    printHorizontalLine(maxID, maxNama, maxHarga, maxJenis, maxBahan, maxWarna, maxUkuran, maxMerk);
}

void printHorizontalLine(int maxID, int maxNama, int maxHarga, int maxJenis, int maxBahan, int maxWarna, int maxUkuran, int maxMerk) {
    std::cout << "+";
    printDashes(maxID);
    std::cout << "+";
    printDashes(maxNama);
    std::cout << "+";
    printDashes(maxHarga);
    std::cout << "+";
    printDashes(maxJenis);
    std::cout << "+";
    printDashes(maxBahan);
    std::cout << "+";
    printDashes(maxWarna);
    std::cout << "+";
    printDashes(maxUkuran);
    std::cout << "+";
    printDashes(maxMerk);
    std::cout << "+" << std::endl;
}

void printDashes(int count) {
    for (int i = 0; i < count; i++) {
        std::cout << "-";
    }
}

void printSpaces(int count) {
    for (int i = 0; i < count; i++) {
        std::cout << " ";
    }
}

bool isNumber(const std::string& s) {
    return !s.empty() && std::find_if(s.begin(), s.end(), 
        [](unsigned char c) { return !std::isdigit(c) && c != '.'; }) == s.end();
}