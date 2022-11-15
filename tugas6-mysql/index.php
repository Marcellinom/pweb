<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa baru</title>
</head>
<body>
    <h2>Pendaftaran Siswa Baru</h2>
    <h1>SMK Codeing</h1>
    <h3>Menu</h3>
    <ul>
        <li><a href="daftar.php">Daftar Baru</a></li>
        <li><a href="list.php">List Pendaftar</a></li>
    </ul>
    <hr>
    <?php 
        session_start();
        if (isset($_SESSION["res"])) {
            $res = $_SESSION["res"];
            echo $res; 
            unset($_SESSION["res"]);
        }
    ?>
</body>
</html>
<?php