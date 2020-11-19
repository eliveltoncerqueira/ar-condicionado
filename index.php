<?php
require_once 'model/ArCondicionado.php';
require_once 'model/Cofre.php';
require_once 'model/IOT.php';
require_once 'model/Temperatura.php';


session_start();   
$_SESSION['ar'] = new ArCondicionado();
$_SESSION['cofre'] = new Cofre();
$_SESSION['iot'] = new IOT();
$_SESSION['temp'] = new Temperatura();


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
  
  
   <script type="text/javascript">
   var dados;
    var hora = 8;
	var minuto = 0;
	var sleepTime = 6000;
    function gerarRelogio(valor){
    	
    	
    	document.getElementById('hora').textContent = hora+':0'+minuto+':00';
    	 setInterval(function(){
    	        
    	        novaHora = passarTempo(hora, minuto);
    	        hora = novaHora[0];
    	        minuto = novaHora[1];
    	        if(minuto <10){
    	        	document.getElementById('hora').textContent = hora+':0'+minuto+':00';
    	        }else{
    	        	document.getElementById('hora').textContent = hora+':'+minuto+':00';
    	        }
    	        
    	    },sleepTime);
        }
       
        function zero(x) {
            if (x < 10) {
                x = '0' + x;
            } return x;
        }
        
        function passarTempo(hora, minuto){
        	if(minuto==59){
        		minuto = 0;
        		if(hora==23){
        			hora = 0;
        		}else{
        			hora  = hora+1;
        		}
        	}else{
        		minuto = minuto + 1;
        	}
        	
        	novaHora = [hora, minuto];
        	return novaHora;
        }
        function abrirCofre(){
        	var tempo = parseInt($('#tempo-abertura-cofre').val());
            if(hora > 16 || hora < 10){
                alert("Cofre não pode ser aberto, fora da hora de funcionamento!");
                
            }else{
                if(tempo <11){
                 document.getElementById("status-cofre").innerHTML = "PORTA ABERTA"
                 $('#modal-porta').modal('hide');
                	var counter = parseInt(0);
                	var i = setInterval(function(){
                	    counter++;
                	    var xhttp = new XMLHttpRequest();
                    	xhttp.onreadystatechange = function() {
                    	  if (this.readyState == 4 && this.status == 200) {
                    	   
                    	  }
                    	};
                    	xhttp.open("GET", "arquivos/abrir-porta.php", true);
                    	xhttp.send();
                	    if(counter == tempo) {
                	        document.getElementById("status-cofre").innerHTML = "PORTA FECHADA";
                	        var xhttp = new XMLHttpRequest();
                        	xhttp.onreadystatechange = function() {
                        	  if (this.readyState == 4 && this.status == 200) {
                        	    
                        	  }
                        	};
                        	xhttp.open("GET", "arquivos/fechar-porta.php", true);
                        	xhttp.send();
                        	clearInterval(i);
                	    }
                	}, sleepTime);
                }else{
                    alert("Porta do Cofre não pode ficar aberta por mais de 10 minutos")
                }
            	
            }
        }
        
       
    </script>
    <script>
    setInterval(function(){
    	var tempExterna = parseInt($('#temperatura-externa').val());
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    	  if (this.readyState == 4 && this.status == 200) {
    	    document.getElementById("ar-condicionado").innerHTML = this.responseText;
    	  }
    	};
    	xhttp.open("GET", "arquivos/ar-condicionado.php?tempExterna="+tempExterna, true);
    	xhttp.send();
    },sleepTime);
    setInterval(function(){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    	  if (this.readyState == 4 && this.status == 200) {
    	    document.getElementById("temperatura-atual").innerHTML = this.responseText + "ºC";
    	  }
    	};
    	xhttp.open("GET", "arquivos/buscar-temperatura.php", true);
    	xhttp.send();
    },sleepTime);
    setInterval(function(){
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    	  if (this.readyState == 4 && this.status == 200) {
    	    document.getElementById("umidade-atual").innerHTML = this.responseText + "%";
    	  }
    	};
    	xhttp.open("GET", "arquivos/buscar-umidade.php", true);
    	xhttp.send();
    },sleepTime);
     setInterval(function(){
    	var tempMin = parseInt($('#temperatura-minima').val());
     	var tempMax = parseInt($('#temperatura-maxima').val());
    	var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    	  if (this.readyState == 4 && this.status == 200) {
    	   
    	  }
    	};
    	xhttp.open("GET", "arquivos/sensorTemp.php?temp-min="+tempMin+"&temp-max="+tempMax, true);
    	xhttp.send();
    },sleepTime);
    
    function definirHora(){
        	$('#modal-hora').modal('hide');
        	hora  = parseInt($('#defhora').val());
        	minuto = parseInt($('#defminuto').val());
     }
    </script>
    

</head>

<body onload="gerarRelogio(3)" id="page-top">

	
  <!-- Page Wrapper -->
  <div id="wrapper">
  
  <?php require_once 'inc/header.php'; ?>
   

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" style="padding-top:50px;">
      
      
     

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          

          <!-- Content Row -->
          <div class="row">
          	
          	<div class="col-lg-6">
          <!-- Brand Buttons -->
              <div class="card shadow">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Porta do Cofre</h6>
                </div>
                <div class="card-body" style="text-align: center;">
                  <div id="status-cofre" class="h3 mb-0 font-weight-bold text-gray-800" style="padding-bottom: 10px;">PORTA FECHADA</div>
                  <button id="btn-porta-cofre" data-toggle="modal" data-target="#modal-porta" class="btn btn-google btn-block">ABRIR PORTA</button>
                  	
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-lg-6">
              <div class="card border-left-primary shadow h-100">
              	 <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Ar-Condicionado</h6>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2"  style="text-align: center;">
                      <div class="h3 mb-0 font-weight-bold text-gray-800" id="ar-condicionado" style="padding-top:20px;">Desligado</div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            

          </div>
          <div class="row" style="padding-top:10px;">
          	<div class="col-lg-6">
              <div class="card border-left-success shadow h-100">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Temperatura Interna Atual</h6>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2"  style="text-align: center;">
                      <div class="h1 mb-0 font-weight-bold text-gray-800" id="temperatura-atual" style="padding-top:20px;">21ºC</div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="card border-left-success shadow h-100">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Umidade Atual</h6>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2"  style="text-align: center;">
                      <div class="h1 mb-0 font-weight-bold text-gray-800" id="umidade-atual" style="padding-top:20px;"></div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            
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

  <!-- Modal -->
  <div class="modal fade" id="modal-temp" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Definir Temperatura Mínima e Máxima</h4>
        </div>
        <div class="modal-body">
          
                    <div class="form-group">
                      <label>Temperatura Mínima</label>
                      <input type="number" class="form-control form-control-user" value="21" id="temperatura-minima" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label>Temperatura Máxima</label>
                      <input type="number" class="form-control form-control-user" value="24" id="temperatura-maxima">
                    </div>
                   
                   
                 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>
   <div class="modal fade" id="modal-hora" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Alterar Configurações de Hora</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
                      <label>Hora</label>
                      <input type="number" class="form-control form-control-user" value="10" id="defhora" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label>Minuto</label>
                      <input type="number" class="form-control form-control-user" value="00" id="defminuto">
                    </div>
                    
                    <button onclick="definirHora()" class="btn btn-primary btn-user btn-block">
                      Enviar
                    </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>
   <div class="modal fade" id="modal-porta" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Definir Tempo de abertura da Porta</h4>
        </div>
        <div class="modal-body">
                    <div class="form-group">
                      <label>Minutos</label>
                      <input type="number" class="form-control form-control-user" value="10" id="tempo-abertura-cofre">
                    </div>
                    <button onclick="abrirCofre()" class="btn btn-primary btn-user btn-block">
                      Enviar
                    </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="modal-tempExterna" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Definir Temperatura Externa</h4>
        </div>
        <div class="modal-body">
          
                    <div class="form-group">
                      <label>Temperatura Externa</label>
                      <input type="number" class="form-control form-control-user" value="32" id="temperatura-externa" aria-describedby="emailHelp">
                    </div>
                   
                   
                 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
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
