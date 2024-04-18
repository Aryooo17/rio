<?php
$conn = mysqli_connect('localhost', 'root', '', 'my_db');
function login($data) {
  global
  $conn;
  $email = trim(mysqli_real_escape_string($conn, $data["email"]));
  $password = trim(mysqli_real_escape_string($conn, $data["password"]));
  $query = mysqli_query($conn, "select * from users where email = '$email'");
  $datadb = mysqli_fetch_array($query);
  if ($email === $datadb["email"] && password_verify($password, $datadb["password"])) {
    return 1;
  } else {
    return 0;
  }
}
function registrasi($data) {
  global
  $conn;
  $nama = trim(mysqli_real_escape_string($conn, $data["nama"]));
  $email = trim(mysqli_real_escape_string($conn, $data["email"]));
  $username = trim(mysqli_real_escape_string($conn, $data["username"]));
  $password = trim(mysqli_real_escape_string($conn, $data["password"]));
  $newpassword = password_hash($password, PASSWORD_DEFAULT);
  $alamat = trim(mysqli_real_escape_string($conn, $data["alamat"]));
  $query = mysqli_query($conn, "insert into users(nama,username,email,password,alamat) values('$nama','$username','$email','$newpassword','$alamat')");
  $check = mysqli_affected_rows($conn);
  return $check;
}
function tambahalbum($data) {
  global
  $conn;
  $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
  $nama = trim(mysqli_real_escape_string($conn, $data["nama"]));
  $deskripsi = trim(mysqli_real_escape_string($conn, $data["desk"]));
  $query = mysqli_query($conn, "insert into album(id_user,nama,deskripsi) values('$id_user','$nama','$deskripsi')");
  $check = mysqli_affected_rows($conn);
  return $check;
}
function tambahfoto($data) {
  global
  $conn;
  $id_album = trim(mysqli_real_escape_string($conn, $data["id_album"]));
  $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
  $judul = trim(mysqli_real_escape_string($conn, $data["judul"]));
  $deskripsi = trim(mysqli_real_escape_string($conn, $data["desk"]));
  $path = upload();
  if (!$path) {
    return false;
  }
  $query = mysqli_query($conn, "insert into foto(id_album,id_user,judul,deskripsi,path) values('$id_album','$id_user','$judul','$deskripsi','$path')");
  $check = mysqli_affected_rows($conn);
  return $check;
}
function upload() {
  global $conn;
  $namaG = $_FILES['path']['name'];
  $errorG = $_FILES['path']['error'];
  $tmpG = $_FILES['path']['tmp_name'];
  $sizeG = $_FILES['path']['size'];

  if ($errorG === 4) {
    echo "<script>alert('Kamu belum memasukkan gambar');</script>";
    return false;
  }


  $validasiG = ['img',
    'jpg',
    'jpeg',
    'png'];
  $ekstensiG = explode('.', $namaG);
  $ekstensiG = strtolower(end($ekstensiG));

  $newnamaG = uniqid();
  $newnamaG .= '.';
  $newnamaG .= $ekstensiG;

  if (!in_array($ekstensiG, $validasiG)) {
    echo "<script>alert('File yang kamu pilih bukan gambar');</script>";
    return false;
  }
  move_uploaded_file($tmpG, './upload/'.$newnamaG);
  return $newnamaG;

  if ($sizeG > 2000000) {
    echo "<script>alert('Ukuran gambar terlalu besar, maximal 2MB');</script>";
    return false;
  }
}

function like($data){
  global $conn;
  $id_foto = $data["id_foto"];
  $id_user = $data["id_user"];
  $query = mysqli_query($conn, "insert into likefoto(id_foto, id_user) values('$id_foto', '$id_user')");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function komen($data){
  global $conn;
  $id_foto = $data["id_foto"];
  $id_user = $data["id_user"];
  $isi = $data["isi_komentar"];
  $query = mysqli_query($conn, "insert into komentarfoto(id_foto, id_user, isi_komentar) values('$id_foto', '$id_user', '$isi')");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function deleteAlbum($data){
global $conn;
$id_album = $data["id_album"];
$query = mysqli_query($conn, "delete from album where id_album = '$id_album'");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function editAlbum($data) {
  global
  $conn;
  $id_album = trim(mysqli_real_escape_string($conn, $data["id_album"]));
  $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
  $nama = trim(mysqli_real_escape_string($conn, $data["nama"]));
  $deskripsi = trim(mysqli_real_escape_string($conn, $data["desk"]));
  $query = mysqli_query($conn, "update album set id_user = '$id_user', nama = '$nama', deskripsi = '$deskripsi' where id_album = '$id_album'");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function deleteFoto($data){
  global $conn;
$id_foto = $data["id_foto"];
$query = mysqli_query($conn, "delete from foto where id_foto = '$id_foto'");
  $check = mysqli_affected_rows($conn);
  return $check;
}

function editFoto($data){
  global
  $conn;
  $id_foto = trim(mysqli_real_escape_string($conn, $data["id_foto"]));
  $id_album = trim(mysqli_real_escape_string($conn, $data["id_album"]));
  $id_user = trim(mysqli_real_escape_string($conn, $data["id_user"]));
  $judul = trim(mysqli_real_escape_string($conn, $data["judul"]));
  $deskripsi = trim(mysqli_real_escape_string($conn, $data["desk"]));
  $path = upload();
  if (!$path) {
    return false;
  }
  $query = mysqli_query($conn, "update foto set id_album = '$id_album', id_user = '$id_user', judul = '$judul', deskripsi = '$deskripsi', path = '$path' where id_foto = '$id_foto'");
  $check = mysqli_affected_rows($conn);
  return $check;
}


?>