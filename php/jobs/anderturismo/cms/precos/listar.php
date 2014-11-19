<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$_COOKIE["precos"]="current";	
$_COOKIE["precos1"]="";
$_COOKIE["precos2"]="current";

//######### INICIO Paginação
        $numreg = 50; // Quantos registros por página vai ser mostrado
        if (!isset($_GET['pg'])) {
                @$_GET['pg'] = 0;
        }
        $inicial = $_GET['pg'] * $numreg;
        
//######### FIM dados Paginação
$sql_pegaHoteis = mysql_query("SELECT * FROM hoteis");  
@$pegaHotel = $_GET["hotel"];
@$pegaOrdem = $_GET["ordem"];

if(@$pegaOrdem!=""){
      
        // Faz o Select pegando o registro inicial até a quantidade de registros para página
        $sql = mysql_query("SELECT * FROM precos, hoteis, apartamentos WHERE hotel_id=idhoteis AND apartamento_id=idapartamentos ORDER BY nome_hotel $pegaOrdem LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM precos");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação

}

if(@$pegaHotel!=""){
      
        // Faz o Select pegando o registro inicial até a quantidade de registros para página
        $sql = mysql_query("SELECT * FROM precos, hoteis, apartamentos WHERE hotel_id=idhoteis AND apartamento_id=idapartamentos AND hotel_id=$pegaHotel LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM precos");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação

}

if(@$pegaHotel=="" and @$pegaOrdem==""){
	
	        // Faz o Select pegando o registro inicial até a quantidade de registros para página
        $sql = mysql_query("SELECT * FROM precos, hoteis, apartamentos WHERE hotel_id=idhoteis AND apartamento_id=idapartamentos LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM precos");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
}
?>

<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<body class="destaques lista">

<table width=100% cellpading=0 cellspacing=0>
</table>

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->
	  <!-- Page Head -->
		<h2>Lista de Preços cadastrados</h2>
		<p id="page-intro">Abaixo estão listados todos os preços.</p>
		 <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<p>
			  <?php  $_SESSION['ok']=""; } ?>
	  </p>
			<h3> Filtrar </h3>
			<form name="form" id="form">
			  <select name="ordenarHoteis" id="ordenarHoteis" onChange="MM_jumpMenu('parent',this,0)" style="float:left">
              <option value=""> --- Selecione o hotel -- </option>
              <?php while ($row = mysql_fetch_array($sql_pegaHoteis)) { ?>
			    <option value="listar.php?hotel=<?php  echo $row['idhoteis']; ?>"><?php  echo $row['nome_hotel']; ?></option>
               <?php  } ?>
		      </select>
	  </form>
      
      <form name="form" id="form">
			  <select name="ordem" id="ordem" onChange="MM_jumpMenu('parent',this,0)" style="float:left">
              <option value=""> --- Selecione a opção -- </option>
			    <option value="listar.php?ordem=asc"> NOME A-Z (Crescente) </option>
                <option value="listar.php?ordem=desc"> NOME Z-A (Decrescente) </option>
		      </select>
	  </form>
      
      <div style="height:40px;"> </div>
	  <div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

			  <h3> Preços </h3>
              
			  <input class="destaques button botao-cadastrar" type="button" value="Cadastrar um preço novo"  onclick="javascript: location.href='cadastro.php?p=6&g=1';"  />
              				
			  <div class="clear"></div>

		</div> <!-- End .content-box-header -->

			<div class="content-box-content">

				<table>

					<thead>
						<tr>
						  <th class="current"><a href="#"class="down">Apartamento</a></th>
						  <th class="current">Hotel</th>
                          <th class="current">Preço</th>
						  <th  class="current">Ações</th>                            
						</tr>
					</thead>

					<tfoot>
						<tr>
							<td colspan="3">
<?php  include("../includes/_paginate.php"); ?>
								 <!-- End .pagination -->								
								<div class="clear"></div>
							</td>
						</tr>
					</tfoot>

					<tbody>
<?php  $cont = 0;
// Exibe o resultado da nossa consulta
while ($row = mysql_fetch_array($sql))
{ 
?>
                    
														<tr>
														  <td><a href="editar.php?id=<?php echo $row['idprecos']; ?>" title="Editar o Apartamento"> <?php echo $row['nome_apartamento'] . " - " .  $row['sigla'];  ?></a></td>
														  <td class=""><?php echo $row['nome_hotel'];  ?></td>
                                                          <td><?php echo $row['valor'];  ?> </td>
														  <td><!-- Icons -->
									  <a href="editar.php?id=<?php echo $row['idprecos']; ?>"title="Editar o preço do apartamento"> <img src="../imagens/icones/pencil.png"alt="Editar"/> </a> <a href="acao.php?a=3&id=<?php echo $row['idprecos']; ?>" title="Excluir o preço" class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse item? O apartamento irá ficar sem valor de diária.')) return false;"> <img src="../imagens/icones/cross.png"alt="Excluir"/> </a></td>
                                                    </tr>
                                                    
<?php  
$cont = $cont + 1;
}
?>
												</tbody>

				</table>

    </div> <!-- End .content-box-content -->

		</div> <!-- End .content-box -->


			<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						© Copyright 2014 OBRA Comunicação | <a href="#body-wrapper">Ir para o topo</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>
