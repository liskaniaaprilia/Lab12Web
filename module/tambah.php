<?php
error_reporting(E_ALL);
require_once '../../class/database.php';
include_once '../../class/form.php';

$db = new Database("localhost", "root", "", "latihan-1");

if (isset($_POST['submit'])) {
    $nama = $db->escapeString($_POST['nama']);
    $kategori = $db->escapeString($_POST['kategori']);
    $harga_jual = $db->escapeString($_POST['harga_jual']);
    $harga_beli = $db->escapeString($_POST['harga_beli']);
    $stok = $db->escapeString($_POST['stok']);
    $file_gambar = $_FILES['file_gambar'];
    
    $gambarTampilan = str_replace('gambar/', '', $file_gambar['name']);
    $gambar = null;

    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;

        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) ";
    $sql .= "VALUES ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";

    $result = $db->query($sql);

    if (!$result) {
        echo "Error: " . $db->getError();
    } else {
        header('location: index.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
    <div class="title-container">
            <h1 style="color: #FFFFFF;">Tambah Barang</h1>
        </div>
        <div class="main">
            <form method="post" action="tambah.php" enctype="multipart/form-data">
                <div class="input">
                    <label> Nama Barang</label>
                    <input type="text" name="nama"/>
                </div>
                <div class="input">
                    <label>Kategori</label>
                    <select name="kategori">
                        <option value="Komputer">Komputer</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="HandPhone">HandPhone</option>
                    </select>
                </div>
                <div class="input">
                    <label>Harga Jual</label>
                    <input type="text" name="harga_jual" />
                </div>
                <div class="input">
                    <label>Harga Beli</label>
                    <input type="text" name="harga_beli" />
                </div>
                <div class="input">
                    <label>Stok</label>
                    <input type="text" name="stok" />
                </div>
                <div class="input">
                    <label>File Gambar</label>
                    <input type="file" name="file_gambar" />
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>