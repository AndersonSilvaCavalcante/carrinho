<?php
	session_start();
	include 'conexao.php';
?>
<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title> Série Carrinho de Compras </title>
		<link rel="stylesheet" href="css/framework.css">
		<link rel="stylesheet" href="css/estilo.css">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	</head>
	
	<body>
		<section>
			<header>
				<?php
				$sessao = $_SESSION['pedido'];
				$consulta = $pdo->prepare("SELECT * FROM carrinho_temporario WHERE temporario_sessao =:ses");
				$consulta -> bindValue(':ses', $sessao);
				$consulta -> execute();
				$linhas = $consulta -> rowCount();
				?>
				<p class="text-right "><a href="carrinho.php" class="color-white bgcolor-red font-text-light font-weight-heavy car_show">Carrinho(<?= $linhas ?>)</a></p><br>
				<h1 class="color-white text-center font-text-hard-two font-weight-heavy link-bgcolor-black">PRODUTOS</h1>
			</header>
			<?php
				$consulta = $pdo->prepare("SELECT * FROM carrinho_produtos");
				$consulta -> execute();
				
				$linhas = $consulta -> rowCount();
				
				foreach($consulta as $mostra):
			?>
			<article class="first bgcolor-white float-left">
				<h1 class="color-white text-center font-text-light-med font-weight-heavy bgcolor-black"><?= $mostra['produto_nome']?></h1>
				<img src="images/<?= $mostra['produto_img']?>" alt="Nome da Empresa: <?= $mostra['produto_nome']?>" title="Nome da Empresa: <?= $mostra['produto_nome']?>">
				<div class="espaco-min"></div>
				<p class="bgcolor-gray text-center color-dark-full font-text-med-light"><s>De: R$ 160,00</s></p>
				<p class="bgcolor-gray text-center color-dark-full font-text-light-med">Por: R$ <?= number_format($mostra['produto_preco'], 2,',','.')?></p>
				
				<p class="bgcolor-red text-center btn"><a href="comprar.php?prod=<?= $mostra['produto_id']?>" class="color-white">Comprar Produto</a></p>
			</article>
			<?php endforeach; ?>
			
		</section>
	</body>
</html>
