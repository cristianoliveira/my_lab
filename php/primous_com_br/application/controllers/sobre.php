<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sobre extends CI_Controller {
     
	  public function __construct(){
    	parent::__construct();

		$this->load->helper('my_url');
		$this->load->helper('assets');
                $this->load->helper('jalert');
                                    
	         // Your own constructor code
		
		/* default ver cabecalho */
	        $this->paramCabecalhoVIEW['css'] 	= load_css(array('site_style.css','slider.css'));
		$this->paramCabecalhoVIEW['js'] 	= load_js(array('java.js','jquery.js','s3Slider.js'));
	
		/*var rodape*/
		$this->load->model('noticiasMODEL','noticias',TRUE);
		$this->paramRodapeVIEW['localizacao'] = $this->noticias->get_html_page('localizacao',FALSE); 
	    
	
	}


	public function index(){

	}
	
    public function pagina($pagina){
    	define('WP_USE_THEMES', false);
        require('blog/wp-load.php');
        
        
        
    	$this->paramCabecalhoVIEW['meta']  = "apafut, escolinha, caxias do sul, escolinha de futebol,".$pagina;
        
              $page = get_page_by_title(strtoupper($pagina));
              $paramConteudoVIEW['titulo']      = $page->post_title;
              $conteudo = $page->post_content;
              $conteudo = apply_filters('the_content', $conteudo);
              $paramConteudoVIEW['conteudo'] = $conteudo;
              $paramConteudoVIEW['page_title']  = $page->post_title;
         
         if (empty($paramConteudoVIEW['titulo']) || empty($paramConteudoVIEW['conteudo'])) my_redirect (my_site_url().'error');

		$this->load->view('default/cabecalhoVIEW',$this->paramCabecalhoVIEW);
		$this->load->view('conteudo/pagesVIEW',$paramConteudoVIEW);
		$this->load->view('default/rodapeVIEW',$this->paramRodapeVIEW);

	}
        
     public function noticia($post_id){
    	define('WP_USE_THEMES', false);
        require('blog/wp-load.php');
            $this->load->model('wordpressMODEL','wps',TRUE);
            //$this->paramCabecalhoVIEW['css']    .= $this->wps->getAllCss();
            $this->paramCabecalhoVIEW['js']  .= $this->wps->getAllJs();
	     
              $page = get_post($post_id);
              $paramConteudoVIEW['titulo'] = $page->post_title;
              $paramConteudoVIEW['page_title']  = $page->post_title;
              $this->paramCabecalhoVIEW['meta']  = "noticias, novidades, apafut, escolinha, caxias do sul, escolinha de futebol,".$paramConteudoVIEW['titulo'];
              
              $conteudo = $page->post_content;
              $conteudo = apply_filters('the_content', $conteudo);
              
               $paramConteudoVIEW['conteudo'] = $conteudo;

              //if (empty($paramConteudoVIEW['titulo']) || empty($paramConteudoVIEW['conteudo'])) my_redirect (my_site_url().'error');
              
		$this->load->view('default/cabecalhoVIEW',$this->paramCabecalhoVIEW);
		$this->load->view('conteudo/pagesVIEW',$paramConteudoVIEW);
		$this->load->view('default/rodapeVIEW',$this->paramRodapeVIEW);

	}
        
    public function fotos($id_galeria,$qtde_registros = 1){
        $this->load->model('galeriasMODEL','galeria',TRUE);
       
        $qtde_total   = $this->galeria->get_count_galeria($id_galeria);
        $paginas = ($qtde_total%4);
        if($qtde_total == 0) my_redirect('sobre/galeria/');
        if($paginas+1 < $qtde_registros) my_redirect('sobre/galeria/');
        
        $this->paramCabecalhoVIEW['css'] 	= load_css(array('site_style.css','slider.css','prettyPhoto.css'));
        $this->paramCabecalhoVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js','java.js','jquery.prettyPhoto.js'));
        $this->paramCabecalhoVIEW['meta']       = "futebol, escolinha, apafut, caxias do sul, serra gaúcha";
        $paramConteudoVIEW['page_title']        = 'historia';

        
        $hmtl_galeria = '<div><h2>Fotos - '.$this->galeria->get_titulo_galeria($id_galeria).'</h2></div>';
          $hmtl_galeria .= '<div style="margin:10px; float: left;">';
          $hmtl_galeria .= $this->galeria->get_html_galeria($id_galeria,($qtde_registros-1)*4);
          $hmtl_galeria .= '</div>';
          
          $link_galeria = '<div class="links_fotos">';
          for($i=1;$i<$paginas+2;$i++){
              if($qtde_registros==$i)
              {
                $link_galeria .= my_anchor('sobre/fotos/'.$id_galeria.'/'.$i, $i,array('id'=>'selecionado'));
              }
           else 
              {
                $link_galeria .= my_anchor('sobre/fotos/'.$id_galeria.'/'.$i, $i);
              }
          }
          $link_galeria .= '</div>';
          
        $hmtl_videos =' ';
        $paramConteudoVIEW['videos'] = $link_galeria;
        $paramConteudoVIEW['galeria'] = $hmtl_galeria;
        
        
		$this->load->view('default/cabecalhoVIEW',$this->paramCabecalhoVIEW);
		$this->load->view('conteudo/galeriaVIEW',$paramConteudoVIEW);
		$this->load->view('default/rodapeVIEW',$this->paramRodapeVIEW);

	
    }

    public function galeria(){
    	$this->paramCabecalhoVIEW['css'] 	= load_css(array('site_style.css','slider.css','prettyPhoto.css'));
        $this->paramCabecalhoVIEW['js'] 	= load_js(array('jquery.js','s3Slider.js','java.js','jquery.prettyPhoto.js'));
        $this->paramCabecalhoVIEW['meta']       = "futebol, escolinha, apafut, caxias do sul, serra gaúcha";
        $paramConteudoVIEW['page_title']        = 'historia';

        $this->load->model('galeriasMODEL','galeria',TRUE);
        $galerias = $this->galeria->get_arr_galerias();

        $hmtl_galeria = '<div><h2>Galerias</h2></div>';

        foreach($galerias as $g){

          $hmtl_galeria .= '<div style="margin:10px; float: left;">';
          $hmtl_galeria .= $this->galeria->get_capa_galeria($g['gid']);
          $hmtl_galeria .= '</div>';

        }
       // $hmtl_videos = $this->galeria->get_html_wps(81);
        $videos = $this->galeria->get_html_videos();
        $hmtl_videos ='<div><h2>Videos</h2></div>';
        $hmtl_videos.='<div id="video_principal">'.$this->galeria->get_youtube_iframe().'</div>'.$videos; 
        $paramConteudoVIEW['videos'] = $hmtl_videos;
        $paramConteudoVIEW['galeria'] = $hmtl_galeria;
        
        
		$this->load->view('default/cabecalhoVIEW',$this->paramCabecalhoVIEW);
		$this->load->view('conteudo/galeriaVIEW',$paramConteudoVIEW);
		$this->load->view('default/rodapeVIEW',$this->paramRodapeVIEW);

	}

    function localizacao() {
          $this->paramCabecalhoVIEW['js'] = load_js(array('java.js','jquery.js','s3Slider.js','jquery.maskedinput-1.1.4.pack.js'));
	  $this->paramCabecalhoVIEW['script'] = '<script type="text/javascript">
                                                        $(document).ready(function(){
                                                                $("#telefone").mask("(999)9999-9999");
                                                        });
                                                </script>';
	$this->load->library('form_validation');

		$this->paramCabecalhoVIEW['action'] = my_site_url('sobre/localizacao');
		$this->load->view('default/cabecalhoVIEW',$this->paramCabecalhoVIEW);
       
	   $paramVIEW['mapa']        = $this->noticias->get_html_page('mapa');
	   $paramVIEW['endereco']    = $this->noticias->get_html_page('localizacao');
	   
	   
	   /**********************Contato***************************************************/
		$email = $this->input->post('email', TRUE);
		$nome = $this->input->post('nome', TRUE);

		$this->form_validation->set_rules('nome','nome', 'required');
		$this->form_validation->set_rules('email','email', 'required|valid_email');
		$this->form_validation->set_rules('assunto','assunto','required');
                $this->form_validation->set_rules('telefone','telefone','required');
                $this->form_validation->set_rules('mensagem','mensagem','required');

	   if ($this->form_validation->run() == FALSE){
			$this->load->view('conteudo/contatoVIEW', $paramVIEW);
		}else{
				$this->load->view('conteudo/contatoVIEW', $this->paramCabecalhoVIEW);

				$this->load->library('email');

						$email = $this->input->post('email', TRUE);
						$telefone = $this->input->post('telefone', TRUE);
						$cidade = $this->input->post('cidade', TRUE);
						$mensagem = $this->input->post('mensagem', TRUE);
						$assunto = $this->input->post('assunto', TRUE);

						$this->email->from($email, $nome);
						$this->email->to('contato@apafut.com.br');

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
                                    echo jalert('Email enviado com sucesso.');
                                    my_redirect(my_site_url());
                                    
                                        } else {
					$paramVIEW['aviso'] = 'Que coisa feia servidor de emails... Favor tente novamente';
					}
				$this->load->view('conteudo/contatoVIEW', $paramVIEW);
				}
		/***************************************************************************/
		
			$this->load->view('default/rodapeVIEW',$this->paramRodapeVIEW);
	}

}
