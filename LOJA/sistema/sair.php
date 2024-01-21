<?
session_destroy();
$login = $_SESSION['login'];
$nome = $_SESSION['nome'];
$cpf = $_SESSION['cpf'];
$senha = $_SESSION['senha'];

echo "<script language='javascript'>window.location='../';</script>";
?>