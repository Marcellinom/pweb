<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
</head>
<body>
    <h1> Formulir Pendaftaran Siswa Baru </h1>
    <form action="daftar.php" method="post">
        <fieldset>
            <p>
                <label for="nama">Nama: </label>
                <input type="text" name="nama" placeholder="nama lengkap" required />
            </p>
            <p>
                <label for="alamat">Alamat: </label>
                <textarea name="alamat"></textarea>
            </p>
            <p>
                <label for="jenis_kelamin">Jenis Kelamin: </label>
                <label><input type="radio" name="jenis_kelamin" value="laki-laki" required> Laki-laki</label>
                <label><input type="radio" name="jenis_kelamin" value="perempuan" required> Perempuan</label>
            </p>
            <p>
                <label for="agama">Agama: </label>
                <select name="agama">
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                    <option>Atheis</option>
                </select>
            </p>
            <p>
                <label for="sekolah_asal">Sekolah Asal: </label>
                <input type="text" name="sekolah_asal" placeholder="nama sekolah" required />
            </p>
            <p>
                <input type="submit" value="Daftar" name="daftar" />
            </p>
        </fieldset>
    </form>
    <hr>
    <h4><a href="index.php"><= Beranda</a></h4>
</body>
</html>
<?php
include("db_config.php");
$keys = ['nama', 'alamat', 'jenis_kelamin', 'agama', 'sekolah_asal'];
if (empty($_POST)) return;
if (count(array_intersect_key(array_flip($keys), $_POST)) !== count($keys)) return;

try {
    $query = $db->prepare('INSERT INTO siswa (nama, alamat, jenis_kelamin, agama, asal_sekolah) VALUES (?, ?, ?, ?, ?)');
    $query->bind_param('sssss', $nama, $alamat, $jenis_kelamin, $agama, $sekolah_asal);
    
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah_asal = $_POST['sekolah_asal'];

    $query->execute();
} catch (PDOException $e) {
    die("Gagal terhubung dengan database: " . $e->getMessage());
} catch (Exception $e) {
    die(e->getMessage());
}
session_start();
$_SESSION["res"] = "Pendaftaran Siswa Baru Berhasil!";
header('Location: index.php');
die();