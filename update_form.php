<?php
include 'dataBase_connect.php';
include 'Editors.php';


$Editor = new Editors();
$errors = $Editor->update($_GET['id']);
$result = $Editor->readOne($_GET['id']);

print_r($result);
?>

<h1>
      Update editor:
</h1>

<form action="" method="POST">
      <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?= $result['name'] ?>">
            <?= $errors['name']; ?>

      </div>
      <br>
      <button type="submit">Submit</button>
</form>