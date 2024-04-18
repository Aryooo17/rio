<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "select * from album where id_user = '$getdata'");
$id_album = $_GET["id_album"];
if (isset($_POST["submit"])) {
  if (tambahfoto($_POST) > 0) {
    echo "<script>alert('Foto berhasil ditambahkan');
    window.location.href = 'daftarfoto.php?id_album=".$id_album."';</script>";
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
      <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="<?= $id_album; ?>" name="id_album">
        <input type="hidden" value="<?= $getdata; ?>" name="id_user">
        <label for="judul">Judul Foto: </label>
        <input type="text" value="" name="judul" id="judul" required><br>
        <label for="desk">Deskripsi: </label>
        <input type="text" value="" name="desk" id="desk" required><br>
        <label for="path">Gambar: </label>
        <input type="file" value="" name="path" id="path"><br>
        <button type="submit" name="submit">Tambahkan</button>
      </form>
    </div>
  </main>
</body>
</html>