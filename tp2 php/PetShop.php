<?php
class PetShop {
    protected $id;
    protected $namaProduk;
    protected $hargaProduk;
    protected $stokProduk;

    public function __construct($id, $namaProduk, $hargaProduk, $stokProduk) {
        $this->id = $id;
        $this->namaProduk = $namaProduk;
        $this->hargaProduk = $hargaProduk;
        $this->stokProduk = $stokProduk;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNamaProduk() {
        return $this->namaProduk;
    }

    public function getHargaProduk() {
        return $this->hargaProduk;
    }

    public function getStokProduk() {
        return $this->stokProduk;
    }
}

class Aksesoris extends PetShop {
    protected $jenis;
    protected $bahan;
    protected $warna;
    protected $gambar;

    public function __construct($id, $namaProduk, $hargaProduk, $stokProduk, $jenis, $bahan, $warna, $gambar = "default.jpg") {
        parent::__construct($id, $namaProduk, $hargaProduk, $stokProduk);
        $this->jenis = $jenis;
        $this->bahan = $bahan;
        $this->warna = $warna;
        $this->gambar = $gambar;
    }

    // Getters
    public function getJenis() {
        return $this->jenis;
    }

    public function getBahan() {
        return $this->bahan;
    }

    public function getWarna() {
        return $this->warna;
    }

    public function getGambar() {
        return $this->gambar;
    }

    public function getUkuran() {
        return "-";
    }

    public function getMerk() {
        return "-";
    }
}

class Baju extends Aksesoris {
    protected $ukuran;
    protected $merk;

    public function __construct($id, $namaProduk, $hargaProduk, $stokProduk, $jenis, $bahan, $warna, $ukuran, $merk, $gambar = "default.jpg") {
        parent::__construct($id, $namaProduk, $hargaProduk, $stokProduk, $jenis, $bahan, $warna, $gambar);
        $this->ukuran = $ukuran;
        $this->merk = $merk;
    }

    // Override getters
    public function getUkuran() {
        return $this->ukuran;
    }

    public function getMerk() {
        return $this->merk;
    }
}

class PetShopManager {
    private $daftarProduk = [];
    private $autoIncrementID = 1;

    public function __construct() {
        $this->tambahProdukAwal();
    }

    private function tambahProdukAwal() {
        $this->daftarProduk[] = new Baju(
            $this->autoIncrementID++, "baju", 50000, 10, 
            "Pakaian", "Katun", "Merah", "M", "PetBrand", "Screenshot (499).png"
        );
        $this->daftarProduk[] = new Baju(
            $this->autoIncrementID++, "Jaket", 75000, 5, 
            "Pakaian", "Wool", "Hitam", "L", "FurWear", "Screenshot 2025-02-21 144815.png"
        );
        $this->daftarProduk[] = new Aksesoris(
            $this->autoIncrementID++, "idk", 30000, 20, 
            "Aksesoris", "Kulit", "Coklat", "Screenshot 2024-04-28 191617.png"
        );
        $this->daftarProduk[] = new Aksesoris(
            $this->autoIncrementID++, "hat", 25000, 7, 
            "Aksesoris", "Polyester", "Putih", "Screenshot (180).png"
        );
        $this->daftarProduk[] = new Baju(
            $this->autoIncrementID++, "spark", 20000, 15, 
            "Pakaian", "Katun", "Biru", "XS", "TinyWear", "Screenshot (28).png"
        );
    }

    public function tambahProduk($namaProduk, $hargaProduk, $stokProduk, $jenis, $bahan, $warna, $ukuran = null, $merk = null, $gambar = "default.jpg") {
        if ($jenis == "Pakaian") {
            $this->daftarProduk[] = new Baju(
                $this->autoIncrementID++, $namaProduk, $hargaProduk, $stokProduk, 
                $jenis, $bahan, $warna, $ukuran, $merk, $gambar
            );
        } else {
            $this->daftarProduk[] = new Aksesoris(
                $this->autoIncrementID++, $namaProduk, $hargaProduk, $stokProduk, 
                $jenis, $bahan, $warna, $gambar
            );
        }
        return true;
    }

    public function getDaftarProduk() {
        return $this->daftarProduk;
    }

    // Display products in card layout (similar to your template)
    public function displayProductsCards() {
        if (empty($this->daftarProduk)) {
            echo "<p>Tidak ada produk dalam daftar.</p>";
        } else {
            echo "<div style='display: flex; flex-wrap: wrap; gap: 20px;'>";
            foreach ($this->daftarProduk as $produk) {
                echo "
                    <div style='border: 1px solid #ccc; border-radius: 8px; padding: 15px; width: 250px; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>
                        <img src='{$produk->getGambar()}' alt='{$produk->getNamaProduk()}' style='width: 100%; height: 200px; object-fit: cover; border-radius: 4px;'>
                        <h3>{$produk->getNamaProduk()}</h3>
                        <p><strong>Kategori:</strong> {$produk->getJenis()}</p>
                        <p><strong>Harga:</strong> Rp " . number_format($produk->getHargaProduk(), 0, ',', '.') . "</p>
                        <p><strong>Bahan:</strong> {$produk->getBahan()}</p>
                        <p><strong>Warna:</strong> {$produk->getWarna()}</p>";
                
                // Display additional details for Baju
                if ($produk instanceof Baju) {
                    echo "
                        <p><strong>Ukuran:</strong> {$produk->getUkuran()}</p>
                        <p><strong>Merk:</strong> {$produk->getMerk()}</p>";
                }
                
                echo "
                        <p><strong>Stok:</strong> {$produk->getStokProduk()}</p>
                    </div>
                ";
            }
            echo "</div>";
        }
    }

    // Display products in table format
    public function displayProductsTable() {
        if (empty($this->daftarProduk)) {
            echo "<p>Tidak ada produk dalam daftar.</p>";
            return;
        }
        
        echo "<div style='overflow-x: auto;'>";
        echo "<table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>";
        echo "<thead style='background-color: #f2f2f2;'>";
        echo "<tr>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>ID</th>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>Nama Produk</th>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>Harga</th>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>Stok</th>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>Jenis</th>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>Bahan</th>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>Warna</th>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>Ukuran</th>
                <th style='border: 1px solid #ddd; padding: 10px; text-align: left;'>Merk</th>
              </tr>";
        echo "</thead>";
        echo "<tbody>";
        
        foreach ($this->daftarProduk as $produk) {
            echo "<tr>
                    <td style='border: 1px solid #ddd; padding: 10px;'>{$produk->getId()}</td>
                    <td style='border: 1px solid #ddd; padding: 10px;'>{$produk->getNamaProduk()}</td>
                    <td style='border: 1px solid #ddd; padding: 10px;'>Rp " . number_format($produk->getHargaProduk(), 0, ',', '.') . "</td>
                    <td style='border: 1px solid #ddd; padding: 10px;'>{$produk->getStokProduk()}</td>
                    <td style='border: 1px solid #ddd; padding: 10px;'>{$produk->getJenis()}</td>
                    <td style='border: 1px solid #ddd; padding: 10px;'>{$produk->getBahan()}</td>
                    <td style='border: 1px solid #ddd; padding: 10px;'>{$produk->getWarna()}</td>
                    <td style='border: 1px solid #ddd; padding: 10px;'>{$produk->getUkuran()}</td>
                    <td style='border: 1px solid #ddd; padding: 10px;'>{$produk->getMerk()}</td>
                  </tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }
}

// Initialize session if it doesn't exist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Create or retrieve the PetShopManager instance
if (!isset($_SESSION['petshopManager'])) {
    $_SESSION['petshopManager'] = new PetShopManager();
}
$petshopManager = $_SESSION['petshopManager'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambahProduk'])) {
    $namaProduk = $_POST['namaProduk'] ?? '';
    $hargaProduk = floatval($_POST['hargaProduk'] ?? 0);
    $stokProduk = intval($_POST['stokProduk'] ?? 0);
    $jenis = $_POST['jenis'] ?? '';
    $bahan = $_POST['bahan'] ?? '';
    $warna = $_POST['warna'] ?? '';
    
    // Default image
    $gambar = "default.jpg";
    
    // Handle file upload if available
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        
        // Create directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        // Generate a unique filename
        $fileExtension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid() . '.' . $fileExtension;
        $targetFile = $targetDir . $newFileName;
        
        // Move the uploaded file
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
            $gambar = $targetFile;
        }
    }
    
    if ($jenis === "Pakaian") {
        $ukuran = $_POST['ukuran'] ?? '';
        $merk = $_POST['merk'] ?? '';
        $petshopManager->tambahProduk($namaProduk, $hargaProduk, $stokProduk, $jenis, $bahan, $warna, $ukuran, $merk, $gambar);
    } else {
        $petshopManager->tambahProduk($namaProduk, $hargaProduk, $stokProduk, $jenis, $bahan, $warna, null, null, $gambar);
    }
    
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Get display mode preference
$displayMode = $_GET['display'] ?? 'cards';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Shop Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1, h2 {
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .conditional-field {
            display: none;
        }
        .view-options {
            margin-bottom: 20px;
        }
        .view-options a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .view-options a.active {
            background-color: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisSelect = document.getElementById('jenis');
            const conditionalFields = document.getElementById('conditionalFields');
            
            // Show/hide additional fields based on selection
            jenisSelect.addEventListener('change', function() {
                if (this.value === 'Pakaian') {
                    conditionalFields.style.display = 'block';
                } else {
                    conditionalFields.style.display = 'none';
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Pet Shop Management System</h1>
        
        <!-- Form to add new product -->
        <div class="form-container">
            <h2>Tambah Produk Baru</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="namaProduk">Nama Produk:</label>
                    <input type="text" id="namaProduk" name="namaProduk" required>
                </div>
                
                <div class="form-group">
                    <label for="hargaProduk">Harga Produk:</label>
                    <input type="number" id="hargaProduk" name="hargaProduk" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="stokProduk">Stok Produk:</label>
                    <input type="number" id="stokProduk" name="stokProduk" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="jenis">Jenis:</label>
                    <select id="jenis" name="jenis" required>
                        <option value="">--Pilih Jenis--</option>
                        <option value="Pakaian">Pakaian</option>
                        <option value="Aksesoris">Aksesoris</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="bahan">Bahan:</label>
                    <input type="text" id="bahan" name="bahan" required>
                </div>
                
                <div class="form-group">
                    <label for="warna">Warna:</label>
                    <input type="text" id="warna" name="warna" required>
                </div>
                
                <div id="conditionalFields" class="conditional-field">
                    <div class="form-group">
                        <label for="ukuran">Ukuran:</label>
                        <input type="text" id="ukuran" name="ukuran">
                    </div>
                    
                    <div class="form-group">
                        <label for="merk">Merk:</label>
                        <input type="text" id="merk" name="merk">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="gambar">Gambar Produk:</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*">
                </div>
                
                <button type="submit" name="tambahProduk">Tambah Produk</button>
            </form>
        </div>
        
        <!-- View options -->
        <div class="view-options">
            <a href="?display=cards" class="<?php echo $displayMode === 'cards' ? 'active' : ''; ?>">Tampilan Kartu</a>
            <a href="?display=table" class="<?php echo $displayMode === 'table' ? 'active' : ''; ?>">Tampilan Tabel</a>
        </div>
        
        <!-- Product display -->
        <h2>Daftar Produk</h2>
        <?php 
        if ($displayMode === 'table') {
            $petshopManager->displayProductsTable();
        } else {
            $petshopManager->displayProductsCards();
        }
        ?>
    </div>
</body>
</html>