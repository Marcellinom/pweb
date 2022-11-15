<?php
$db = mysqli_connect(getenv('SERVER'), getenv('USERNAME'), getenv('PASSWORD'), getenv('TABLE_TUGAS_6_MARSEL'));
if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}