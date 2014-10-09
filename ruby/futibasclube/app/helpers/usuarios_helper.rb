module UsuariosHelper

   def set_usuario_sessao(pUsuario)
       session[:usuario_id] = pUsuario.id
   end

   def get_usuario_sessao
       Usuario.find(session['usuario_id'])
   end

   def del_usuario_sessao
       session[:usuario_id] = nil
   end

   def has_usuario_sessao
       !session[:usuario_id].nil? 
   end

end
