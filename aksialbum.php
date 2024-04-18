<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$id_album = $_GET["id_album"];
$data = $_SESSION["login"];
$query = mysqli_query($conn, "SELECT * FROM album where id_album = '$id_album'");
$fetch = mysqli_fetch_array($query);
if (isset($_POST["edit"])) {
  if (editAlbum($_POST) > 0) {
    echo "<script>alert('Album berhasil di edit');
    window.location.href = 'aksialbum.php?id_album=".$id_album."';</script>";
  } else {
    echo "<script>alert('Album gagal di edit');
    window.location.href = 'aksialbum.php?id_album=".$id_album."';</script>";
  }
}
if (isset($_POST["delete"])) {
    if (deleteAlbum($_POST) > 0) {
        echo "<script>alert('Album berhasil dihapus');
        window.location.href = 'albums.php';</script>";
  
    } else {
        echo "<script>alert('Album gagal dihapus');
        window.location.href = 'aksialbum.php?id_album=".$id_album."';</script>";
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
  <link rel="stylesheet" href="css/aksialbum.css">
</head>
<body>
  <main>
        <div class="side">
      <div class="menu">
      <ul>
        <li><a href="daftarfoto.php?id_album=<?= $id_album ?>">Daftar Foto</a></li>
              <li><a href="#" style="background-color: silver; opacity: 0.6;">Setelan Album</a></li>
      </ul>
      </div>
    </div>

    <form action="" method="POST">
    <input type="hidden" name="id_album" value="<?= $id_album ?>">
        <input type="hidden" value="<?= $fetch['id_user']; ?>" name="id_user">
        <label for="nama">Nama Album: </label>
        <input type="text" value="<?= $fetch['nama']; ?>" name="nama" id="nama" required><br>
        <label for="desk">Deskripsi: </label>
        <input type="text" value="<?= $fetch['deskripsi']; ?>" name="desk" id="desk" required><br><br>
        <button type="submit" class="add" name="edit">Edit Album</button>
      </form>
    
<br>
    <form action="" method="post">
        <input type="hidden" name="id_album" value="<?= $id_album ?>">
        <button type="submit" class="add" name="delete">Hapus Album</button>
    </form>
    <br>
    <a class="add" href="albums.php">Kembali</a>

  </main>
</body>
</html>