<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$_COOKIE["news"]="current";
$_COOKIE["news1"]="";
$_COOKIE["news2"]="current";

//######### INICIO Paginação
        $numreg = 10; // Quantos registros por página vai ser mostrado
        if (!isset($_GET['pg'])) {
                @$_GET['pg'] = 0;
        }
        $inicial = $_GET['pg'] * $numreg;
        
//######### FIM dados Paginação
        
        // Faz o Select pegando o registro inicial até a quantidade de registros para página
        $sql = mysql_query("SELECT * FROM news LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM news");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
?>

<body class="destaques lista">

<table width=100% cellpading=0 cellspacing=0>
</table>

	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
	<div id="sidebar"><?php  include("../includes/sidebar.php"); ?></div> <!-- End #sidebar -->
	<div id="main-content"> <!-- Main Content Section with everything -->

		<!-- Page Head -->
		<h2>Lista de E-mails cadastrados</h2>
		<p id="page-intro">Abaixo estão listados todos os e-mails.</p>
		 <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>

		
		
  <div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

				<h3>E-mails</h3>
              <input class="destaques button botao-cadastrar" type="button" value="Cadastrar um e-mail"  onclick="javascript: location.href='cadastro.php?p=8&g=1';"  />  
                
              <form target="_blank" action="gera_xls.php" name="1" method="post">
             <input class="destaques button botao-cadastrar" type="submit" value="Gerar Excel"  />
             <input type="hidden" value="<?php echo $_GET["id"]; ?>" name="11">
             </form>
             
             <form target="_blank" action="gera_txt.php" name="1" method="post">
             <input class="destaques button botao-cadastrar" type="submit" value="Gerar Lista"  />
             <input type="hidden" value="<?php echo $_GET["id"]; ?>" name="11">
             </form>
             
			  
			  <div class="clear"></div>

			</div> <!-- End .content-box-header -->

			<div class="content-box-content">
            <?php
//compara registro
$averigua = mysql_num_rows($sql);

if($averigua!=0){ 
?>

				<table>

					<thead>
						<tr>
							<th class="current"><a href="#"class="down">Nome</a></th>
							<th class="current"><a href="#"class="down">E-mail</a></th>							
							<th class="current">Ações</th>
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
									<td>
										<a href="editar.php?p=5&g=2&id=<?php echo $row['id']; ?>" title="Editar o email."> <?php echo $row['nome'] ; ?> </a>
                                    </td>
									<td><a href="editar.php?p=5&g=2&id=<?php echo $row['id']; ?>" title="Editar o email."> <?php echo $row['email'] ; ?></a></td>
									<td>
										<!-- Icons -->
										<a href="editar.php?p=5&g=2&id=<?php echo $row['id']; ?>"title="Editar o email.">
											<img src="../imagens/icones/pencil.png"alt="Editar"/>
										</a>
                                      
										<a href="acao.php?a=3&id=<?php echo $row['id']; ?>" title="Excluir o email" class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse e-mail?')) return false;" >
											<img src="../imagens/icones/cross.png"alt="Excluir"/>
										</a>
									
                                    
                                    </td>
								</tr>
<?php  
$cont = $cont + 1;
}
?>

												</tbody>

				</table>


    <?php
	}
else{ ?>

			<div class="notification error png_bg">
				<a href="#" class="close"><img src="../images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					<strong> Nenhum e-mail cadastrado. </strong> <a href="cadastro.php?p=8&g=1"> Cadastre agora um novo e-mail. </a>
				</div>
			</div>
<?php
}
?>
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
