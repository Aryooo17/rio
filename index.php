<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "select * from foto inner join users on foto.id_user = users.id_user");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GALLERY ARYO</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <main>
    <header>
    <div class="menu">
      <ul>
        <li><a href="#" style="background-color: silver; opacity: 0.6;">Home</a></li>
        <li><a href="albums.php">Daftar Albumku</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      </div>
    </header>
    <h2>Foto orang lain:</h2>
    <div class="posts">
    <?php if (mysqli_num_rows($query)) : ?>
      <?php foreach ($query as $data) :?>
       <div class="post">
      <a href="tampil.php?id=<?= $data['id_user']; ?>"><img src="upload/<?= $data['path']; ?>" width="100%" height="100%">
      <center>
            <h4 class="author">Dari: <?= $data["nama"]; ?></</h4>
      <h3 class="judul"><?= $data["judul"]; ?></</h3>
</center>
      </a>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <h2>Tidak ada semua foto</h2>
      <?php endif; ?>

    </div>
  </main>
</body>
</html>