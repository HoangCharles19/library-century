<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';
$dbname = 'library-century';

// Try cach pour afficher l'erreur de connexion sans couper le script
try {
      $db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
      // echo 'Connexion réussie';
} catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
}

$sth = $db->query('SELECT * FROM editors');

// var_dump($sth);
