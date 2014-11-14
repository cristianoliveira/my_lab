<?php
include("../includes/check_authentication.php");
include("../includes/logs.php");
include("../includes/helpers/variaveis_helper.php");
include("../includes/helpers/mensagem_helper.php");
include("../includes/models/pagseguro_model.php");

 $acao = Parameter::GET('acao');
 $pagseguro      = new PagSeguroModel();

 	switch ($acao) {
 		case 'consulta_pagseguro':
 			
 		    $today = date("Y-m-d h:m");
            $data = date("Y-m-dTh:m", strtotime($today." -30 days"));

		    $pagina         = Parameter::GET('pagina',1);
            try {
                $result = $pagseguro->getTransacoesDesde(strtotime($data),$pagina, 10);
            } catch (Exception $e) {
                echo "<tr><td>Não há dados para este filtro</td></tr>";
                return;
            }
		    
		    $numreg        = 10; 
		    $_GET['pg']    =  $inicial = Parameter::GET('pg', 0);
		    $orderBy       = Parameter::GET('ordem','');
		    $quantreg      = count($result);

//            print_r($result);

            
		    ?>

            <?php
            $transactions = $result->getTransactions();
            if (is_array($transactions) && count($transactions) > 0) 
            foreach ($transactions as $key => $transacao) {

                $detalheTransacao = $pagseguro->getTransacao($transacao->getCode());
           ?>
                <tr>
                    <td>
                        <?= $transacao->getCode() ?>
                    </td>
                    <td>
                        <?= date("d/m/Y",strtotime($transacao->getDate())) ?>
                    </td>
                    <td>
                        <?= $detalheTransacao->getSender()->getName() ?>
                    </td>
                    <td>
                        <?= $pagseguro->TIPO_PAGAMENTO[$transacao->getPaymentMethod()->getType()->getValue()] ?>
                    </td>
                    <td>
                        <?=  $pagseguro->STATUS_TRANSACAO[$transacao->getStatus()->getValue()] ?>
                    </td>
                    <td>
                        <?= $transacao->getGrossAmount() ?>
                    </td>
                    <td>&nbsp;</td>
                    <td nowrap><!-- Icons -->
                        <a href="detalhes.php?codigo=<?= $transacao->getCode() ?>" 
                            title="Editar a cliente"> 
                                Detalhes 
                        </a>
                    </td>
                </tr>
            <?php  } ?>
        <?php
 			break;
 		case 'consulta_pagseguro_por_codigo':
            $codigo = Parameter::GET('codigo', false);

            if(!$codigo)
                echo "Informe um código";
            else
            {
                try {
                    $result = $pagseguro->getTransacao($codigo);
                    
                    echo json_encode($result);

                } catch (Exception $e) {
                    echo "<tr><td>Não há dados para este filtro</td></tr>";
                    return;
                }
            }

            break;
 		default:
 			echo "ERRO";
 			break;
 	}

?>