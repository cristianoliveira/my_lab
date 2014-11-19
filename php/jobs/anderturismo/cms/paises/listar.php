<?php  
include("../includes/cabecalho.php"); 
include('../includes/check_authentication.php');
include("../includes/database_connection.php");
include("../includes/functions.php");
include("../includes/logs.php");

$_COOKIE["paises"]="current";
$_COOKIE["paises1"]="";
$_COOKIE["paises2"]="current";



//######### INICIO Paginação
if(!empty($_GET["qtde"])){ $numreg = $_GET["qtde"]; }
else{
        $numreg = 50; // Quantos registros por página vai ser mostrado
}
        if (!isset($_GET['pg'])) {
                @$_GET['pg'] = 0;
        }
        $inicial = $_GET['pg'] * $numreg;
        
//######### FIM dados Paginação
@$pegaOrdem = $_GET["ordem"];
@$identico  = $_GET["identificacao"];

if(@$identico!=""){ $sql = mysql_query("SELECT * FROM paises WHERE nome_pais LIKE '%$identico%' LIMIT $inicial, $numreg"); 
	$sql_conta = mysql_query("SELECT * FROM paises ORDER BY nome_pais");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
}
else{
if(@$pegaOrdem!=""){ $sql = mysql_query("SELECT * FROM paises ORDER BY nome_pais $pegaOrdem LIMIT $inicial, $numreg");}
 else{  $sql = mysql_query("SELECT * FROM paises LIMIT $inicial, $numreg"); }           

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM paises ORDER BY nome_pais ASC");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
}



/*
        
        // Faz o Select pegando o registro inicial até a quantidade de registros para página
        $sql = mysql_query("SELECT * FROM paises ORDER BY nome_pais ASC LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM paises ORDER BY nome_pais ASC");        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
		*/
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
		<h2>Lista de Destinos e Países cadastrados</h2>
		<p id="page-intro"> Utilize as nossas ferramentas de seleção e busca para encontrar mais facilmente seu destino ou país cadastrado. </p>
        
		 <?php  if(@$_SESSION['erro']!="") { ?>
            <div id="errado" class="notification error png_bg"><a href="#" class="close"><img src="../imagens/icones/cross_grey_small.png" title="Fechar esta notificação" alt="fechar" /></a><div> <?php  print $_SESSION['erro']; ?> </div> </div>	
			<?php  $_SESSION['erro']=""; } ?>
            
			<?php  if(@$_SESSION['ok']!="") { ?>
			<div class="notification success png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a><div> <strong> <?php  print $_SESSION['ok']; ?></strong></div></div>
			<?php  $_SESSION['ok']=""; } ?>

            			<?php  if(@$_SESSION['ok2']==1) { ?>
			<div class="notification attention png_bg"><a class="close" href="#"><img alt="fechar" title="Fechar esta notificação" src="../imagens/icones/cross_grey_small.png"/></a>
			<div> <strong> Esse destino ou país já existe. </strong> Não pode haver redundância.</div></div>
			<?php  $_SESSION['ok2']="2"; } ?>
            
            <div>
        <form name="form" id="form">
			  <select name="ordem" id="ordem" onChange="MM_jumpMenu('parent',this,0)" style="float:left">
              <option value=""> --- Selecione a opção -- </option>
			    <option value="listar.php?ordem=asc"> NOME A-Z (Crescente) </option>
                <option value="listar.php?ordem=desc"> NOME Z-A (Decrescente) </option>
		      </select>
	  </form>
      
              <form name="form" id="form">
			  <select name="ordem" id="ordem" onChange="MM_jumpMenu('parent',this,0)" style="float:left">
              <option value=""> --- Quantidade por página -- </option>
			    <option value="listar.php?qtde=10"> 10 </option>
                <option value="listar.php?qtde=20"> 20 </option>
                <option value="listar.php?qtde=30"> 30 </option>
                <option value="listar.php?qtde=40"> 40 </option>
                <option value="listar.php?qtde=50"> 50 </option>
                <option value="listar.php?qtde=60"> 60 </option>
                <option value="listar.php?qtde=70"> 70 </option>
                <option value="listar.php?qtde=80"> 80 </option>
                <option value="listar.php?qtde=90"> 90 </option>
                <option value="listar.php?qtde=100"> 100 </option>
                <option value="listar.php?qtde=150"> 150 </option>
                <option value="listar.php?qtde=160"> 200 </option>
		      </select>
	  </form>

</div><div>
      <form name="procurar" id="procurar" action="listar.php" method="get">
      <input class="text-input small-input required" type="text" id="identificacao" name="identificacao" maxlength="255" placeholder="Digite aqui o nome do país ou letra (inicial)" />
      <input type="submit" value="Buscar" />
      </form>
      </div>
      <div style="height:10px;"> </div>
		
  <div class="content-box"><!-- Start Content Box -->

			<div class="content-box-header">

				<h3>Destinos e Países</h3>
			  <input class="destaques button botao-cadastrar" type="button" value="Cadastrar um destino ou país novo"  onclick="javascript: location.href='cadastro.php?p=7&g=1';"  />
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
							<th class="current"><a href="#"class="down">País</a></th>							<th class="current">&nbsp;</th>                            <th class="current">Ações</th>
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
										<a href="editar.php?p=7&g=2&id=<?php echo $row['idpaises']; ?>" title="Editar o país."> <?php echo $row['nome_pais'] ; ?> </a>
                                    </td>
									<td class="">&nbsp;</td>
                                    <td>
										<!-- Icons -->
										<a href="editar.php?p=7&g=2&id=<?php echo $row['idpaises']; ?>"title="Editar o país.">
											<img src="../imagens/icones/pencil.png"alt="Editar"/>
										</a>
                                      
										<a href="acao.php?a=3&id=<?php echo $row['idpaises']; ?>" title="Excluir o país" class="item-confirmar"  onclick="if(!confirm('Você tem certeza que deseja excluir esse país? ATENÇÃO: Verifique se há algum roteiro relacionado a este país.')) return false;" >
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

			<div class="notification information png_bg">
				<a href="#" class="close"><img src="../images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Nenhum país cadastrado no momento. </a>
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
