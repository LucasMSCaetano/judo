<?php
	include("../conexao.php");
	$sql = "SELECT * FROM judo WHERE id = ".$_REQUEST["id"];
	
	$res = $conn->query($sql) or die($conn->error);
	
	if($res == true){
		$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Controle - Granado Judô</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
   
</head>
<style>
.ajeita{
    position:absolute;
    left: 15%;
    top: 50%;
    margin-top: -180px;
}
</style>
<body id="page-top">
    <?php
            session_start();
            if((!isset ($_SESSION['usuarioEmail']) == true) and (!isset ($_SESSION['senha']) == true))
            {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('location:login.php');
            }

            $logado = $_SESSION['usuarioNome'];
           
    ?> 
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="site.php">
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <img src="img/dash.png">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="site.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users-cog"></i>
                    <span>Controle de alunos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Verificação rápida:</h6>
                        <a class="collapse-item" href="alunos-ativos.php">Alunos ativos</a>
                        <a class="collapse-item" href="alunos-todos.php">Todos os alunos</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-clipboard-list "></i>
                    <span>Relatórios</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="relatorio-troca-faixa.php">Troca de faixa</a>
                        
                    </div>
                </div>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
            
                                echo "<span class='mr-2 d-none d-lg-inline text-gray-600 small'>".$_SESSION['usuarioNome']."</span>";
                                    
                                ?>
                                
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Log de Atividades
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="container">

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                <div class="col-lg-5 d-none d-lg-block "><div class="ajeita"><img src="../fotos/<?php print $row['cpf']; ?>_aluno.jpg" width="300" height="300"  position="absolute" left="130"  top="155"></div></div>
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Editar dados do Aluno</h1>
                                            </div>

                                                <form action="../back-end.php?page=../back-end" method="POST"  enctype="multipart/form-data">
                                                    <input type="hidden" name="acao" value="editar">
                                                    <input type="hidden" name="id" value="<?php print $row["id"]; ?>">
                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                <label>Nome</label>
                                                                <input type="text" name="nome" value="<?php print $row["nome"]; ?> " class="form-control form-control-user" >
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>Data de Nascimento</label>
                                                                <input type="text" name="dataNascimento" value="<?php print $row["dataNascimento"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                <label>Sexo</label>
                                                                <input type="text" name="sexo" value="<?php print $row["sexo"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>RG</label>
                                                                <input type="text" name="rg" value="<?php print $row["rg"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                <label>CPF</label>
                                                                <input type="text" name="cpf" value="<?php print $row["cpf"]; ?>" class="form-control form-control-user" >
                                                            </div>    
                                                            <div class="col-sm-6">
                                                                <label>Graduação e ano</label>
                                                                <input type="text" name="graduacao" value="<?php print $row["graduacao"]; ?>" class="form-control form-control-user" >
                                                            </div>    
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                <label>Telefone</label>
                                                                    <input type="text" name="telefone" value="<?php print $row["telefone"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                            <div class="col-sm-6">
                                                            <label>E-mail</label>
                                                                <input type="text" name="email" value="<?php print $row["email"]; ?>" class="form-control form-control-user"  >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                <label>Responsável</label>
                                                                <input type="text" name="responsavel" value="<?php print $row["responsavel"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>Telefone - Responsável</label>
                                                                <input type="text" name="telefoneResponsavel" value="<?php print $row["telefoneResponsavel"]; ?>" class="form-control form-control-user"  >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label>CPF Responsável</label>
                                                                <input type="text" name="cpfResponsavel" value="<?php print $row["cpfResponsavel"]; ?>" class="form-control form-control-user"  >
                                                            </div>
                                                            <div class="col-sm-6">
                                                            <label>Email Responsável</label>
                                                                <input type="text" name="emailResponsavel" value="<?php print $row["emailResponsavel"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                <label>CEP</label>
                                                                <input type="text" name="CEP" value="<?php print $row["CEP"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>Endereço</label>
                                                                <input type="text" name="endereco" value="<?php print $row["endereco"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label> Mensalidade </label>
                                                            
                                                            <input type="number" name="valor" value="<?php print $row["valor"]; ?>" class="form-control form-control-user" >
                                                            </div>
                                                            <div class="col-sm-6">
                             
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label> Alterar foto </label>
                                                                <input name="arquivo" type="file">
                                                            </div>
                                                            <div class="col-sm-6">
                             
                                                            </div>
                                                        </div>

                                        
                                                        
                                                        
                                                    <hr>
                                                    <button class="btn btn-primary btn-user btn-block" type="submit">
                                                    Salvar
                                                    </button>
                                                
                                                
                                                </form>
                                                
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2021 Granado judô  </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Aperte em "sair" para voltar para a pagina principal.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php
	}
?>