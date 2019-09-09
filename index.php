<?php

// OPTIONS remove a duplicidade de valores da consulta ('índice e nome');
$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
$pdo = new PDO('mysql:host=localhost;dbname=lps_ccc', 'root', '', $options);


$sqlTotalClientes = 'SELECT COUNT(*) as total FROM cliente';
			$query = $pdo->prepare($sqlTotalClientes);
			$query->execute();
			$totalClientes = $query->fetchAll();

$sqlTotalNaoEnviados = 'SELECT COUNT(*) as naoEnviados FROM cliente WHERE status = 0';
			$query = $pdo->prepare($sqlTotalNaoEnviados);
			$query->execute();
			$totalNaoEnvaidos = $query->fetchAll();

$sqlTotalEnviados = 'SELECT COUNT(*) as Enviados FROM cliente WHERE status = 1';
			$query = $pdo->prepare($sqlTotalEnviados);
			$query->execute();
			$totalEnvaidos = $query->fetchAll();




$sqlClientes = 'SELECT * FROM cliente WHERE status = 0';
			$stm2 = $pdo->prepare($sqlClientes);
			$stm2->execute();
			$dados = $stm2->fetchAll();

				// print_r('<pre>');
				// print_r($dados);
				// print_r('</pre>');

$sqlCel = 'SELECT celular FROM cliente WHERE status = 0';

	$stm3 = $pdo->prepare($sqlCel);
	$stm3->execute();
	$cel = $stm3->fetchAll();
	// print_r('<pre>');
	// print_r($cel);
	// print_r('</pre>');
	// string de saída
	$stringStatus0 = "";

	foreach($cel as $valor){
	    // adiciona o valor
	    $stringStatus0 .= $valor['celular'].",";
	}

	// retira a ultima vírgula e o espaço
	$stringStatus0 = substr($stringStatus0, 0, -1);

	// mostra o resultado
	// echo $string;

	$sqlCel1 = 'SELECT celular FROM cliente WHERE status = 1';
		$query = $pdo->prepare($sqlCel1);
		$query->execute();
		$cel1 = $query->fetchAll();

		// string de saída
		$stringStatus1 = "";

		foreach($cel1 as $valor){
		    // adiciona o valor
		    $stringStatus1 .= $valor['celular'].",";
		}

		// retira a ultima vírgula e o espaço
		$stringStatus1 = substr($stringStatus1, 0, -1);


	// $teste = array($string);
		// $array = array($string);
		// var_dump($array);

	


	// $locasms->enviarSMS("TESTE API", $string,'');
	   // $locasms->statusCampanha(141477772);
	// print_r($teste);
?>


<!DOCTYPE html>
<html>
<head>
	<title>SMS</title>
</head>
<body>


<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<!-- <h3>Status 0 = <?php echo $string ?></h3> -->



<!-- <form action="" method="POST" id="form">
	<input type="hidden" name="string" value="<?php echo($string) ?>">
	<button type="submit" id="btn">ENVIAR</button>
</form> -->

<!-- <a href="http://localhost/www/SMS/update.php">Atualizar Planilha</a> -->





<section>
	<header>
	
	</header>
</section>
<aside>
	
</aside>
<main>
	<section>
		<div class="rad-body-wrapper rad-nav-min">
			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-4 col-xs-4">
						<div class="rad-info-box rad-txt-success">
							<i class="fa fa-share-square-o"></i>
							<span class="heading">Na FILA</span>
							<span class="value"><span><?php print_r($totalNaoEnvaidos[0]['naoEnviados']); ?></span></span>
						</div>
					</div>
					<div class="col-lg-4 col-xs-4">
						<div class="rad-info-box rad-txt-primary">
							<i class="fa fa-paper-plane"></i>
							<span class="heading">Enviados</span>
							<span class="value"><span><?php print_r($totalEnvaidos[0]['Enviados']) ?></span></span>
						</div>
					</div>
					<!-- <div class="col-lg-3 col-xs-6">
						<div class="rad-info-box rad-txt-danger">
							<i class="fa fa-google-plus"></i>
							<span class="heading">Google</span>
							<span class="value"><span>49M</span></span>
						</div>
					</div> -->
					<div class="col-lg-4 col-xs-4">
						<div class="rad-info-box">
							<i class="fa fa-users"></i>
							<span class="heading">Total de Clientes</span>
							<span class="value"><span><?php print_r ($totalClientes[0]['total']); ?></span></span>
						</div>
					</div>
					<div class="col-lg-12">
						<div style="text-align: right; margin: 10px 0 20px 0">
							<a href="http://localhost/www/SMS/update.php" style="background-color: #e94b3b; padding: 10px 10px; border: 0; color: #fff; font-size: 22px; font-weight: bold;">Atualizar Planilha</a>
						</div>
					</div>
				</div>


				<?php
				$sqlMSG = "SELECT `cliente`.*, dados.mensagem_dados FROM `cliente` INNER JOIN `dados` ON `dados`.`cliente_id` = `cliente`.`send_msg` GROUP BY 'id'";
				$query = $pdo->prepare($sqlMSG);
				$query->execute();
				$sqlMSG = $query->fetchAll();
				$msg = utf8_decode($sqlMSG[0]['mensagem_dados']);

				?>

				
				<div class="row">
					<div class="col-xs-6">
						<div class="panel panel-default">

							<div class="panel-heading">
								<h3 class="panel-title">Numeros com status 0

								</h3>
							</div>
							<div class="panel-body rad-map-container">
								<div id="world-map" class="rad-map" style="width: 50%">
									<?php echo "$stringStatus0"; ?>
								</div>
							</div>
						</div>

						<form action="" method="POST" id="form">
							<input type="hidden" name="string" value="<?php echo($stringStatus0) ?>">
							<button type="submit" id="btn" style="background-color: #23ae89; padding: 20px 75px; border: 0; color: #fff; font-size: 22px; font-weight: bold">ENVIAR</button>
						</form>



					</div>



					<div class="col-xs-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Numeros com status 1

								</h3>
							</div>
							<div class="panel-body rad-map-container">
								<div id="world-map" class="rad-map" style="width: 50%">
									<?php echo "$stringStatus1"; ?>
								</div>
							</div>
						</div>
					</div>
				</div>




				<div class="row">
					<div class="col-md-6 col-lg-4" style="float: right; margin-top: -65px">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="rad-chat-body">
									<div class="rad-list-group">
										<div class="rad-list-group-item left">
											<div class="rad-list-content rad-chat">
												<span class="lg-text">+011 987654321</span>
										
												<div class="rad-chat-msg" id="chat-msg"><?php echo $msg; ?></div>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="input-group">
									<input type="text" id="rad-chat-txt" placeholder="Atualizar mensagem" class="form-control" />
									<span class="input-group-btn">
										<button id="rad-chat-send" class="btn btn-info">Atualizar</button>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>






				<div class="row">
					
					
					<div class="col-lg-3 col-md-4 col-xs-12">
						
					</div>
				
					
				</div>

			</div>
		</div>
	</section>
</main>


















<script src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/script.js"></script>



<!-- PLUGIN -->
<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>







<script type="text/javascript">
	$("#rad-chat-send").on("click", function() {
		let value = $("#rad-chat-txt").val();
		if (value) {
		$.post('includes/update-database.php', {value: value}, function (data) {});
		// $.ajax({
		 //        url:'includes/update-database.php',
		 //        type:'POST',
		 //        data: [value],
		 //        success:function(data){
		 //          alert('SUCESSO');
		 //          alert(value);
		 //        }
		   
		 //    });
			// alert(value);
		$("#chat-msg").html(value);
		}

	});

	


	
	
	$(".rad-notification-item").on("click", function(e) {
		e.stopPropagation();
	});
</script>

</body>
</html>