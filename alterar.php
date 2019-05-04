<?php
	session_start();
	include 'conexao.php';
	
	$id = filter_input(INPUT_GET, 'ref');
	$preco = filter_input(INPUT_GET, 'preco');
	$qtd = filter_input(INPUT_GET, 'qtd');
	
	$consulta = $pdo->prepare("SELECT * FROM carrinho_temporario WHERE temporario_id = :id");
	$consulta -> bindValue(':id', $id);
	$consulta -> execute();
	
	$valor =  $preco * $qtd;
	
	if($qtd <= 0):
		$deletar = $pdo->prepare("DELETE FROM carrinho_temporario WHERE temporario_id = :id");
		$deletar -> bindValue(':id', $id);
		$deletar -> execute();

		if($deletar):
			echo '<script>alert("Este produto foi deletado com sucesso!")</script>';
			echo '<script>window.location="carrinho.php"</script>';
		else:
			echo '<script>alert("Este Produto não pôde ser excluído!")</script>';
			echo '<script>window.location="carrinho.php"</script>';
		endif;
	else:
		$altera = $pdo->prepare("UPDATE carrinho_temporario SET temporario_quantidade = :val, temporario_preco = :preco WHERE temporario_id= :tp ");
		$altera -> bindValue(':val', $qtd);
		$altera -> bindValue(':preco', $valor);
		$altera -> bindValue(':tp', $id);
		$altera -> execute();
		if($altera):
			echo '<script>alert("Adicionado mais unidades a este produto!")</script>';
			echo '<script>window.location="carrinho.php"</script>';
		else:
			echo '<script>alert("Este Produto não pode ser colocado no carrrinho!")</script>';
			echo '<script>window.location="carrinho.php"</script>';
		endif;
	endif;
?>