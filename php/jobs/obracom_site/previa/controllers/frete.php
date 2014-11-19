<?php defined('SITE_URL') or die('O acesso direto n&atilde;o &eacute; permitido.');

/* Espaço para comentários, TODOs e explicações das modificações em novas versões desta classe

- Classe exclusiva para montagem e envio de emails, para reunir tudo em um só lugar e poupar os outros Controllers

*/

class Controller_Frete extends Controller_Padrao
{

    /**
     * Chama o construtor da classe pai
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método inicial que faz a renderização básica da página
     */
    public function index($parametros)
    {
        echo $this->calcular('04042040','20,1',10,23,4,'sedex');
        exit;
    }

    /**
     * Método que retorna o valor do frete
     * @param $parametros
     * @return float
     */
    public function calcular($cep_destino, $largura, $altura, $comprimento, $peso, $forma_entrega)
    {
        ################################################
        #               TIPOS DE ENTREGA               #
        ################################################
        #    40010   SEDEX sem contrato                #
        #    40045   SEDEX a Cobrar, sem contrato      #
        #    40126   SEDEX a Cobrar, com contrato      #
        #    40215   SEDEX 10, sem contrato            #
        #    40290   SEDEX Hoje, sem contrato          #
        #    40096   SEDEX com contrato                #
        #    40436   SEDEX com contrato                #
        #    40444   SEDEX com contrato                #
        #    40568   SEDEX com contrato                #
        #    40606   SEDEX com contrato                #
        #    41106   PAC sem contrato                  #
        #    41068   PAC com contrato                  #
        #    81019   e-SEDEX, com contrato             #
        #    81027   e-SEDEX Prioritário, com conrato  #
        #    81035   e-SEDEX Express, com contrato     #
        #    81868   (Grupo 1) e-SEDEX, com contrato   #
        #    81833   (Grupo 2) e-SEDEX, com contrato   #
        #    81850   (Grupo 3) e-SEDEX, com contrato   #
        ################################################

        $peso = str_replace('.',',',$peso);
        $altura = str_replace('.',',',$altura);
        $largura = str_replace('.',',',$largura);
        $comprimento = str_replace('.',',',$comprimento);

        $data['nCdEmpresa'] = '';
        $data['sDsSenha'] = '';
        $data['sCepOrigem'] = '92310000';
        $data['sCepDestino'] = $cep_destino;
        $data['nVlPeso'] = $peso;
        $data['nCdFormato'] = '1';
        $data['nVlComprimento'] = $comprimento;
        $data['nVlAltura'] = $altura;
        $data['nVlLargura'] = $largura;
        $data['nVlDiametro'] = '0';
        $data['sCdMaoPropria'] = 'n';
        $data['nVlValorDeclarado'] = 0;
        $data['sCdAvisoRecebimento'] = 'n';
        $data['StrRetorno'] = 'xml';
        $data['nCdServico'] = $forma_entrega == 'pac' ? '41106' : '40010';
        $data = http_build_query($data);

        $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
        $curl = curl_init($url . '?' . $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $result = simplexml_load_string($result);

       /* foreach($result -> cServico as $row) {
            //Os dados de cada serviço estará aqui

            if($row -> Erro == 0) {
                echo $row -> Codigo . '<br>';
                echo $row -> Valor . '<br>';
                echo $row -> PrazoEntrega . '<br>';
                echo $row -> ValorMaoPropria . '<br>';
                echo $row -> ValorAvisoRecebimento . '<br>';
                echo $row -> ValorValorDeclarado . '<br>';
                echo $row -> EntregaDomiciliar . '<br>';
                echo $row -> EntregaSabado;
            } else {
                echo $row -> MsgErro;
            }
            echo '<hr>';
        } */

        return str_replace(',','.',$result->cServico->Valor);
    }

}
