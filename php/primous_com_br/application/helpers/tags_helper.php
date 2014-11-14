<?php

/*
 * Method to load css files into your project.
 *
 * Accepts a string or array as parameter.
 * @author Cristian Oliveira
 * @version 1.0
 * @param String $msg

 *  */
if (!function_exists('set_div')) {
   
	function set_tag($valor,$class = null,$tag = 'div', $id = null) {
           $html = '';
           str_replace($tag, '', array('<','>'));
            
           if (!empty($id)) $id = ' id="'.$id.'"';
          
           if (!empty($class)) $class = ' class="'.$class.'"';
            
                if (is_array($valor)){
                    foreach ($valor as $val){
                         $vlr_tag = "\n".'<'.$tag.$id.$class.'>'."\n".'
                                       '.$val."\n".'
                                     </'.$tag.'>';
                      
                      $html .=  $vlr_tag;
                    }
                    
                }else{
            
                    $html .= ' <'.$tag.$id.$class.'>
                                '.$valor.'
                              </'.$tag.'>';
                }
           return $html;
	}

}

