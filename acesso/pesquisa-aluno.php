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

    <style>
       #botoes{
            height:50px;
            width:50px;
        }
    </style>
</head>

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

                        <form 
                             method="POST" action="pesquisa-aluno.php">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquise o aluno..."
                                    aria-label="Search" aria-describedby="basic-addon2" name="pesquisa">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pesquisa por Aluno</h1>
          

          <!-- DataTales Example -->
            <?php
              include("../conexao.php");
              $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);		// aqui que ta a putaria
              $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
              $qnt_result_pg = 10;
              $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
              $pesquisar = $_REQUEST['pesquisa'];
              //$max_result_pag = 1; kkkkkkkk mano era só alinhar o while seu corno manso kkkkkkk
              
              $result_usuarios = "SELECT * FROM judo where nome like '%$pesquisar%' LIMIT $inicio, $qnt_result_pg";
              
              $resultado_usuarios = mysqli_query($conn, $result_usuarios);

              $res = $inicio +10;
              $num_total = $conn->query("SELECT * FROM judo where nome like '%$pesquisar%'")->num_rows;



             /* while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
                $data_bd = $row_usuario["data_compra"];
                echo "dt bd $data_bd <br>";
                $data_timestamp = strtotime($data_bd);
                echo "timestamp das datas $data_timestamp<br>";
                $data_brasileira = date("d/m/Y", $data_timestamp);
                echo "data formatada $data_brasileira<br>";
              }*/

              print "<p>Exibindo a <b>$pagina</b>ª pagina de resultado(s) de <b>$num_total</b> registros.</p>";
              print "<div class='card shadow mb-4'>";
              print "<div class='card-header py-3'>";
              print "<h6 class='m-0 font-weight-bold text-primary'></h6>";
              print "</div>";
              
              print "<div class='card-body'>";
              print "<div class='table-responsive'>";
              print "<table  class='table table-bordered table-striped table-hover'  >";
              print "<thead>";
              print "<tr>";
              
                
              print "<th>Nº</th>";
              print "<th>ALUNO</th>";
              print "<th>CONDIÇÃO</th>";
              print "<th>AÇÕES</th>";
              print "</tr>";
              print "</thead>";
          
            while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){                                                                  
                    print "<tbody>";
                    print "<tr>"; 

                    print "<td>".$row_usuario["id"]."</td>";
                    print "<td>".$row_usuario["nome"]."</td>";
                    print "<td>".$row_usuario["condicao"]."</td>";
                    print "<td>
                      
                      <button class='btn btn-success' id='botoes' onclick=\"location.href='editar-aluno.php?&id=".$row_usuario["id"]."'\" ><i class='fas fa-user-edit'></i></button>  
                      
                      <button class='btn btn-danger' id='botoes' onclick=\"if(confirm('Tem certeza que deseja desativar o aluno?')){location.href='../back-end.php?page=../back-end&acao=excluir&id=".$row_usuario["id"]."';}else{false;}\"><i class='fas fa-user-times'></i></button>

                      <button class='btn btn-warning' id='botoes' onclick=\"if(confirm('Tem certeza que deseja reativar o aluno?')){location.href='../back-end.php?page=../back-end&acao=ativar&id=".$row_usuario["id"]."';}else{false;}\"><i class='fas fa-user-check'></i></button>

                      <button class='btn btn-info' id='botoes' onclick=\"location.href='descreve-aluno.php?&id=".$row_usuario["id"]."'\" ><i class='far fa-id-card fa-lg'></i></button>

                      </td>";
                      
              }
              print "</tr>";
              print " </tbody>";
              print "</table>";
                print "</div>";
                
              $result_pg = "SELECT COUNT(id) AS num_result FROM judo where nome like '%$pesquisar%'";
              $resultado_pg = mysqli_query($conn, $result_pg);
              $row_pg = mysqli_fetch_assoc($resultado_pg);

              $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);


              $max_links = 2;
                echo "<a href='alunos-ativos.php?pagina=1'>Primeira</a> ";
                
                for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
                  if($pag_ant >= 1){
                    echo "<a href='alunos-ativos.php?pagina=$pag_ant'>$pag_ant</a> ";
                  }
                }
                  
                echo "$pagina ";
                
                for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
                  if($pag_dep <= $quantidade_pg){
                    echo "<a href='alunos-ativos.php?pagina=$pag_dep'>$pag_dep</a> ";
                  }
                }
                
                echo "<a href='alunos-ativos.php?pagina=$quantidade_pg'>Última</a>";
                
                
            ?>
          
          
        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
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