<?php

/*
 * Method to load css files into your project.
 *
 * Accepts a string or array as parameter.
 * @author Cristian Oliveira
 * @version 1.0
 * @param String $msg

 *  */
if (!function_exists('jalert')) {

	function getMenu($SeqMenuItemSelecionado = 0) {
            $menu = '';
            
            $menu0 = '<div class="menuItem"><a href="'.base_url().'" {0} >Inicio</a></div>';
            $menu1 = '<div class="menuItem"><a href="'.base_url().'empresa" {0} >Empresa</a></div>';
            $menu2 = '<div class="menuItem"><a href="'.base_url().'produto" {0} >Produtos</a></div>';
            $menu3 = '<div class="menuItem"><a href="'.base_url().'contato" {0} >Contato</a></div>';
            
            switch ($SeqMenuItemSelecionado) {
                case 2: $menu1 = str_replace('{0}', 'id="menuItemSelecionado"', $menu1);   break;
                case 3: $menu2 = str_replace('{0}', 'id="menuItemSelecionado"', $menu2);   break;
                case 4: $menu3 = str_replace('{0}', 'id="menuItemSelecionado"', $menu3);   break;
                default:
                $menu0 = str_replace('{0}', 'id="menuItemSelecionado"', $menu0);   break;
                    break;
            }
                $menu = str_replace('{0}', "", $menu0.$menu1.$menu2.$menu3); 
            return $menu;
	}

}

