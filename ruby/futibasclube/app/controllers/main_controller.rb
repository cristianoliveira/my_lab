class MainController < ApplicationController
  def index
  	
  	if has_usuario_sessao
  		redirect_to "/partidas"
  	end

  end
end
