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
                        <h6 class="collapse-header">Relatórios Ágeis:</h6>
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
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        
                        <div class='col-xl-3 col-md-6 mb-4'>
                            <div class='card border-left-success shadow h-100 py-2'>
                                <div class='card-body'>
                                    <div class='row no-gutters align-items-center'>
                                        <div class='col mr-2'>
                                            <div class='text-xs font-weight-bold text-success text-uppercase mb-1'>
                                                Pagamento (Mensal)</div>
                        <?php include("../conexao.php"); 
                        
                        $num_total_mensalidade =  $conn->query("SELECT SUM(`valor`) as sd FROM `judo` WHERE `condicao` like 'ativo'");
                        $row = mysqli_fetch_array($num_total_mensalidade);
                        $saldo=$row['sd'];
                                        echo"<div class='h5 mb-0 font-weight-bold text-gray-800'>$".$saldo ."</div>";
                                        echo"</div>";
                                        echo"<div class='col-auto'>";
                                            echo"<i class='fas fa-dollar-sign fa-2x text-gray-300'></i>";
                                        echo"</div>";
                                    echo"</div>";
                                echo"</div>";
                            echo"</div>";
                        echo"</div>";
                        ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total de despesas por todos os aluno</div>
                        <?php include("../conexao.php"); 
                        
                        $num_total_mensalidade =  $conn->query("SELECT SUM(`valor`) as sd FROM `judo` WHERE `condicao` like 'ativo'");

                        $margem_calculo =  $conn->query("SELECT * FROM `judo` WHERE `condicao` like 'ativo'")->num_rows;

                        $despesa_por_aluno = $margem_calculo * 50;

                        $row = mysqli_fetch_array($num_total_mensalidade);

                        $despesa= $row['sd'] - $despesa_por_aluno;

                                        echo"<div class='h5 mb-0 font-weight-bold text-gray-800'>$".$despesa_por_aluno ."</div>";
                                        echo"</div>";
                                        echo"<div class='col-auto'>";
                                            echo"<i class='fas fa-dollar-sign fa-2x text-gray-300'></i>";
                                        echo"</div>";
                                    echo"</div>";
                                echo"</div>";
                            echo"</div>";
                        echo"</div>";
                        ?>

                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Lucro total Mensal
                                            </div>
                                            
                        <?php include("../conexao.php"); 
                        
                        $num_total_mensalidade =  $conn->query("SELECT SUM(`valor`) as sd FROM `judo` WHERE `condicao` like 'ativo'");

                        $margem_calculo =  $conn->query("SELECT * FROM `judo` WHERE `condicao` like 'ativo'")->num_rows;

                        $despesa_por_aluno = $margem_calculo * 50;

                        $row = mysqli_fetch_array($num_total_mensalidade);

                        $despesa= $row['sd'] - $despesa_por_aluno;

                                        echo"<div class='h5 mb-0 font-weight-bold text-gray-800'>$".$despesa ."</div>";
                                        echo"</div>";
                                        echo"<div class='col-auto'>";
                                            echo"<i class='fas fa-dollar-sign fa-2x text-gray-300'></i>";
                                        echo"</div>";
                                    echo"</div>";
                                echo"</div>";
                            echo"</div>";
                        echo"</div>";
                        ?>

                    

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Lucro com todos os alunos cadastrados
                                            </div>
                                            
                        <?php include("../conexao.php"); 
                        
                        $num_total_mensalidade =  $conn->query("SELECT SUM(`valor`) as sd FROM `judo`");

                        $margem_calculo =  $conn->query("SELECT * FROM `judo` ")->num_rows;

                        $despesa_por_aluno = $margem_calculo * 50;

                        $row = mysqli_fetch_array($num_total_mensalidade);

                        $despesa= $row['sd'] - $despesa_por_aluno;

                                        echo"<div class='h5 mb-0 font-weight-bold text-gray-800'>$".$despesa ."</div>";
                                        echo"</div>";
                                        echo"<div class='col-auto'>";
                                            echo"<i class='fas fa-dollar-sign fa-2x text-gray-300'></i>";
                                        echo"</div>";
                                    echo"</div>";
                                echo"</div>";
                            echo"</div>";
                        echo"</div>";
                        ?>

                    </div>

                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
                <!-- /.container-fluid -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card">
                        <h5 class="card-header">Alunos Ativos/Não ativos</h5>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <canvas id="myChart" width="400" height="400"></canvas>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                    <?php include("../conexao.php"); 
                        $num_total_ativos = $conn->query("SELECT * FROM `judo` WHERE `condicao` like 'ativo'")->num_rows; 
                        $num_total_nativos = $conn->query("SELECT * FROM `judo` WHERE `condicao` like 'inativo'")->num_rows ;
                    ?>
                <script>
                    var ctx = document.getElementById('myChart');
                    var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Ativos',
                        'Não Ativos'],
                        datasets: [{
                        label: '# of Votes',
                        data: [<?php echo  $num_total_ativos; ?>, <?php echo $num_total_nativos; ?>],
                        backgroundColor: [
                            'rgba(166, 41, 46)',
                            'rgba(36, 8, 9)'
                        ],
                        borderColor: [
                            'rgba(166, 41, 46)',
                            'rgba(36, 8, 9)'
                        ],
                        borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                        yAxes: [{
                            ticks: {
                            beginAtZero: true
                            }
                        }]
                        }
                    }
                    });
                </script>

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
                    <a class="btn btn-primary" href="logout.php"  >Sair</a>
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