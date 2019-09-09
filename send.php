<?php
require 'includes/config.php';
require 'includes/locasms.php';
use LocaSMS\LocaSMS;

// $locasms = new LocaSMS("seu_login", "sua_senha");
$locasms = new LocaSMS("31973033012", "7244780");


// print_r($locasms);
// Chame o método enviarSMS para gerar o envio: OBS: Pode se passar vários números de telefones separados por vírgula
// $locasms->enviarSMS("mensagem", "numero(s)");
// $locasms->enviarSMS("mensagem-teste-ola", "31973033012",'');



$sqlMSG = "SELECT `cliente`.*, dados.mensagem_dados FROM `cliente` INNER JOIN `dados` ON `dados`.`cliente_id` = `cliente`.`status` GROUP BY 'id'";
$result = mysqli_query($sqlconex, $sqlMSG);
$sqlMSG = $result->fetch_row();
$msg = $sqlMSG[8];

// $sqlMSG = $query->fetchAll();
// $msg = utf8_decode($sqlMSG[0]['mensagem_dados']);

				
// Enviar call-back para a geração do SMS: 
// $locasms->enviarSMS("mensagem", "numero(s)", "url_callback");

// Chame o método statusCampanha para consultar uma campanha:
// $locasms->statusCampanha("id_da_campanha");

// Chame o método consultaSaldo para consultar o saldo da sua conta:
// $locasms->consultaSaldo();
// print_r($msg);


$locasms->enviarSMS('$msg', $_POST['string'],'');
// $locasms->enviarSMS("Olá $fname TESTE API3 ", $_POST['string'],'');
// $locasms->enviarSMS("Olá $fname TESTE AP4I ", $_POST['string'],'');
// $locasms->enviarSMS("Olá $fname$ TESTE API ", $_POST['string'],'');