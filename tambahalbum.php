<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$getdata = $_SESSION["login"];
if (isset($_POST["submit"])) {
  if (tambahalbum($_POST) > 0) {
    echo "<script>alert('Album berhasil ditambahkan');
    window.location.href = 'albums.php';</script>";
    
  } else {
    echo "<script>alert('Album gagal ditambahkan');
    window.location.href = 'albums.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GALLERY ARYO</title>
</head>
<body>
  <main>
    <div class="tambahfoto">
      <form action="" method="POST">
        <input type="hidden" value="<?= $getdata; ?>" name="id_user">
        <label for="nama">Nama Album: </label>
        <input type="text" value="" name="nama" id="nama" required><br>
        <label for="desk">Deskripsi: </label>
        <input type="text" value="" name="desk" id="desk" required><br>
        <button type="submit" name="submit">Tambahkan</button>
      </form>
    </div>
  </main>
</body>
</html>