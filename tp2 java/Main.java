import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

class PetShop {
    protected int id;
    protected String namaProduk;
    protected double hargaProduk;
    protected int stokProduk;

    public PetShop(int id, String namaProduk, double hargaProduk, int stokProduk) {
        this.id = id;
        this.namaProduk = namaProduk;
        this.hargaProduk = hargaProduk;
        this.stokProduk = stokProduk;
    }
}

class Aksesoris extends PetShop {
    protected String jenis;
    protected String bahan;
    protected String warna;

    public Aksesoris(int id, String namaProduk, double hargaProduk, int stokProduk, String jenis, String bahan, String warna) {
        super(id, namaProduk, hargaProduk, stokProduk);
        this.jenis = jenis;
        this.bahan = bahan;
        this.warna = warna;
    }
}

class Baju extends Aksesoris {
    protected String ukuran;
    protected String merk;

    public Baju(int id, String namaProduk, double hargaProduk, int stokProduk, String jenis, String bahan, String warna, String ukuran, String merk) {
        super(id, namaProduk, hargaProduk, stokProduk, jenis, bahan, warna);
        this.ukuran = ukuran;
        this.merk = merk;
    }
}

public class Main {
    private static List<Aksesoris> daftarProduk = new ArrayList<>();
    private static int autoIncrementID = 1;
    private static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        tambahProdukAwal();

        while (true) {
            System.out.println("\nMenu:");
            System.out.println("1. Tampilkan Tabel");
            System.out.println("2. Tambah Data");
            System.out.println("3. Keluar");
            System.out.print("Pilih menu: ");

            if (!scanner.hasNextInt()) {
                System.out.println("Input tidak valid. Masukkan angka!");
                scanner.next();
                continue;
            }
            
            int pilihan = scanner.nextInt();
            scanner.nextLine();

            switch (pilihan) {
                case 1:
                    tampilkanTabel();
                    break;
                case 2:
                    tambahProdukDariUser();
                    break;
                case 3:
                    System.out.println("Terima kasih!");
                    scanner.close();
                    return;
                default:
                    System.out.println("Pilihan tidak valid. Coba lagi.");
            }
        }
    }

    private static void tambahProdukAwal() {
        daftarProduk.add(new Baju(autoIncrementID++, "Kaos Anjing", 50000, 10, "Pakaian", "Katun", "Merah", "M", "PetBrand"));
        daftarProduk.add(new Baju(autoIncrementID++, "Jaket Kucing", 75000, 5, "Pakaian", "Wool", "Hitam", "L", "FurWear"));
        daftarProduk.add(new Aksesoris(autoIncrementID++, "Kerah Anjing", 30000, 20, "Aksesoris", "Kulit", "Coklat"));
        daftarProduk.add(new Aksesoris(autoIncrementID++, "Topi Kelinci", 25000, 7, "Aksesoris", "Polyester", "Putih"));
        daftarProduk.add(new Baju(autoIncrementID++, "Baju Hamster", 20000, 15, "Pakaian", "Katun", "Biru", "XS", "TinyWear"));
    }

    private static void tambahProdukDariUser() {
        System.out.print("Nama Produk: ");
        String namaProduk = scanner.nextLine();

        System.out.print("Harga Produk: ");
        while (!scanner.hasNextDouble()) {
            System.out.println("Harap masukkan angka!");
            scanner.next();
        }
        double hargaProduk = scanner.nextDouble();
        
        System.out.print("Stok Produk: ");
        while (!scanner.hasNextInt()) {
            System.out.println("Harap masukkan angka!");
            scanner.next();
        }
        int stokProduk = scanner.nextInt();
        scanner.nextLine();
        
        System.out.print("Jenis (Pakaian/Aksesoris): ");
        String jenis = scanner.nextLine();
        
        System.out.print("Bahan: ");
        String bahan = scanner.nextLine();
        
        System.out.print("Warna: ");
        String warna = scanner.nextLine();
        
        if (jenis.equalsIgnoreCase("Pakaian")) {
            System.out.print("Ukuran: ");
            String ukuran = scanner.nextLine();
            
            System.out.print("Merk: ");
            String merk = scanner.nextLine();
            
            daftarProduk.add(new Baju(autoIncrementID++, namaProduk, hargaProduk, stokProduk, jenis, bahan, warna, ukuran, merk));
        } else {
            daftarProduk.add(new Aksesoris(autoIncrementID++, namaProduk, hargaProduk, stokProduk, jenis, bahan, warna));
        }

        System.out.println("Produk berhasil ditambahkan!");
    }

    private static void tampilkanTabel() {
        // Menentukan panjang maksimum untuk setiap kolom
        int maxID = 2; // Default untuk "ID"
        int maxNama = "Nama Produk".length();
        int maxHarga = "Harga".length();
        int maxJenis = "Jenis".length();
        int maxBahan = "Bahan".length();
        int maxWarna = "Warna".length();
        int maxUkuran = "Ukuran".length();
        int maxMerk = "Merk".length();
        
        // Hitung lebar maksimum untuk setiap kolom
        for (Aksesoris a : daftarProduk) {
            maxID = Math.max(maxID, String.valueOf(a.id).length());
            maxNama = Math.max(maxNama, a.namaProduk.length());
            maxHarga = Math.max(maxHarga, String.format("%,.0f", a.hargaProduk).length());
            maxJenis = Math.max(maxJenis, a.jenis.length());
            maxBahan = Math.max(maxBahan, a.bahan.length());
            maxWarna = Math.max(maxWarna, a.warna.length());
            
            if (a instanceof Baju) {
                Baju b = (Baju) a;
                maxUkuran = Math.max(maxUkuran, b.ukuran.length());
                maxMerk = Math.max(maxMerk, b.merk.length());
            }
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
        System.out.print("|ID");
        printSpaces(maxID - 2);
        System.out.print("|Nama Produk");
        printSpaces(maxNama - 11);
        System.out.print("|Harga");
        printSpaces(maxHarga - 5);
        System.out.print("|Jenis");
        printSpaces(maxJenis - 5);
        System.out.print("|Bahan");
        printSpaces(maxBahan - 5);
        System.out.print("|Warna");
        printSpaces(maxWarna - 5);
        System.out.print("|Ukuran");
        printSpaces(maxUkuran - 6);
        System.out.print("|Merk");
        printSpaces(maxMerk - 4);
        System.out.println("|");
        
        // Garis pemisah
        printHorizontalLine(maxID, maxNama, maxHarga, maxJenis, maxBahan, maxWarna, maxUkuran, maxMerk);
        
        // Cetak data
        for (Aksesoris a : daftarProduk) {
            String idStr = String.valueOf(a.id);
            String hargaStr = String.format("%,.0f", a.hargaProduk);
            
            System.out.print("|" + idStr);
            printSpaces(maxID - idStr.length());
            System.out.print("|" + a.namaProduk);
            printSpaces(maxNama - a.namaProduk.length());
            System.out.print("|" + hargaStr);
            printSpaces(maxHarga - hargaStr.length());
            System.out.print("|" + a.jenis);
            printSpaces(maxJenis - a.jenis.length());
            System.out.print("|" + a.bahan);
            printSpaces(maxBahan - a.bahan.length());
            System.out.print("|" + a.warna);
            printSpaces(maxWarna - a.warna.length());
            
            if (a instanceof Baju) {
                Baju b = (Baju) a;
                System.out.print("|" + b.ukuran);
                printSpaces(maxUkuran - b.ukuran.length());
                System.out.print("|" + b.merk);
                printSpaces(maxMerk - b.merk.length());
            } else {
                System.out.print("|-");
                printSpaces(maxUkuran - 1);
                System.out.print("|-");
                printSpaces(maxMerk - 1);
            }
            System.out.println("|");
        }
        
        // Garis penutup
        printHorizontalLine(maxID, maxNama, maxHarga, maxJenis, maxBahan, maxWarna, maxUkuran, maxMerk);
    }
    
    private static void printHorizontalLine(int maxID, int maxNama, int maxHarga, int maxJenis, int maxBahan, int maxWarna, int maxUkuran, int maxMerk) {
        System.out.print("+");
        printDashes(maxID);
        System.out.print("+");
        printDashes(maxNama);
        System.out.print("+");
        printDashes(maxHarga);
        System.out.print("+");
        printDashes(maxJenis);
        System.out.print("+");
        printDashes(maxBahan);
        System.out.print("+");
        printDashes(maxWarna);
        System.out.print("+");
        printDashes(maxUkuran);
        System.out.print("+");
        printDashes(maxMerk);
        System.out.println("+");
    }
    
    private static void printDashes(int count) {
        for (int i = 0; i < count; i++) {
            System.out.print("-");
        }
    }
    
    private static void printSpaces(int count) {
        for (int i = 0; i < count; i++) {
            System.out.print(" ");
        }
    }
}