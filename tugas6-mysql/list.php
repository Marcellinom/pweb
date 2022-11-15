<?php
include("db_config.php");
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    try {
        $query = $db->prepare('DELETE FROM siswa WHERE id = ?');
        $query->bind_param('i', $id);
        $query->execute();
    } catch (PDOException $e) {
        die("Gagal terhubung dengan database: " . $e->getMessage());
    } catch (Exception $e) {
        die(e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pendaftar</title>
    <script>
        function handle(id) {
            document.getElementById('form-value').value = id;
            document.getElementById("del-form").submit();
        }
    </script>
    <style>
        .container {
            display: flex;
            flex-direction: row;
        }
        .item {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Siswa yang Sudah Mendaftar</h2>
    <a href="daftar.php">[+] Tambah Baru</a>
    <br>
    <table border="1">
    <tr> 
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Sekolah Asal</th>
        <th>Aksi</th>
    </tr>
    <form id='del-form' action='list.php' method='post'><input id="form-value" name="id" type="hidden" value=""></form>
    <?php
        include("db_config.php");
        $query = $db->prepare('SELECT * FROM siswa');
        $query->execute();
        $result = $query->get_result();
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$no++."</td>";
            echo "<td>".$row['nama']."</td>";
            echo "<td>".$row['alamat']."</td>";
            echo "<td>".$row['jenis_kelamin']."</td>";
            echo "<td>".$row['agama']."</td>";
            echo "<td>".$row['asal_sekolah']."</td>";
            echo "<td class='container'><div class='item'><span><a href='edit.php?id=".$row['id']."'>Edit</a> </span></div> &nbsp; | &nbsp;<div class='item'><a id='sub' href='#' onclick='handle(".$row['id'].")'>Hapus</a></div></td>";
            echo "</tr>";
        }
    ?>
    </table>
    <hr>
    <h4><a href="index.php"><= Beranda</a></h4>
</body>
</html>