class Jogador < ActiveRecord::Base
  belongs_to :partida
  
  has_many :equipes_jogadors
  has_many :equipes, :through => :equipes_jogadors

  HABILIDADES = ["Perna de pau", "Mais ou menos", "Bom jogador", "Joga muito"]

  def desc_mensalista
  	  if self.mensalista
  	  	 "Sim"
  	  else
  	  	 "Nao"
  	  end
  end

  def desc_ativo
      if self.ativo
         "Sim"
      else
         "Nao"
      end
  end

end
