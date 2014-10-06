<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class contato extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('menu');
        $this->load->helper('jalert');

        $this->paramCabecalho['menuItens'] = getMenu(4);
        // Your own constructor code
        //$this->load->model('noticiasMODEL','noticias',TRUE);
        //$this->paramRodapeVIEW['localizacao'] = $this->noticias->get_html_page('localizacao',FALSE); 
    }

    public function index() {

        if($this->input->post()!=FALSE) {
            $this->load->library('email');

            $email = $this->input->post('email', TRUE);
            $nome = $this->input->post('nome', TRUE);
            $telefone = $this->input->post('telefone', TRUE);
            $cidade = $this->input->post('cidade', TRUE);
            //$estado = $this->input->post('estado', TRUE);
            $mensagem = $this->input->post('mensagem', TRUE);
            $assunto = $this->input->post('assunto', TRUE);

            $this->email->from($email, $nome);
            $this->email->to('atendimento@primous.com.br');

            $this->email->subject($assunto);
            $this->email->message('<html><head></head><body>
            Nome:       ' . $nome . ' <br />
            E-mail:     ' . $email . ' <br />
            Telefone:   ' . $telefone . ' <br />
            Cidade:     ' . $cidade . ' <br />
            Assunto:    ' . $assunto . ' <br />
            Mensagem:   ' . $mensagem . ' <br />
            </body></html>');

            $em = $this->email->send();
            if ($em) {
                jalert('E-mail enviado com sucesso. Aguarde entraremos em contato.');
            } else {
                jalert('Que feio servidor... Não foi possível enviar o email.');
            }
        $data['email_enviado'] = 'Mensagem enviada com sucesso. Logo entraremos em contato.';
        }
        $data['action'] = site_url('contato');
        $this->load->view('cabecalhoView', $this->paramCabecalho);
        $this->load->view('contatoView', $data);
        $this->load->view('rodapeView');
    }

}
