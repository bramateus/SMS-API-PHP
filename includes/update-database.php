<?php
require_once "config.php";


$msg = $_POST['value'];
$update_query = "UPDATE dados SET mensagem_dados = '" .$msg. "'";
$result = mysqli_query($sqlconex,$update_query);




