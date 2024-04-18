<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$getdata = $_SESSION["login"];
$id_foto = $_GET["id_foto"];
$query = mysqli_query($conn, "select * from foto where id_foto = '$id_foto'");
$fetch = mysqli_fetch_array($query);
if (isset($_POST["edit"])) {
  if (editFoto($_POST) > 0) {
    echo "<script>alert('Foto berhasil di edit');
    window.location.href = 'albums.php';</script>";
  }
}
if (isset($_POST["delete"])) {
    if (deleteFoto($_POST) > 0) {
      echo "<script>alert('Foto berhasil di Hapus');
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
  <link rel="stylesheet" href="css/aksifoto.css">
</head>
<body>
  <main>
  <div class="tambahfoto">
      <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_foto" value="<?= $id_foto ?>">
        <input type="hidden" value="<?= $fetch["id_album"]; ?>" name="id_album">
        <input type="hidden" value="<?= $getdata; ?>" name="id_user">
        <label for="judul">Judul Foto: </label>
        <input type="text" value="<?= $fetch["judul"]; ?>" name="judul" id="judul" required><br>
        <label for="desk">Deskripsi: </label>
        <input type="text" value="<?= $fetch["deskripsi"]; ?>" name="desk" id="desk" required><br>
        <label for="path">Gambar: </label>
        <input type="file" name="path" id="path"><br>
        <button class="add" type="submit" name="edit">Edit Foto</button>
      </form>
    </div>
    <br>
    <form action="" method="post">
        <input type="hidden" name="id_foto" value="<?= $id_foto ?>">
        <button type="submit" class="add" name="delete">Hapus Album</button>
    </form>
    <br>
  </main>
</body>
</html>