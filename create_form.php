<?php
include 'dataBase_connect.php';

// instantiation des constantes d'erreurs
const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_NAME_TOO_SHORT = "Le nom de l'éditeur est trop court";

$errors = [
      'name' => ''
];
$editors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, ['name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS]);
      $name = ($_POST['name']) ?? '';
      if (!$name) {
            $errors['name'] = ERROR_REQUIRED;
      } elseif (mb_strlen($name) < 5) {
            $errors['name'] = ERROR_NAME_TOO_SHORT;
      }
      if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
            $editors =  ['name' => $name];
      }
      // print_r($editors);
      // print_r($errors);
      // print_r($name);
      // print_r($_POST);
      if (!empty($editors)) {

            // on écrit la requete sur
            $sql = "INSERT INTO `editors` (`name`) VALUES (:name)";
            // on prépare la requête
            $query = $db->prepare($sql);

            // on injecte les valeurs
            $query->bindValue(':name', $editors['name'], PDO::PARAM_STR);

            // on execute la requête
            if (!$query->execute()) {
                  die("Error executing");
            }

            // on récupère l'ID de l'article
            $id = $db->lastInsertId();

            echo ("Editor ajouté sous le numéro $id");
      }
}
?>

<h1>
      Create editor:
</h1>
<a href="/index.php">Retour</a>
<form action="" method="POST">
      <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            <?= $errors['name']; ?>

      </div>
      <br>
      <button type="submit">Submit</button>
</form>