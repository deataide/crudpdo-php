<?php

//TEST

$pdo = new PDO('mysql:host=localhost;dbname=crud','root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

if(@$_GET['delete']){
  $id = (int)$_GET['delete'];
  $pdo->exec("DELETE FROM users WHERE id=$id");
  echo 'Deletado com sucesso'.$id;
}
if(@$_POST['name']){
  $sql = $pdo->prepare("INSERT INTO users VALUES(null, ?, ?, ?)");
  $sql->execute(array($_POST['name'],$_POST['email'],$_POST['password']));
  echo 'Inserido';
}
?>

<form method="POST">
  <input type="text" name='name' placeholder="nome">
  <input type="email" name="email" placeholder="email">
  <input type="password" name="password" placeholder="password">
  <input type="submit" value="Enviar">
</form>

<?php
$sql = $pdo->prepare("SELECT * FROM users");
$sql->execute();

$fetch = $sql->fetchAll();

foreach ($fetch as $key => $value) {
  echo '<a href="?delete='.$value['id'].'">(X)</a>'.$value['name'].'</a>';
  echo '<hr>';
}
?>




