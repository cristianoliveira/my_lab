<?php  
$ROOT_URL = "http://$_SERVER[SERVER_NAME]/novo/cms"; //mudar qdo for on
$paginaok = "p=&g=";
?>
<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->

		<h1 id="sidebar-title"><a href="fatorcms">Obra Comunicação</a></h1>

<!-- Logo (221px wide) -->
		<a href=""><img id="logo"src="http://www.obrcom.com.br/hotsites/prospect/cms/imagens/logo.png"alt="ObraCMS logo"></a>

		<!-- Sidebar Profile links -->
		<div id="profile-links">
			Olá, <a href="usuarios/listar.php"title="Editar meus dados"><?php  echo utf8_encode(@$_SESSION['nome_usuario']); ?>.</a><br>
			<br>
			<a href="http://www.andesturismo.com.br/"title="Voltar para o site">Acessar o site</a> | <a href="<?php echo $ROOT_URL; ?>/action_logout.php"title="Realizar logout">Logout</a>
		</div>

		<ul id="main-nav">  <!-- Accordion Menu -->

        			<li>
				<a href="#" class="nav-top-item2 <?= $_COOKIE['hoteis']; ?>">
				Hotéis
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/hoteis/cadastro.php" class="<?= $_COOKIE["hoteis1"]; ?>"> Adicionar Hotel </a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/hoteis/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["hoteis2"]; ?>"> Gerenciar Hotéis </a></li>
				</ul>
			</li>
            
            
            <li>
				<a href="#" class="nav-top-item2 <?= $_COOKIE['apartamentos']; ?>">
				Tipos de Apartamentos
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/apartamentos/cadastro.php" class="<?= $_COOKIE["apartamentos1"]; ?>"> Adicionar Apartamento </a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/apartamentos/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["apartamentos2"]; ?>"> Gerenciar Apartamentos </a></li>
				</ul>
			</li>
            
            			<li>
				<a href="#" class="nav-top-item2 <?= $_COOKIE['precos']; ?>">
				Tabela de Preços
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/precos/cadastro.php" class="<?= $_COOKIE["precos1"]; ?>"> Adicionar Preço</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/precos/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["precos2"]; ?>"> Gerenciar Preços </a></li>
				</ul>
			</li>
            
                     
            <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['roteiros']; ?>">
				Roteiros de Viagens
				</a>
				<ul style="display:none;" >
					<li><a href="<?php echo $ROOT_URL; ?>/roteiros/cadastro.php" class="<?= $_COOKIE["roteiros1"]; ?>"> Adicionar Roteiro</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/roteiros/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["roteiros2"]; ?>"> Gerenciar Roteiros </a></li>
                    <!-- li><a href="< ?php echo $ROOT_URL; ?>/relacoes/cadastro.php" class="< ?= $_COOKIE["relacionados1"]; ?>"> Adicionar Relação</a></li>
                    <li><a href="< ?php echo $ROOT_URL; ?>/relacoes/listar.php< ?= "?".$paginaok; ?>" class="< ?= $_COOKIE["relacionados2"]; ?>"> Gerenciar Relações </a></li -->
				</ul>
			</li>           

             <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['videos']; ?>">
				Vídeos de Roteiros
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/videos/cadastro.php" class="<?= $_COOKIE["videos1"]; ?>"> Adicionar Vídeo</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/videos/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["videos2"]; ?>"> Gerenciar Vídeos </a></li>
				</ul>
			</li>         
            
             <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['capas']; ?>">
				Capas de Roteiros
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/capas/cadastro.php" class="<?= $_COOKIE["capas1"]; ?>"> Adicionar Capa</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/capas/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["capas2"]; ?>"> Gerenciar Capas </a></li>
				</ul>
			</li>
            
                       <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['paises']; ?>">
				Destinos e Países
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/paises/cadastro.php" class="<?= $_COOKIE["paises1"]; ?>"> Adicionar País</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/paises/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["paises2"]; ?>"> Gerenciar Países </a></li>
				</ul>
			</li>
            
            
                       <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['banners']; ?>">
				Banners
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/banners/cadastro.php" class="<?= $_COOKIE["banners1"]; ?>"> Adicionar Banner</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/banners/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["banners2"]; ?>"> Gerenciar Banners </a></li>
				</ul>
			</li>
            
            <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['empresa']; ?>">
				Empresa
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/empresa/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["empresa2"]; ?>"> Gerenciar Página </a></li>
				</ul>
			</li>
             <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['parceiros']; ?>">
				Parceiros
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/parceiros/cadastro.php" class="<?= $_COOKIE["parceiros1"]; ?>"> Adicionar Parceiro</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/parceiros/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["parceiros2"]; ?>"> Gerenciar Parceiros </a></li>
				</ul>
			</li>
            
             <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['downloads']; ?>">
				Downloads
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/downloads/cadastro.php" class="<?= $_COOKIE["downloads1"]; ?>"> Adicionar Download</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/downloads/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["downloads2"]; ?>"> Gerenciar Downloads </a></li>
				</ul>
			</li>
            
           <li>
				<a href="#" class="nav-top-item <?= $_COOKIE['news']; ?>">
				E-mails cadastrados
				</a>
				<ul style="display:none;">
					<li><a href="<?php echo $ROOT_URL; ?>/news/cadastro.php" class="<?= $_COOKIE["news1"]; ?>"> Adicionar E-mail</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/news/listar.php<?= "?".$paginaok; ?>" class="<?= $_COOKIE["news2"]; ?>"> Gerenciar E-mails </a></li>
				</ul>
			</li>

			<li>
                <a href="<?php echo $ROOT_URL; ?>/crop/index.php" class="nav-top-item3 no-submenu <?= $_COOKIE['crop']; ?>">
				Editar Imagens
				</a>
			</li>

			<li>
				<a href="home#"class="nav-top-item <?= $_COOKIE['usuarios']; ?>">
				Usuários
				</a>
				<ul style="display: none; ">
					<li><a href="<?php echo $ROOT_URL; ?>/usuarios/cadastro.php?p=8&g=1" class="<?= $_COOKIE["usuarios1"]; ?>">Adicionar</a></li>
					<li><a href="<?php echo $ROOT_URL; ?>/usuarios/listar.php?p=8&g=2" class="<?= $_COOKIE["usuarios2"]; ?>">Gerenciar</a></li>
				</ul>
			</li>

		</ul> <!-- End #main-nav -->

	</div>