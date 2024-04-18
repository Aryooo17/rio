<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "select * from album where id_user = '$getdata'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GALLERY ARYO</title>
  <link rel="stylesheet" href="css/albums.css">
</head>
<body>
  <main>
    <header>
    <div class="menu">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#" style="background-color: silver; opacity: 0.6;">Daftar Albumku</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      </div>
    </header>
    <h2>Album saya:</h2>
    <div class="posts">
      <?php if (mysqli_num_rows($query)) : ?>
      <?php foreach ($query as $data) :?>
        <div class="post">
      <a href="daftarfoto.php?id_album=<?= $data["id_album"]; ?>"><img src="
      <?php if(mysqli_num_rows(mysqli_query($conn, 'select * from foto'))){
        echo "upload/".mysqli_fetch_array(mysqli_query($conn, 'select * from foto'))['path'];
      }else{
        echo "img/default.jpg";
      } ?>
      " width="100%" height="100%">
      <center>
      <h3 class="judul"><?= $data["nama"]; ?></h3>
</center>
      </a>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <h2>Tidak ada album yang dibuat</h2>
      <?php endif; ?>
    </div>
    <a class="add" href="tambahalbum.php">Tambah Album</a>
  </main>
</body>
</html>