<?php
include('../includes/check_authentication.php');
include("../includes/functions.php");
include("../includes/logs.php");

include("../includes/models/enquetes_model.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/models/opcoes_enquete_model.php");

   $opcoesEnquete  = new OpcoesEnqueteModel();
   $acao = Parameter::GET('acao');
   log_file("AJAX ACAO $acao");
         	
   switch ($acao) {
   	case 'delete_opcao':
   		 
   		 $opcaoId     = Parameter::GET('idopcao',0);
   		   
         if($opcaoId != 0)
         {
            if($opcoesEnquete->deleteById($opcaoId))
            {
                echo '1';
                return;
            }
            else
            {
                echo '0';
                return;
            }
         	
         } 
         else
         {
         	echo '0';
         	return;
         }

		break;
   	
   }

?>