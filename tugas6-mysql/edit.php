<?php
include("db_config.php");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    try {
        $query = $db->prepare('SELECT * FROM siswa WHERE id = ?');
        $query->bind_param('i', $id);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
    } catch (Exception $e) {
        throw $e;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <h1> Formulir Edit Data Siswa </h1>
    <form action="edit.php" method="post">
        <fieldset>
            <input type="hidden" name="id" value=<?php echo $row['id'] ?> >
            <p>
                <label for="nama">Nama: </label>
                <input type="text" name="nama" placeholder="nama lengkap" required <?php if ($row['nama']) echo "value='".$row['nama']."'" ?>/>
            </p>
            <p>
                <label for="alamat">Alamat: </label>
                <textarea name="alamat"><?php if ($row['alamat']) echo $row['alamat'] ?></textarea>
            </p>
            <p>
                <label for="jenis_kelamin">Jenis Kelamin: </label>
                <label><input type="radio" name="jenis_kelamin" value="laki-laki" required <?php if ($row['jenis_kelamin'] && $row['jenis_kelamin'] == 'laki-laki') echo "checked" ?>> Laki-laki</label>
                <label><input type="radio" name="jenis_kelamin" value="perempuan" required <?php if ($row['jenis_kelamin'] && $row['jenis_kelamin'] == 'perempuan') echo "checked" ?>> Perempuan</label>
            </p>
            <p>
                <label for="agama">Agama: </label>
                <select name="agama">
                    <?php if($row['agama']) echo "<option selected hidden>".$row['agama']."</option>" ?>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                    <option>Atheis</option>
                </select>
            </p>
            <p>
                <label for="sekolah_asal">Sekolah Asal: </label>
                <input type="text" name="sekolah_asal" placeholder="nama sekolah" required <?php if ($row['asal_sekolah']) echo "value='".$row['asal_sekolah']."'" ?> />
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST)) return;

    try {
        $query = $db->prepare('UPDATE siswa SET nama = ?, alamat = ?, jenis_kelamin = ?, agama = ?, asal_sekolah = ? WHERE id = ?');
        $query->bind_param('sssssi', $nama, $alamat, $jenis_kelamin, $agama, $sekolah_asal, $_POST['id']);
        
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
    $_SESSION["res"] = "Update Data Siswa Berhasil!";
    header('Location: index.php');
    die();
}