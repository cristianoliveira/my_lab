<?php

class cepModel extends CI_Model {

    CONST TbEstados = 'testados';  
    CONST TbCidades = 'tcidades';  
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->load->library('encrypt');
    }
    
    function GetEstados()
    {
        $query = $this->db->get(self::TbEstados);
        $estados = $query->result();
            
        return $estados;
    }
    
    function GetCidades($pEstado_id, $pCidade_id = null)
    {
        $arrWhere['estado_id'] = $pEstado_id;
        
        if($pCidade_id!=null)
            $arrWhere['id'] = $pCidade_id;
        
         return $this->db->select('id, nome')
                     ->from('tcidades')
                     ->where($arrWhere)
                     ->get()->result();
    }
    
    function GetDropdownEstados($pNomeDropDown,$pSelected = null,$pExtra = null)
    {
        $query = $this->db->get(self::TbEstados);
        $estados = $query->result();
        foreach ($estados as $r)
        {
            $array[$r->id] = $r->sigla;
        }
        return form_dropdown($pNomeDropDown, $array, $pSelected, $pExtra);
    }
    
    function GetFormularioCEP($pEstadoSelecionado, $pCidade, $pSulfixoName = null)
    {
        $nomeCidade = 'Escolha';
        $cidadeId  = 0;
        if($pCidade!=null)
        {    
            $nomeCidade = $pCidade[0]->nome;
            $cidadeId = $pCidade[0]->id;
        }
        return '  <div>
                            <label for="'.$pSulfixoName.'estado">Estado</label>
                                '.$this->GetDropdownEstados($pSulfixoName.'estado',$pEstadoSelecionado,'id="estado"').'
                          <label for="'.$pSulfixoName.'nome">Cidade</label>
                              <select name="'.$pSulfixoName.'cidade" id="cidade">
                                <option value='.$cidadeId .'>'.$nomeCidade.'</option>
                              </select>
                        </div>
                        ';
    }
}   
?>
