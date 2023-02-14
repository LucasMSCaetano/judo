<?php

session_start();
if((!isset ($_SESSION['usuarioEmail']) == true) and (!isset ($_SESSION['senha']) == true))
{
unset($_SESSION['email']);
unset($_SESSION['senha']);
header('location:../login.php');
}

$logado = $_SESSION['usuarioNome'];
$id = $_SESSION['usuarioId'];
  
	include("../../../../conexao.php");
	$sql = "SELECT * FROM judo WHERE id = ".$_SESSION['usuarioId'];
	
	$res = $conn->query($sql) or die($conn->error);
	
	if($res == true){
		$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../bootstrap/css/style.css">
        <script type="text/javascript" src="../bootstrap/js/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>

        <script type="text/javascript" src="../bootstrap/js/jquery.mask.js"></script>
        <script type="text/javascript" src="../bootstrap/js/scripts.js"></script>
        <title></title>
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  <a class="navbar-brand" href="#">
                        
                    </a>
                </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">

                        <li class=""><a href="#"></a></li>
                        <li class=""><a href="#"></a></li>

                    </ul>


                    <ul class="nav navbar-nav pull-right">
                        <li><a target="blank" href="#"></a>
                        </li><li><a href="javascript:history.back()">voltar</a>
                        </li>
                    </ul>


                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>



        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-8 well">
                <form method="POST" action="emitir_boleto.php" class="">
                    <div class="col-lg-5">
                        <h4>Informações do produto/serviço</h4>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Descrição do produto/serviço: (<em class="atributo">name</em>)</label>
                            <input type="text" class="form-control" id="descricao" value="Mensalidade judô" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Valor do produto/serviço: (<em class="atributo">value</em>)</label>
                            <input type="text" class="form-control" id="valor" value="<?php print $row["valor"]."00"; ?>" placeholder="Valor do Produto">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Quantidade de itens: (<em class="atributo">amount</em>)</label>
                            <select id="quantidade" class="form-control">
                                <?php for ($i = 1; $i < 20; $i++): ?>
                                    <option><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>


                    </div>
                    <div class="col-lg-5">
                        <h4>Informações do cliente</h4>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome do cliente: (<em class="atributo">name</em>)</label>
                            <input type="text" class="form-control" id="nome_cliente" value="<?php print $row["nome"]; ?>" placeholder="Nome do cliente">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">CPF: (<em class="atributo">cpf</em>)</label>
                            <input type="text" class="form-control" id="cpf" value="<?php print $row["cpf"]; ?>" placeholder="CPF">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Telefone: (<em class="atributo">phone_number</em>)</label>
                            <input type="text" class="form-control" id="telefone" value="<?php print $row["telefone"]; ?>" placeholder="Telefone">
                        </div>


                    </div>
                    <div class="col-lg-2">
                        <h4>Vencimento</h4>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Data de vencimento: (<em class="atributo">expire_at</em>)</label>
                            <input type="text" class="form-control" id="vencimento" placeholder="Data de vencimento" required="">
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <button id="btn_emitir_boleto" type="button" class="btn btn-success">Emitir boleto <img src="../img/ok-mark.png"></button>
                    </div>





            </div>
        </form>
        <div class="col-lg-4">
            <div class="col-lg-12">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="alert alert-warning" role="alert">
                        <strong>Atenção:</strong><br>
                        <p>Confira seus dados para a emissão deste boleto! não esqueça de colocar seu <strong>CPF</strong> e <strong>TELEFONE</strong> sem espaço.</p>

                    </div>
                    
                </div>
                <div class="col-lg-2"></div>
            </div>
            
            <hr>
            

        </div>

        <!--div responsável por exibir o resultado da emissão do boleto-->
        <div id="boleto" class="col-lg-8 hide">
            <div class="panel panel-success">
                <div class="panel-body">
                      <table class="table"> 
                          <!--"code":200,"data":{"barcode":"03399.32766 55400.000000 60348.101027 6 69020000009000","link":"https:\/\/visualizacaosandbox.gerencianet.com.br\/emissao\/59808_79_FORAA2\/A4XB-59808-60348-HIMA4","expire_at":"2016-08-30","charge_id":76777,"status":"waiting","total":9000,"payment":"banking_billet"-->
                        <caption><h3>Retorno da emissão.</h3></caption> 
                        <thead> 
                            <tr>
                                <th>ID da transação(<em>charge_id</em>)</th> 
                                <th>Código de Barras (<em>barcode</em>)</th> 
                                <th>Link (<em>link</em>)</th> 
                                <th>Vencimento (<em>expire_at</em>)</th> 
                                <th>Status (<em>status</em>)</th> 
                                <th>Total (<em>total</em>)</th> 
                                <th>Método de pagamento (<em>payment</em>)</th> 
                            </tr> 
                        </thead> 
                        <tbody> 
                            <tr id="result_table"> 
                            </tr> 
                        </tbody> 
                    </table>
                </div>            
            </div>            
        </div>            

    </div>


    <!-- Este componente é utilizando para exibir um alerta(modal) para o usuário aguardar as consultas via API.  -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Um momento.</h4>
                </div>
                <div class="modal-body">
                    Estamos processando a requisição <img src="../img/ajax-loader.gif">.
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <div id="rodape" class="footer well">

        <div class="container-fluid text-center">
        
        <p>Copyright &copy; 2021 Granado judô
                    
                    - Desenvolvido por <a rel="nofollow" href="https://api.whatsapp.com/send?phone=+5561995702323&text=Olá,%20estou%20interessado%20em%20seus%20serviços!%20%20%20Vim%20pelo%20site%20do%20sensei%20granado" target="_blank"" class="tm-text-link" target="_parent">Lucas Caetano</a></p>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</div>
</body>
</html>
<?php
	}
?>