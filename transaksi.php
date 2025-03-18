<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

$dataproduk = array(
    array("sofa", "sudah termasuk dengan sofa dan meja", 3000000, "sofa.jpg"),
    array("lemari", "lemari dengan fitur keamanan jangkar dan buka kunci", 2500000, "lemari.jpg"),
    array("kasur", "sudah termasuk dengan bantal dan guling", 4500000, "kasur.jpg"),
    array("lampu hias", "sudah termasuk dengan pasang", 3500000, "lampuhias.jpg"),
);

// Ambil ID Paket dari URL
$id = isset($_GET['id']); //
$paketTerpilih = $dataproduk[$id]; // Ambil paket yang dipilih berdasarkan ID
$harga = $paketTerpilih[3];

// membuat variabel kosong untuk menampung data dari form yg dikirim
$notransaksi = "";
$namacustomer = "";
$tanggal = "";
$totalharga = 0;
$pembayaran = 0;
$kembalian = 0;
$pesan = "";

// Proses Form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notransaksi = $_POST['notransaksi'];
    $namacustomer = $_POST['namacustomer'];
    $tanggal = $_POST['tanggal'];
    // cek apakah inputan ada jika ada nilai diambil dalam bentuk int
    $pembayaran = isset($_POST['pembayaran']) ? (int) $_POST['pembayaran'] : 0;
    $harga = $paketTerpilih[2];
    $jumlah = isset($_POST['jumlah']) ? (int) $_POST['jumlah'] : 1;

    if (isset($_POST['hitung_total'])) {
        $totalharga = $harga * $jumlah;
    }

    if (isset($_POST['hitung_kembalian'])) {
        $totalharga = (int) $_POST['totalharga'];
        if ($pembayaran >= $totalharga) {
            $kembalian = $pembayaran - $totalharga; //kembalian dengan mengurangkan pembyaran dikurang total harga
        } else {
            $kembalian = 0;
            $pesan = "Pembayaran kurang!";
        }
    }

    if (isset($_POST['simpan'])) {
        echo "<script>
            alert('Transaksi Berhasil Kembali Ke Home!'); 
            window.location.href = 'beranda.php';
        </script>";
    }
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-cream {
            background-color: #f5deb3;
            border-color: #f5deb3;
            color: black;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark navbar-dark shadow">
        <div class="container-fluid">
            <div class="d-flex justify-content-between w-100">
                <div class="d-flex">
                    <a class="nav-link text-light mx-3 fs-5 py-2 px-3" href="#">Home</a>
                    <a class="nav-link text-light mx-3 fs-5 py-2 px-3" href="transaksi.php">Transaksi</a>
                </div>
                <a class="nav-link text-light mx-3 fs-5 py-2 px-3" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <h3 class="text-center">TRANSAKSI</h3>

                            <div class="mb-3">
                                <label class="form-label">Nomor Transaksi</label>
                                <input type="text" class="form-control" name="notransaksi" value="<?= htmlspecialchars($notransaksi) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($tanggal) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Customer</label>
                                <input type="text" class="form-control" name="namacustomer" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pilih Produk</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($paketTerpilih[0]) ?>" name="paket" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga Produk</label>
                                <input type="text" class="form-control" name="harga" id="harga" value="<?= $dataproduk[$id][2] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah Produk</label>
                                <input type="number" class="form-control" name="jumlah" value="<?= htmlspecialchars($jumlah) ?>" min="1" required>
                            </div>

                            <button type="submit" class="btn btn-cream" name="hitung_total">Hitung Total Harga</button>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" name="totalharga" value="<?= $totalharga ?>" readonly>
                            </div>

                            <input type="hidden" name="totalharga" value="<?= $totalharga ?>">

                            <div class="mb-3">
                                <label class="form-label">Pembayaran</label>
                                <input type="text" class="form-control" name="pembayaran" value="<?= $pembayaran ?>">
                            </div>

                            <button type="submit" class="btn btn-cream" name="hitung_kembalian">Hitung Kembalian</button>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Kembalian</label>
                                <input type="text" class="form-control" name="kembalian" value="<?= $kembalian ?>" readonly>
                            </div>

                            <button type="submit" class="btn btn-cream" name="simpan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<!-- 

buat 2 akun login dan nama customer harus terisi otomatis diambil dari username login 
dan dapat melakukan logout,
serta mengakses website harus melalui login tidak dapat masuk ke halam beranda lewat url

 -->