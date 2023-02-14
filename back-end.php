<?php
include("conexao.php");
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

	$data = new DateTime();
	$data_formatada = $data->format('m-d-Y H:i:s');
    $id                     = @$_REQUEST["id"];
	$nome                   = @$_REQUEST["nome"];
	$dataNascimento         = @$_REQUEST["dataNascimento"];
	$sexo                   = @$_REQUEST["sexo"];
	$rg                     = @$_REQUEST["rg"];
	$cpf                    = @$_REQUEST["cpf"];
	$graduacao              = @$_REQUEST["graduacao"];
	$telefone               = @$_REQUEST["telefone"];
	$email                  = @$_REQUEST["email"];
	$responsavel            = @$_REQUEST["responsavel"];
	$telefoneResponsavel    = @$_REQUEST["telefoneResponsavel"];
	$cpfResponsavel         = @$_REQUEST["cpfResponsavel"];
	$emailResponsavel       = @$_REQUEST["emailResponsavel"];
	$CEP                    = @$_REQUEST["CEP"];
	$endereco               = @$_REQUEST["endereco"];
	$modalidade             = @$_REQUEST["modalidade"];
	$valor                  = @$_REQUEST["valor"];
	$troca                  = @$_REQUEST["troca"];

	$t = md5($troca);
	$senha = '123';
	$dados = md5($senha);


	switch($_REQUEST["acao"]){
		case "cadastrar":
		
			$sql = "INSERT INTO judo ( nome, dataNascimento, sexo, rg, cpf, graduacao, telefone, email, responsavel, telefoneResponsavel, cpfResponsavel , emailResponsavel, CEP, endereco, condicao, modalidade, valor) 
				VALUES ( UPPER('{$nome}'), '{$dataNascimento}', '{$sexo}', Trim('{$rg}'), Trim('{$cpf}'), '{$graduacao}', Trim('{$telefone}'), '{$email}', '{$responsavel}', '{$telefoneResponsavel}', '{$cpfResponsavel}', '{$emailResponsavel}', '{$CEP}', '{$endereco}', 'ativo', '{$modalidade}', '150')";
			
			$sql2 = "INSERT INTO `usuarios`(`nome`, `email`, `senha`, `situacoe_id`, `niveis_acesso_id`, `created`) 
				VALUES (UPPER('{$nome}'),'{$email}','{$dados}','1','2','{$data_formatada}')";

			$res = $conn->query($sql) or die($conn->error);

			$res = $conn->query($sql2) or die($conn->error);

			$arquivo 	= $_FILES['arquivo']['name'];
			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = "fotos/". $_UP['nome'];
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
			
			//Renomeiar
			$_UP['renomeia'] = true;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['arquivo']['error'] != 0){
				//$mensagem_erro = "Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']];
				//die($mensagem_erro);

				die('<script type="text/javascript">
					alert(Não foi possivel fazer o upload, erro: Não foi feito o upload do arquivo IMAGEM);
					</script>
					');

				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){		
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'>
					<script type=\"text/javascript\">
						alert(A imagem não foi cadastrada extesão inválida! extensões validas são: png, jpg, jpeg);
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'>
					<script type=\"text/javascript\">
						alert(\"Arquivo muito grande.\");
					</script>
				";
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				/*if($UP['renomeia'] === true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = 'essaferabixo.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['arquivo']['name'];
				}*/
				$nome_final = $_REQUEST["cpf"].'_aluno.jpg';
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
					$query = mysqli_query($conn, "INSERT INTO imagem (
					nome_imagem) VALUES('$nome_final')");
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php''>
						<script type=\"text/javascript\">
							alert(\"Cadastro realizado com sucesso.\");
						</script>
					";	
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem não foi cadastrada com Sucesso.\");
						</script>
					";
				}
			}

		break;
		case "troca-senha":

			$sql = "UPDATE `usuarios` SET `senha`='{$t}'  WHERE id = ".$_REQUEST["id"];

			$res = $conn->query($sql) or die($conn->error);

			if($res==true){
				print "<script>alert('Senha alterada com sucesso.');</script>";
				print "<script>location.href='javascript:history.back()';</script>";
			}else{
				print "<br><div class='alert alert-danger'><p>Não foi possível alterar sua senha, entre em contato com o Sensei Granado.</p></div>";
			}

		break;
		case "foto":
			$arquivo 	= $_FILES['arquivo']['name'];
			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = "fotos/". $_UP['nome'];
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
			
			//Renomeiar
			$_UP['renomeia'] = true;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['arquivo']['error'] != 0){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){		
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
					<script type=\"text/javascript\">
						alert(\"A imagem não foi cadastrada extesão inválida.\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
					<script type=\"text/javascript\">
						alert(\"Arquivo muito grande.\");
					</script>
				";
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				/*if($UP['renomeia'] === true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = 'essaferabixo.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['arquivo']['name'];
				}*/
				$nome_final = $_REQUEST["id"].'_aluno.jpg';
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
					$query = mysqli_query($conn, "INSERT INTO imagem (
					nome_imagem) VALUES('$nome_final')");
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem cadastrada com Sucesso.\");
						</script>
					";	
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem não foi cadastrada com Sucesso.\");
						</script>
					";
				}
			}
		break;

		case "editar":
			$cpf = $_REQUEST['cpf'];
			$sql = "UPDATE judo SET 

			nome='{$nome}',
			dataNascimento='{$dataNascimento}',
			sexo='{$sexo}',
			rg='{$rg}',
			cpf='{$cpf}',
			graduacao='{$graduacao}',
			telefone='{$telefone}',
			email='{$email}',
			responsavel='{$responsavel}',
			telefoneResponsavel='{$telefoneResponsavel}',
			cpfResponsavel='{$cpfResponsavel}',
			emailResponsavel='{$emailResponsavel}',
			CEP='{$CEP}',
			endereco='{$endereco}',
			valor='{$valor}'

			WHERE id = ".$_REQUEST["id"];
			
			$res = $conn->query($sql) or die($conn->error);
			
			$arquivo 	= $_FILES['arquivo']['name'];
			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = "fotos/". $_UP['nome'];
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
			
			//Renomeiar
			$_UP['renomeia'] = true;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			if($_FILES['arquivo']['error'] == 4){
				echo 'tudo certo!'; //Para a execução do script
			}
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['arquivo']['error'] != 0 & 4){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){		
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/acesso/login.php'>
					<script type=\"text/javascript\">
						alert(\"Edição realizada com sucesso! você será redirecionado a página de login\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'>
					<script type=\"text/javascript\">
						alert(\"Arquivo muito grande.\");
					</script>
				";
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				/*if($UP['renomeia'] === true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = 'essaferabixo.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['arquivo']['name'];
				}*/
				$nome_final = $cpf.'_aluno.jpg';
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
					$query = mysqli_query($conn, "INSERT INTO imagem (
					nome_imagem) VALUES('$nome_final')");
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php''>
						<script type=\"text/javascript\">
							alert(\"Cadastro realizado com sucesso.\");
						</script>
					";	
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem não foi cadastrada com Sucesso.\");
						</script>
					";
				}

			if($res==true){
				print "<script>alert('Aluno editado com sucesso');</script>";
				print "<script>location.href='javascript:history.back(-1)';</script>";
			}else{
				print "<br><div class='alert alert-danger'><p>Não foi possível editar</p></div>";
			}
			print "<button class='btn btn-warning' onclick='history.back(-1)'>Voltar</button>";
		}
		break;
		case "excluir":
			$sql = "UPDATE judo SET condicao ='inativo' WHERE id = ".$_REQUEST["id"];
					/*UPDATE judo SET condicao ='inativo'
									/*dataExclusao = 	CURDATE()
							WHERE id = ".$_REQUEST["id"];*/
			
			$res = $conn->query($sql) or die($conn->error);
			
			if($res==true){
				print "<script>alert('O aluno foi inativado com sucesso.');</script>";
				print "<script>location.href='acesso/site.php';</script>";
			}else{
				print "<br><div class='alert alert-danger'><p>Não foi possível excluir.</p></div>";
			}
		break;
		case "ativar":
			$sql = "UPDATE judo SET condicao ='ativo' WHERE id = ".$_REQUEST["id"];
					/*UPDATE judo SET condicao ='inativo'
									/*dataExclusao = 	CURDATE()
							WHERE id = ".$_REQUEST["id"];*/
			
			$res = $conn->query($sql) or die($conn->error);
			
			if($res==true){
				print "<script>alert('O aluno foi ativado com sucesso.');</script>";
				print "<script>location.href='acesso/site.php';</script>";
			}else{
				print "<br><div class='alert alert-danger'><p>Não foi possível excluir.</p></div>";
			}
		break;
		case "excluDE":
			$sql = "UPDATE judo SET condicao ='EXCLUÍDO',
																dataExclusao = 	CURDATE()
							WHERE id IN ($id)";
			
			$res = $conn->query($sql) or die($conn->error);
			
			if($res==true){
				print "<script>alert('Patrimônios excluidos');</script>";
				print "<script>location.href='javascript:history.back()';</script>";
			}else{
				print "<br><div class='alert alert-danger'><p>Não foi possível excluir.</p></div>";
			}
		break;
	}
?>











