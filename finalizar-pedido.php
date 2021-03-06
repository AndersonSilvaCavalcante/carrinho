<?php
	session_start();
	include 'conexao.php';
		
		$totale = filter_input(INPUT_GET, 'total');
		$total = number_format($totale, 2,',','.');

		$sessao = $_SESSION['pedido'];
		$consulta = $pdo-> prepare("SELECT * FROM carrinho_temporario WHERE temporario_sessao = :ses");
		$consulta -> bindValue(':ses', $sessao);
		$consulta -> execute();
		$linhas = $consulta -> rowCount();
		
		foreach($consulta as $mostra):
		$produto_id = $mostra['temporario_produto'];
		$produto_quantidade = $mostra['temporario_quantidade'];
		$produto_preco = $mostra['temporario_preco'];
		$produto_data = date('Y-m-d H:i:s');
		
		$inserir = $pdo->prepare("INSERT INTO carrinho_pedidos (pedido_produto, pedido_quantidade, pedido_preco ,pedido_valor_total, pedido_data, pedido_sessao) VALUES ('$produto_id','$produto_quantidade','$produto_preco','$total','$produto_data','$sessao')");
		$inserir ->execute();
		endforeach;
		if(!$_SESSION['logado']):
			echo '<script>window.location="login.php"</script>';
		else:
			echo '<script>window.location="continuar.php"</script>';
		endif;
?>