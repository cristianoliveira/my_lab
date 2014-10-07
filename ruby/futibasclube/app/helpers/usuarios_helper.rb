module UsuariosHelper

   def setUsuarioSessao(pUsuario)
       p "### ID USUARIO PARAMETRO "+pUsuario.id.to_s
       session[:usuario_id] = pUsuario.id
       p "### ID USUARIO SESSAO "+session[:usuario_id].to_s
   end

   def getUsuarioSessao
       Usuario.find(session['usuario_id'])
   end

   def destroyUsuarioSessao
       session[:usuario_id] = nil
   end

end
