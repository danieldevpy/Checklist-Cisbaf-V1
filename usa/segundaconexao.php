<?php
//conexão com o servidor

$con = mysqli_connect("localhost", "root", "", "meubanco");

// Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
if (mysqli_connect_errno()) {
    echo "<h1>Falha na conexão com o Banco de Dados!</h1>" . mysqli_connect_error();
    exit;
}
