<?php
include 'Editors.php';



$Editor = new Editors();
$Editor->delete($_GET["id"]);
