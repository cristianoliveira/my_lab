class UsuarioPartida < ActiveRecord::Base
  belongs_to :usuario
  belongs_to :partida
end
