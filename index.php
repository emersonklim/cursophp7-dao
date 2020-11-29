<?php

require_once ("config.php");

$sql = new Sql();

$usuarios = $sql->select("select * from login");

echo json_encode($usuarios);

