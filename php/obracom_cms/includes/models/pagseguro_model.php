<?php

 include_once "model.php";
 include_once "../includes/pagseguro_lib/pagseguro.php";
 
    class PagSeguroModel extends Model{

        //teste
        private $API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions%s?email=%s&token=%s';
        //real
        //private $API_URL = "https://ws.pagseguro.uol.com.br/v3/transactions/%s?email=$s&token=%s"
        private $email = 'cia@ciadoescritorio.com.br';
        private $token = '364E6F91BFC24772BBBF561106FFD892';
        private $credencial = null;

        public $STATUS_TRANSACAO = array( 1 => 'Aguardando pagamento'
                                        , 2 => 'Em Análise'
                                        , 3 => 'Paga'
                                        , 4 => 'Disponível'
                                        , 5 => 'Em disputa'
                                        , 6 => 'Devolvida'
                                        , 7 => 'Cancelada'
                                        );

        public $TIPO_PAGAMENTO   = array( 1 => 'Cartão de crédito'
                                        , 2 => 'Boleto'
                                        , 3 => 'Débito online (TEF)'
                                        , 4 => 'Saldo PagSeguro'
                                        , 5 => 'Oi Paggo'
                                        , 7 => 'Depósito em conta'
                                        ); 

        function __construct()
        {
            $this->table  = 'fd_pagseguro';
            $this->col_id = 'id';
            $this->credencial = PagSeguroConfig::getAccountCredentials();
            ini_set('allow_url_fopen ','ON');
        }
        
        public function getTransacao($transacao)
        {

             $transaction 
                 = PagSeguroTransactionSearchService::searchByCode($this->credencial, $transacao);
            
            return $transaction;
        }

        public function getTransacoesDesde($data, $pagina = 1, $maxresult = 10)
        {
            
            $retorno = PagSeguroTransactionSearchService::searchByDate(
                                                                        $this->credencial,
                                                                        $pagina,
                                                                        $maxresult,
                                                                        $data,
                                                                        ''
                                                                    );
            return $retorno;
        
        }

        
    }  

?>