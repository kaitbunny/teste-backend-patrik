<?php

ini_set('disply_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

define('BANCO', 'teste_alphacode');
define('HOST', 'localhost');
define('USER', 'root');
define('SENHA', '');

define('DS', DIRECTORY_SEPARATOR);
define('DIR_APP', __DIR__);
define('DIR_PROJETO', 'api_alphacode');

if (file_exists('autoload.php')) {
  include 'autoload.php';
} else {
  echo 'ERRO AO INCLUIR BOOTSTRAP';
  exit;
}
