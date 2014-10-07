require 'digest/sha1'

class Usuario < ActiveRecord::Base
  has_many :usuario_partidas
  has_many :partidas, :through => :usuario_partidas
  
  has_one  :detalhes_usuario  
 
  validates :senha, confirmation:true, presence: true
  validates :email, confirmation: true
  
  def senha=(value)
    write_attribute(:senha, self.class.sha1(value))
  end

  def self.sha1(pass)  
    Digest::SHA1.hexdigest("futbol--#{pass}--")  
  end

  def existe
      usuario = Usuario.where(email: self.email, senha: self.senha).first
      
			if usuario 
      	self.id = usuario.id;
      end

      return usuario
  end 
  
end
