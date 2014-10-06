class Jogador < ActiveRecord::Base
  belongs_to :partida
  
  has_many :equipes_jogadors
  has_many :equipes, :through => :equipes_jogadors
   
end
