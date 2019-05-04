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
				<p class="text-right "><a href="index.php" class="color-white bgcolor-red font-text-light font-weight-heavy car_show">Produtos</a></p><br>
				<h1 class="color-white text-center font-text-hard-two font-weight-heavy link-bgcolor-black">CARRINHO</h1>
			</header>
			
			<article class="first float-left">
			<table>
			<?php
				$sessao = $_SESSION['pedido'];
				$consulta = $pdo->prepare("SELECT * FROM carrinho_temporario WHERE temporario_sessao =:ses");
				$consulta -> bindValue(':ses', $sessao);
				$consulta -> execute();
				
				$total = 0;
				$linhas = $consulta -> rowCount();
				foreach($consulta as $mostra):
				$total += $mostra['temporario_preco'];
				
					$prod = $mostra['temporario_produto'];
					$consultar = $pdo->prepare("SELECT * FROM carrinho_produtos WHERE produto_id =:prod");
					$consultar -> bindValue(':prod', $prod);
					$consultar -> execute();
					foreach($consultar as $mostrar):
						$produtos = $mostrar['produto_nome'];
			?>
			
			<tr>
				<td class="bgcolor-gray"><p class="text-center color-dark-full font-text-light"><?= $produtos; ?></p>
				<input type="text" name="produto" value="<?= $produtos?>" style="display:none" ></td>
				<form method="post">
				<td class="bgcolor-gray"><p class="text-center color-dark-full font-text-light">
					<input type="text" value="<?= $mostrar['produto_quantidade']?>" name="1" id="estoque" style="display:none;">
					<input type="text" value="<?= $mostrar['produto_preco'];?>" name="preco" id="estoque" style="display:none;">
					<input type="number" name="id"  value="<?= $mostra['temporario_id']?>" style="display:none;">
					<input type="number" name="quantidade"  value="<?= $mostra['temporario_quantidade']?>" class="text-center" id="qtd" onchange="acrescentar()">&nbsp;<b><span id="resultado"></span></b> &nbsp;<button class="color-white link-bgcolor-green-dark-b" name="alterar" value="Alterar"> Alterar</button></p>
					<script type="text/javascript">
					var myVar = setInterval(acrescentar, 1000);
					function acrescentar () {
						var qtd = document.getElementById( 'qtd' );
						var estoque = document.getElementById( 'estoque' );
						var resultado = document.getElementById( 'resultado' );
						
						var valor_qtd = qtd.value;
						var valor_est = parseInt( estoque.value ) ;
						
						
						if(valor_qtd <= valor_est && valor_qtd >= 0){
							document.getElementById("resultado").innerHTML = "";
							
						}else if(valor_qtd < 0){
							document.getElementById("resultado").innerHTML = "Estoque Negativo Inexistente!";
						}else{
							document.getElementById("resultado").innerHTML = "Estoque Insuficiente! temos apenas: "+valor_est+ "produtos";
						}
						
					}
					</script>
					<?php
						if(isset($_POST['alterar'])):
							$qtde = filter_input(INPUT_POST,'quantidade');
							$id = filter_input(INPUT_POST,'id');
							$preco = filter_input(INPUT_POST,'preco');

							echo '<script>window.location="alterar.php?qtd='.$qtde.'&preco='.$preco.'&ref='.$id.'"</script>';
						endif;
					?>
				</td>
				
				<td class="bgcolor-gray"><p class="text-center color-dark-full font-text-light">R$ <?=  number_format($mostra['temporario_preco'], 2,',','.');?></p></td>
				<input type="text" name="preco" value="<?= $mostra['temporario_preco'] ?>" style="display:none" >
				</form>
				
				<td class="bgcolor-gray"><p class="text-center font-text-light"><a href="excluir-produto.php?ref=<?= $mostra['temporario_id']?>" class="color-dark-full">Excluir Produto</a></p></td>
			</tr>
				
			<?php endforeach; endforeach; ?>
			
			<tr>
				<td colspan="3" class="bgcolor-dark text-right color-white">
					<form method="post">
						<input type="text" name="cupom" placeholder="Se você tem um cupom de desconto ou vale. Coloque aqui...">
						<button name="descontar" value="Descontar">Descontar</button>
					</form>
					<?php
						if(isset($_POST['descontar'])):
							$cupom = filter_input(INPUT_POST, 'cupom');
							
							$consulta = $pdo->prepare("SELECT * FROM carrinho_cupom WHERE cupom_titulo = :title");
							$consulta -> bindValue(':title', $cupom);
							$consulta -> execute();
							
							$linhas = $consulta ->rowCount();
							foreach($consulta as $mostra):
								$desc = $mostra['cupom_desconto'];
							endforeach;
							
							if($linhas == 0):
								echo '<script> alert("Este cupom não existe, digite o cupom corretamente!");</script>';
							else:
								if($mostra['cupom_status'] == 1):
								$desconto = $total - $desc;
								else:
								$cal = $total / 100 * $desc;
								$desconto = $total - $cal;
								endif;
							endif;
						endif;
					?>
				</td>
				<?php if(isset($_POST['cupom'])):?>
					<td colspan="1" class="bgcolor-dark text-right color-white">Total da Compra: R$ <?= number_format($desconto, 2,',','.'); ?></td>
				<?php else: ?>
					<td colspan="1" class="bgcolor-dark text-right color-white">Total da Compra: R$ <?= number_format($total, 2,',','.'); ?></td>
				<?php endif; ?>
			</tr>
				<?php if(isset($_POST['cupom'])):?>
				<td colspan="4" class="bgcolor-dark text-right color-white">
					<a href="finalizar-pedido.php?total=<?= $desconto; ?>" class="link-bgcolor-red-dark-b text-right color-white">Finalizar Pedido</a>
				</td>
				<?php else: ?>
				<td colspan="4" class="bgcolor-dark text-right color-white">
					<a href="finalizar-pedido.php?total=<?= $total; ?>"  class="link-bgcolor-red-dark-b text-right color-white">Finalizar Pedido</a>
				</td>
				<?php endif; ?>
			<tr>
				
			</tr>
			</table>
			</article>
		</section>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</body>
</html>
