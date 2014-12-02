
<center>
 
 
<div class="pagination">
<?php 
        @$quant_pg = ceil($quantreg/$numreg);
        @$quant_pg++;
        
        // Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
        if ( @$_GET['pg'] > 0) { 
                echo "<li><a href=".@$PHP_SELF."?pg=".(@$_GET['pg']-1) ."&p=".@$_GET['p']."&g=".@$_GET['g']."><b>&laquo; anterior</b></a></li>";
				
        } else { 
                echo "<li><a href='#'>&laquo;</a></li>";
        }
        
        // Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
        for(@$i_pg=1;@$i_pg<@$quant_pg;@$i_pg++) { 
                // Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
                if (@$_GET['pg'] == (@$i_pg-1)) { 
						echo "<li><a href='#' class='number current' title='$i_pg'>$i_pg</a></li>";
                } else {
                        @$i_pg2 = @$i_pg-1;
                        echo "<li>&nbsp;<a href=".@$PHP_SELF."?pg=$i_pg2&p=".@$_GET['p']."&g=".@$_GET['g']." class=number><b>$i_pg</b></a>&nbsp;</li>";
                }
        }
        
        // Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
        if ((@$_GET['pg']+2) < @$quant_pg) { 
                echo "<li><a href=".@$PHP_SELF."?pg=".(@$_GET['pg']+1)."&p=".@$_GET['p']."&g=".@$_GET['g']."><b>próximo &raquo;</b></a></li>";
        } else { 
                echo " <li><a href='#'>&raquo;</a></li>";
        }
?>	
</div>

</center>