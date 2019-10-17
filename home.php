<?php

require_once('Classes/Database.php');
require_once('Classes/View.php');
require_once('Classes/Valida.php');

$PDO = new Database;

$listar = $_POST['lista'];

if($listar == 'Listar'){
    $View = new View;
    
    $stmt = $PDO->getAll('Clientes', '*');
    $values = $PDO->getResult($stmt);
    $num = $PDO->dbCheck($stmt);
    
    $files = $View->render('item','lista');
    $html = $View->replace($files, $values, $num);
    print_r($html);
}else {
    
    $Nome = $_POST['name'];
    $Email = $_POST['email'];
    $Telefone = $_POST['tell'];
    $Endereco = $_POST['endereco'];
    $Data_Nasc = $_POST['date'];

    $Valida = new Valida($Nome, $Email, $Telefone, $Endereco, $Data_Nasc);
    $Valida->Validar();

    $bool = $PDO->dbInsert('Clientes', 'id, nome, email, telefone, endereco, data_nasc', "NULL,'$Nome', '$Email', '$Telefone', '$Endereco', '$Data_Nasc'");

    if($bool) {
       //echo 'Cadastrado Com Sucesso!';
      header("Location: ../sucesso.html");
    }else {
      echo 'ERROR';
    }

}




