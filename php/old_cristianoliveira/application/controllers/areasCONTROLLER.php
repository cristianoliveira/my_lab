<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class areasCONTROLLER extends CI_Controller {
	
	 public function __construct(){
    	parent::__construct();

		$this->load->helper('url');
		$this->load->helper('assets');
	         // Your own constructor code
		
	}
	
	public function index(){
	
	}
	
	public function mobile(){
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
		$paramVIEW['meta']  = "aplicativos, apk, clientes, satifação, google, tablets, smartphones, aplicativo personalizado";
		
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		$this->load->view('conteudo/mobileVIEW');
		$this->load->view('default/rodapeVIEW');
	
	}
	
	public function sites(){
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
		$paramVIEW['timer'] = 3000; 
		
		$paramVIEW['meta']  = "websites, hotsites, blogs, facebook, redes sociais, projetos startup, intranets";
			
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		$this->load->view('conteudo/sitesVIEW');
		$this->load->view('default/rodapeVIEW');
		
	}
	
	public function sistemas(){
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
		$paramVIEW['meta']  = "sistemas gerenciais, graficos, planilhas, relatorios, micro-empresas, gestão, negócios";
			
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		$this->load->view('conteudo/sistemasVIEW');
		$this->load->view('default/rodapeVIEW');
		
	}
	
	public function portfolio(){
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
		$paramVIEW['meta']  = "sistemas gerenciais, graficos, planilhas, relatorios, micro-empresas, gestão, negócios";
		
		$this->load->model('noticiasmodel','noticias',TRUE);
		
		$paramConteudoVIEW['conteudo'] = $this->noticias->get_html_page('portifolio',FALSE);  
			
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		$this->load->view('conteudo/portfolioVIEW',$paramConteudoVIEW);
		$this->load->view('default/rodapeVIEW');
		
	}
	
	public function cristianoliveira($param = ""){
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
		$paramVIEW['meta']	= "freelancer, desenvolvedor, webmaster, visionario, projetos";
			
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		if		(empty($param))	$this->load->view('conteudo/sobremim/sobremimVIEW');
		else if ($param=='experiencias') $this->load->view('conteudo/sobremim/experienciasVIEW');
		else if ($param=='ferramentas') $this->load->view('conteudo/sobremim/ferramentasVIEW');
		$this->load->view('default/rodapeVIEW');
		
	}
	
	public function ferramentas(){
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
			
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		$this->load->view('conteudo/sobremim/ferramentasVIEW');
		$this->load->view('default/rodapeVIEW');
		
	}
	
	function contato() {
		$paramVIEW['css'] 	= load_css(array('style.css','superfish.css','pagenavi-css.css','slider.css'));
		$paramVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js'));
			
		$param['imagem'] = false;
        $this->load->library('form_validation');

		$paramVIEW['action'] = site_url('sobre/contato');
		$this->load->view('default/cabecalhoVIEW',$paramVIEW);
		
		$email = $this->input->post('email', TRUE);
		$nome = $this->input->post('nome', TRUE);

		$this->form_validation->set_rules('nome','nome', 'required');
		$this->form_validation->set_rules('email','email', 'required|valid_email');
		$this->form_validation->set_rules('assunto','assuto','required');

	   if ($this->form_validation->run() == FALSE){
			$param['action'] = base_url().'usuario/add';
			$this->load->view('conteudo/contatoVIEW', $paramVIEW);
		}else{
				$this->load->view('conteudo/contatoVIEW', $paramVIEW);

				$this->load->library('email');

						$email = $this->input->post('email', TRUE);
						$telefone = $this->input->post('telefone', TRUE);
						$mensagem = $this->input->post('mensagem', TRUE);
						$assunto = $this->input->post('assunto', TRUE);

						$this->email->from($email, $nome);
						$this->email->to('c.oliveiradarosa@gmail.com');
                                                    //copia
                                                $this->email->bcc('contato@cristianoliveira.com.br');

						$this->email->subject($assunto);
						$this->email->message('<html><head></head><body>
							Nome:       ' . $nome . ' <br />
							E-mail:     ' . $email . ' <br />
							Telefone:   ' . $telefone . ' <br />
							Assunto:    ' . $assunto . ' <br />
							Mensagem:   ' . $mensagem . ' <br />
							</body></html>');

						$em = $this->email->send();
				if ($em) {
					$paramVIEW['aviso'] = 'E-mail enviado com sucesso. Logo entraremos em contato.';
					} else {
					$paramVIEW['aviso'] = 'Que coisa feia servidor de emails... Favor tente novamente';
					}
				$this->load->view('conteudo/contatoVIEW', $paramVIEW);
				}
			$this->load->view('default/rodapeVIEW');
	}

}
