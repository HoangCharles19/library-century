<?php
include 'dataBase_connect.php';
include 'Editors.php';

$Editor = new Editors();
$results = $Editor->read();


?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
</head>

<body>
      <a href="/create_form.php">Create</a>
      <table>
            <thead>

                  <tr>
                        <td>id</td>
                        <td>name</td>
                        <td>action</td>
                  </tr>
            </thead>
            <tbody>
                  <?php foreach ($results as $result) : ?>

                        <tr>
                              <td><?= $result['id'] ?></td>
                              <td><?= $result['name'] ?></td>

                              <td>
                                    <a href="/update_form.php?id=<?= $result['id'] ?>">Update</a>
                                    <a href="/delete_form.php?id=<?= $result['id'] ?>">Delete</a>
                              </td>

                        </tr>
                  <?php endforeach; ?>
            </tbody>
      </table>

</body>

</html>