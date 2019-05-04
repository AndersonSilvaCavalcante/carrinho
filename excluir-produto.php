<?php
	session_start();
	include 'conexao.php';
	
	$id = filter_input(INPUT_GET, 'ref');
	
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
?>