<?php
session_start(); // Memulai sesi PHP untuk menyimpan data sesi pengguna

// Membuat username dan password default
$user1 = "userlsp"; // Username pertama
$user2 = "rpl";     // Username kedua
$pw1 = "smkisfibjm"; // Password untuk user pertama
$pw2 = "123";        // Password untuk user kedua

// Memeriksa apakah metode request adalah POST (form dikirim)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"]; // Mengambil input username dari form
    $password = $_POST["password"]; // Mengambil input password dari form

    // Memeriksa apakah username dan password cocok dengan user pertama
    if ($username == $user1 && $password == $pw1) {
        $_SESSION['name'] = $user1; // Menyimpan username dalam sesi
        header("Location: beranda.php"); // Redirect ke halaman beranda
        exit(); // Menghentikan eksekusi skrip setelah redirect
    }
    // Memeriksa apakah username dan password cocok dengan user kedua
    elseif ($username == $user2 && $password == $pw2) {
        $_SESSION['name'] = $user2; // Menyimpan username dalam sesi
        header("Location: beranda.php"); // Redirect ke halaman beranda
        exit(); // Menghentikan eksekusi skrip setelah redirect
    }
    // Jika username dan password tidak cocok dengan yang terdaftar
    else {
        $errorMsg = "Invalid username or password"; // Menyimpan pesan error
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: url('img/login.jpeg') no-repeat center center;
            background-size: cover;
            margin-bottom: 10px;
        }

        .welcome-text {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-container {
            width: 300px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }

        form {
            width: 80%;
            margin: 0 auto;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 6px;
            font-size: 14px;
        }

        button {
            width: 40%;
            padding: 6px;
            font-size: 14px;
        }


        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            display: block;
            margin: 10px auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            color: black;
        }

        button {
            width: 50%;
            display: block;
            margin: 10px 0 0 auto;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            color: black;
            cursor: pointer;
            text-align: center;
        }

        button:hover {
            opacity: 0.8;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="logo"></div>
    <div class="welcome-text">Selamat Datang di furniture</div>
    <div class="login-container">
        <form method="POST" action="">
            <!-- input untuk memasukkan user -->
            <input type="text" name="username" placeholder="Username" required>
            <!-- input untuk pass -->
            <input type="password" name="password" placeholder="Password" required>
            <!-- button untuk mengirim user dan pass yg telah diisi diatas -->
            <button type="submit">Login</button>
        </form>
        <!-- Menampilkan peringatan jika username atau password salah -->
        <?php
        if (isset($errorMsg)) { // Memeriksa apakah $errorMsg ada 
            echo "<p class='error'>$errorMsg</p>"; // jika ada maka tampil $errorMsg
        }
        ?>

    </div>
</body>

</html>