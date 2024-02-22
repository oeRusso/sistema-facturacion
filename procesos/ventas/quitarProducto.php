<?php

session_start();
$index = $_POST['ind'];
unset($_SESSION['tablasComprasTemp'][$index]);
$datos = array_values($_SESSION['tablasComprasTemp']);
unset($_SESSION['tablasComprasTemp']);
$_SESSION['tablasComprasTemp']=$datos;
