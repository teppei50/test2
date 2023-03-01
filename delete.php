<?php
session_start();
require_once('db.php');
use cafe\db;


$id = $_GET['id'];


$dbh = db\dbconnect();


$dbh->beginTransaction();


$sql = "DELETE FROM contacts WHERE id = :id";


$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);


$stmt->execute();


$dbh->commit();


header('location:contact.php');
exit;


$dbh = null;
