<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$id = $_GET["id"];
$getdata = $_SESSION["login"];
$query = mysqli_query($conn, "SELECT * FROM foto where id_user = '$id'");
$data = mysqli_fetch_array($query);
$id_foto = $data["id_foto"];
$count = mysqli_query($conn, "SELECT COUNT(*) AS count FROM likefoto where id_foto = '$id_foto'");
$like = mysqli_fetch_array($count);
if (isset($_POST["like"])) {
  if (like($_POST) > 0) {
    header("Location: tampil.php?id=".$data["id_user"]);
  }
}
if (isset($_POST["komentar"])) {
  if (komen($_POST) > 0) {
    header("Location: tampil.php?id=".$data["id_user"]);
  }
}
$komentar = mysqli_query($conn, "select * from komentarfoto inner join users on komentarfoto.id_user = users.id_user where id_foto = '$id_foto'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GALLERY ARYO</title>
<body>
  <main>
    <img src="upload/<?= $data["path"]; ?>" alt="" width="500" height="300"><br>
    <h2><?= $data["judul"]; ?></h2>
    <p><?= $data["deskripsi"]; ?></p>


    <br><br><br><br>

    <form action="" method="post">
      <input type="hidden" name="id_foto" value="<?= $data["id_foto"]; ?>">
      <input type="hidden" name="id_user" value="<?= $data["id_user"]; ?>">
      <button type="submit" name="like">Like (<?= $like["count"]; ?>)</button>
    </form>
    
    <h3>Komentar:</h3>
    <form action="" method="post">
      <input type="hidden" name="id_foto" value="<?= $data["id_foto"]; ?>">
      <input type="hidden" name="id_user" value="<?= $data["id_user"]; ?>">
      <textarea name="isi_komentar" rows="4" cols="50" placeholder="Ketik komentar">
    </textarea>
    <br>
    <button type="submit" name="komentar">Kirim komentar</button>
    </form>
    <br><br>
    <?php if(mysqli_num_rows($komentar)){
       foreach($komentar as $komen){
        echo "<h4>Dari: ".$komen['nama']."</h4>".
        "<p>".$komen['isi_komentar']."</p>"
        ;
       }
    }else{
      echo "<h4>Belum ada komentar</h4>";
    } ?>
    <br><br>
    <a style="display: inline-block;
  padding: 20px;
  background-color: rgba(4, 47, 167, 0.5);
color: white;
  margin-left: 100px;" href="index.php">Kembali</a>
  </main>
</body>
</html>