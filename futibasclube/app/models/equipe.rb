class Equipe < ActiveRecord::Base
  has_many :equipes_jogadors
  has_many :jogadors ,:through => :equipes_jogadors
  
  @arrayJogadores
  
  
  def adiciona(pJogador)
      if @arrayJogadores.nil?
         @arrayJogadores = Array.new 
      end 
         @arrayJogadores << pJogador
  end

  def getJogadoresArray
      @arrayJogadores
  end
  
  def size
      if @arrayJogadores.nil?
         0
      else
         @arrayJogadores.size
      end
  end 

end
