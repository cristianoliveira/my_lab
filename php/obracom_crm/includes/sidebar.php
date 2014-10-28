<?php  
//$ROOT_URL="http://localhost/girardi/cms/"; 
//$ROOT_URL="/cms/"; 

$ROOT_URL = "http://$_SERVER[SERVER_NAME]/";
@$lista = $_GET["p"];
@$lista2 = $_GET["g"];

switch ($lista) {
    case 1: @$seleciona = "current"; break;
	case 2: @$seleciona = "current"; break;
	case 3: @$seleciona = "current"; break;
	case 4: @$seleciona = "current"; break;
	case 5: @$seleciona = "current"; break;
	case 6: @$seleciona = "current"; break;
	case 7: @$seleciona = "current"; break;
	case 8: @$seleciona = "current"; break;
	case 9: @$seleciona = "current"; break;
}

switch ($lista2) {
    case 1: $seleciona2="class=current";  break; 
	case 2: $seleciona2="class=current";  break; 
	case 3: $seleciona2="class=current";  break; 
	case 4: $seleciona2="class=current";  break; 
	case 5: $seleciona2="class=current";  break; 
	case 6: $seleciona2="class=current";  break; 
	case 7: $seleciona2="class=current";  break; 
	case 8: $seleciona2="class=current";  break;
	case 9: @$seleciona = "current"; break;
}	
?>
<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
		<h1 id="sidebar-title"><a href="fatorcms">Obra Comunicação</a></h1>

<!-- Logo (221px wide) -->
		<a href=""><img id="logo"src="http://www.obrcom.com.br/hotsites/prospect/cms/imagens/logo.png"alt="ObraCMS logo"></a>

		<!-- Sidebar Profile links -->
		<div id="profile-links">
			Olá, <a href="usuarios/listar.php"title="Editar meus dados"><?php  echo utf8_encode(@$_SESSION['nome_usuario']); ?>.</a><br>
			<br>
			<a href="http://www.crialeimportadora.com.br/"title="Voltar para o site">Acessar o site</a> | <a href="<?php echo $ROOT_URL; ?>/action_logout.php"title="Realizar logout">Logout</a>
		</div>

		<ul id="main-nav">  <!-- Accordion Menu -->
            <li>
				<a href="#" class="nav-top-item <?= isset($clientes_tab)? $clientes_tab: 'default'; ?>">
				Clientes
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/clientes/cadastro.php" class="<?= isset($clientes_adicionar)? $clientes_adicionar: 'default'; ?>"> Adicionar </a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/clientes/listar.php"   class="<?= isset($clientes_gerenciar)? $clientes_gerenciar: 'default'; ?>"> Gerenciar </a></li>
				</ul>
			</li>
            
        	<li>
				<a href="#" class="nav-top-item <?= $_COOKIE['categorias']; ?>">
				Categorias
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/categorias/cadastro.php" class="<?= $_COOKIE["categorias1"]; ?>"> Adicionar </a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/categorias/listar.php" class="<?= $_COOKIE["categorias2"]; ?>"> Gerenciar </a></li>
				</ul>
			</li>
            
                    			<li>
				<a href="#" class="nav-top-item <?= $_COOKIE['subcategorias']; ?>">
				Sub-Categorias
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/subcategorias/cadastro.php" class="<?= $_COOKIE["subcategorias1"]; ?>"> Adicionar </a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/subcategorias/listar.php" class="<?= $_COOKIE["subcategorias2"]; ?>"> Gerenciar </a></li>
				</ul>
			</li>
            
            <li>
				<a href="#" class="nav-top-item <?= isset($produtos_tab)? $produtos_tab: 'default'; ?>">
				Produtos
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/produtos/cadastro.php" class="<?= isset($produtos_tab_adicionar)? $produtos_tab_adicionar: 'default'; ?>"> Adicionar </a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/produtos/listar.php"   class="<?= isset($produtos_tab_gerenciar)? $produtos_tab_gerenciar: 'default'; ?>"> Gerenciar </a></li>
				</ul>
			</li>
            

             <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['empresa']; ?>">
				Sobre Nós
				</a>

				<ul style="display:none;">
					<!-- li><a href="< ?php echo $ROOT_URL; ?>/empresa/cadastro.php?p=4&g=1" < ?php  if($lista==4 and $lista2==1){ echo $seleciona2; } ?>> Adicionar</a> </li -->
					<li><a href="<?php echo $ROOT_URL; ?>/empresa/listar.php" class="<?= $_COOKIE["empresa2"]; ?>"> Gerenciar </a> </li>
				</ul>
			</li>
        
            
			<li>
				<a href="#" class="nav-top-item <?= $_COOKIE['banners']; ?>">
				Banners
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/banners/cadastro.php" class="<?= $_COOKIE["classe6"]; ?>"> Adicionar </a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/banners/listar.php" class="<?= $_COOKIE["classe7"]; ?>"> Gerenciar </a></li>
				</ul>
			</li>
            
                         <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['crop']; ?>">
				Ferramentas
				</a>

				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/crop/index.php" class="<?= $_COOKIE["crop1"]; ?>"> Editar Imagem </a> </li>
				</ul>
			</li>
            
            
        <li>

			<li>
				<a href="home#"class="nav-top-item <?php  if($lista==8){ echo $seleciona; } ?>">
				Usuários
				</a>
				<ul style="display: none; ">
					<li><a href="<?php echo $ROOT_URL; ?>/usuarios/cadastro.php?p=8&g=1" <?php  if($lista==8 and $lista2==1){ echo $seleciona2; } ?>>Adicionar</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/usuarios/listar.php?p=8&g=2" <?php  if($lista==8 and $lista2==2){ echo $seleciona2; } ?>>Gerenciar</a></li>
				</ul>
			</li>

		</ul> <!-- End #main-nav -->

	</div>