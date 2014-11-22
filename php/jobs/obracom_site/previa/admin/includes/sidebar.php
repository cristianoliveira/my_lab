<?php  
//$ROOT_URL="http://localhost/girardi/cms/"; 
//$ROOT_URL="/cms/"; 

$ROOT_URL = "http://$_SERVER[SERVER_NAME]/previa/admin";
@$lista = $_GET["p"];
@$lista2 = $_GET["g"];

/*
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
*/
?>
<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
        <h1 id="sidebar-title"><a href="fatorcms">Obra Comunicação</a></h1>

<!-- Logo (221px wide) -->
        <a href=""><img id="logo"src="http://www.obrcom.com.br/hotsites/prospect/cms/imagens/logo.png"alt="ObraCMS logo"></a>

        <!-- Sidebar Profile links -->
        <div id="profile-links">
            Olá, <a href="usuarios/listar.php"title="Editar meus dados">
                    <?php  echo @$_SESSION['nome_usuario']; ?>.</a><br>
            <br>
            <a href="<?= $ROOT_URL; ?>"title="Voltar para o site">Acessar o site</a> | <a href="<?php echo $ROOT_URL; ?>/action_logout.php"title="Realizar logout">Logout</a>
        </div>

        <ul id="main-nav">  <!-- Accordion Menu -->
            <li>
                <a href="#" class="nav-top-item <?= isset($clientes_tab)? $clientes_tab: 'default'; ?>">
                Clientes
                </a>
                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/clientes/cadastro.php" 
                           class="<?= if_exist($clientes_adicionar,'default') ?>"> Adicionar </a></li>
                    <li><a href="<?php echo $ROOT_URL; ?>/clientes/listar.php"   
                           class="<?= if_exist($clientes_gerenciar,'default') ?>"> Gerenciar </a></li>
                </ul>
            </li>
            
            <li>
                <a href="#" class="nav-top-item <?= if_exist($categorias_tab) ?>">
                Categorias
                </a>
                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/categorias/cadastro.php" 
                           class="<?= if_exist($categorias_adicionar,'default') ?>"> Adicionar </a></li>
                    <li><a href="<?php echo $ROOT_URL; ?>/categorias/listar.php" 
                           class="<?= if_exist($categorias_gerenciar,'default') ?>"> Gerenciar </a></li>
                </ul>
            </li>
            
            <li>
                <a href="#" class="nav-top-item <?= if_exist($produtos_tab, 'default'); ?>">
                Produtos
                </a>
                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/produtos/cadastro.php" 
                            class="<?= if_exist($produtos_tab_adicionar,'default') ?>"> Adicionar </a></li>
                    <li><a href="<?php echo $ROOT_URL; ?>/produtos/listar.php"   
                            class="<?= if_exist($produtos_tab_gerenciar, 'default') ?>"> Gerenciar </a></li>
                </ul>
            </li>
            

            
            <li>
                <a href="#" class="nav-top-item <?= if_exist($banners_tab, 'default') ?>">
                Banners
                </a>
                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/banners/cadastro.php" 
                           class="<?= if_exist($banners_adicionar,'default') ?>"> Adicionar </a></li>
                    <li><a href="<?php echo $ROOT_URL; ?>/banners/listar.php" 
                           class="<?= if_exist($banners_gerenciar,'default') ?>"> Gerenciar </a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="nav-top-item <?= if_exist($destaques_tab, 'default') ?>">
                Destaques
                </a>
                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/destaques/cadastro.php" 
                           class="<?= if_exist($destaques_adicionar,'default') ?>"> Adicionar </a></li>
                    <li><a href="<?php echo $ROOT_URL; ?>/destaques/listar.php" 
                           class="<?= if_exist($destaques_gerenciar,'default') ?>"> Gerenciar </a></li>
                </ul>
            </li>
            
            <li>
                <a href="#" class="nav-top-item <?= if_exist($enquetes_tab, 'default') ?>">
                Enquetes
                </a>
                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/enquetes/cadastro.php" 
                           class="<?= if_exist($enquetes_adicionar,'default') ?>"> Adicionar </a></li>
                    <li><a href="<?php echo $ROOT_URL; ?>/enquetes/listar.php" 
                           class="<?= if_exist($enquetes_gerenciar,'default') ?>"> Gerenciar </a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="nav-top-item <?= if_exist($pagseguro_tab, 'default') ?>">
                PagSeguro
                </a>
                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/pagseguro/listar.php" 
                           class="<?= if_exist($pagseguro_gerenciar,'default') ?>"> Transações </a></li>
                    <li><a href="<?php echo $ROOT_URL; ?>/pagseguro/consulta.php" 
                           class="<?= if_exist($pagseguro_procurar,'default') ?>"> Procurar por Código</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="nav-top-item <?= if_exist($empresa_tab, 'default'); ?>">
                Empresa
                </a>

                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/empresa/listar.php" 
                           class="<?= if_exist($empresa_gerenciar, 'default'); ?>"> Gerenciar </a> </li>
                </ul>
            </li>
            <!--
             <li>
                <a href="#" class="nav-top-item <?= if_exist($empresa_tab, 'default'); ?>">
                Sobre Nós
                </a>

                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/empresa/listar.php" 
                           class="<?= if_exist($empresa_gerenciar, 'default'); ?>"> Gerenciar </a> </li>
                </ul>
            </li>
        
             <li>
                <a href="#" class="nav-top-item <?= if_exist($ferramentas_tab, 'default'); ?>">
                Ferramentas
                </a>

                <ul style="display:none;">
                    <li><a href="<?php echo $ROOT_URL; ?>/crop/index.php" class="<?= if_exist($_COOKIE["crop1"],'default'); ?>"> Editar Imagem </a> </li>
                </ul>
            </li> -->
            
            
        <li>

            <li>
                <a href="home#"class="nav-top-item <?=  if_exist($usuarios_tab,'default') ?>">
                Usuários
                </a>
                <ul style="display: none; ">
                    <li><a href="<?= $ROOT_URL; ?>/usuarios/cadastro.php?p=8&g=1" 
                           class="<?=  if_exist($usuarios_adicionar,'default') ?>">Adicionar</a></li>
                    <li><a href="<?= $ROOT_URL; ?>/usuarios/listar.php?p=8&g=2" 
                           class="<?=  if_exist($usuarios_gerenciar,'default') ?>">Gerenciar</a></li>
                </ul>
            </li>

        </ul> <!-- End #main-nav -->

    </div>