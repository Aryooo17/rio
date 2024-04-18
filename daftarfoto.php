<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$id_album = $_GET["id_album"];
$data = $_SESSION["login"];
$query = mysqli_query($conn, "SELECT * FROM foto where id_album = '$id_album'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GALLERY ARYO</title>
  <link rel="stylesheet" href="css/daftarfoto.css">
</head>
<body>
  <main>
        <div class="side">
      <div class="menu">
      <ul>
        <li><a href="#" style="background-color: silver; opacity: 0.6;">Daftar Foto</a></li>
              <li><a href="aksialbum.php?id_album=<?= $id_album ?>">Setelan Album</a></li>
      </ul>
      </div>
    </div>
    <div class="posts">
      <?php if (mysqli_num_rows($query)) : ?>
      <?php foreach ($query as $data) :?>
        <div class="post">
      <a href="aksifoto.php?id_foto=<?= $data['id_foto']; ?>"><img src="upload/<?= $data['path']; ?>" width="100%" height="100%">
      <center>
      <h3 class="judul"><?= $data["judul"]; ?></h3>
</center>
      </a>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <h2>Tidak ada foto yang dibuat di album ini</h2>
      <?php endif; ?>
    </div>
          <a class="add" href="tambahfoto.php?id_album=<?= $id_album; ?>" class="tambah">Tambah Foto</a>
          <a class="add" href="albums.php">Kembali</a>

  </main>
</body>
</html>