<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
    ob_start();
    include('imp-roteiros-selecionados.php');
    $content = ob_get_clean();

    //  print_r($content);

    // convert to PDF
    require_once(dirname(__FILE__).'/inc/mpdf/mpdf.php');
    try
    {
        $mpdf=new mPDF();
        $mpdf->WriteHTML($content);
        $mpdf->Output();
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }