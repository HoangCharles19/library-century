<?php
const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_NAME_TOO_SHORT = "Le nom de l'éditeur est trop court";

class Editors
{
      protected $db = '';
      protected $errors = [
            'name' => ''
      ];

      function __construct()
      {
            include 'dataBase_connect.php';
            $this->db = $db;
      }
      function create()
      {
      }
      function filter()
      {

            $editors = [];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                  $data = filter_input_array(INPUT_POST, ['name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS]);
                  $name = ($data['name']) ?? '';
                  if (!$name) {
                        $this->errors['name'] = ERROR_REQUIRED;
                  } elseif (mb_strlen($name) < 5) {
                        $this->errors['name'] = ERROR_NAME_TOO_SHORT;
                  }
                  if (empty(array_filter($this->errors, fn ($e) => $e !== ''))) {
                        $editors =  ['name' => $name];
                  }
            }
            return $editors;
      }
      function update($id)
      {
            $editors = $this->filter();
            if (!empty($editors)) {
                  // on écrit la requete sur
                  $sql = "UPDATE `editors` SET `name` = :name WHERE `id` = $id";
                  // on prépare la requête
                  $query = $this->db->prepare($sql);

                  // on injecte les valeurs
                  $query->bindValue(':name', $editors['name'], PDO::PARAM_STR);

                  // on execute la requête
                  if (!$query->execute()) {
                        die("Error executing");
                  }

                  echo ("Editor modifié $id");
            }
            return $this->errors;
      }
      function readOne($id)
      {
            // on écrit la requete
            $sql = "SELECT * FROM `editors` WHERE `id` =  $id";
            // on prépare la requête
            $query = $this->db->prepare($sql);
            // on execute la requête
            $query->execute();
            // on stock le résultat dans un tableau associatif
            return $query->fetch(PDO::FETCH_ASSOC);

            // print_r($result);
      }
      function delete($id)
      {
            // on écrit la requete
            $sql = "DELETE FROM `editors` WHERE `id` = $id";
            // on prépare la requête
            $query = $this->db->prepare($sql);
            // on execute la requête
            $query->execute();

            header("Location: /index.php");
      }
      function read()
      {
            // on écrit la requete
            $sql = "SELECT * FROM `editors`";
            // on prépare la requête
            $query = $this->db->prepare($sql);
            // on execute la requête
            $query->execute();
            // on stock le résultat dans un tableau associatif
            return  $query->fetchAll(PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($results);
            // echo "</pre>";
      }
}
