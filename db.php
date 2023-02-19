<?php

namespace cafe\db;
// DBの接続
function dbconnect()
{

  $dsn = 'mysql:dbname=cafe;host=localhost;charset=utf8';
  $user = 'root';
  $pass = 'Sandar1125';

  try {
    $dbh = new \PDO($dsn, $user, $pass, [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_EMULATE_PREPARES => false,
    ]);
  } catch (\PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
  };

  return $dbh;
}
// データを正しい場所に入れる処理
function getAllContents()
{

  $dbh = dbconnect();

  $dbh->beginTransaction();

  $sql = "SELECT * FROM contacts";
  $stmt = $dbh->query($sql);

  $dbh->commit();

  return $stmt;
}
// 入力項目の定義づけ
function definition()
{

  $dbh = dbconnect();

  $stmt = $dbh->prepare("INSERT INTO contacts (id, name, kana, tel, email, body, created_at) VALUES (:id, :name, :kana, :tel, :email, :body, now())");

  $id = 0;
  $name = $_POST["name"];
  $kana = $_POST["kana"];
  $tel = $_POST["tel"];
  $email = $_POST["email"];
  $body = $_POST["body"];

  $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
  $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
  $stmt->bindParam(':kana', $kana, \PDO::PARAM_STR);
  $stmt->bindParam(':tel', $tel, \PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
  $stmt->bindParam(':body', $body, \PDO::PARAM_STR);

  $stmt->execute();

  return $stmt;
}
