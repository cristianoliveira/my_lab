class Veiculo(object):
  
   # estes atributos serao visiveis e compartilhados entre todas as instancias inclusive quando alterado.
   cor_padrao   = "preto" # Ford style: "qualquer cor desde que seja preto" 
   quantidade_rodas  = 0      
   quantidade_portas = 0      
   
   def __init__(self, pMarca, pPorte):
       self.marca           = pMarca
       # Este atributo somente sera visivel para a instancia.
       self.cor_atual       = self.cor_padrao
       self.porte           = pPorte 
       
   def muda_cor(self, pNovaCor):
       self.cor_instancia = pNovaCor
   
   def tipo(self):
       return type(self)

   def desc_porte(self):
       if self.porte   == eVeiculoPorte.pequeno:
          return "Pequeno"
       elif self.porte == eVeiculoPorte.medio:
          return "Medio"
       else:
          return "Grande" 

   def show(self):
       print "TIPO: %s \n MARCA: %s \n COR DEFAULT/ATUAL: %s / %s \n QTDE RODAS: %s \n PORTE: %s " % (
                self.tipo(), 
		self.marca, 
		self.cor_padrao, 
		self.cor_atual, 
		self.quantidade_rodas,
                self.desc_porte()
               )

# Classe Carro filha do Veiculo
class Carro(Veiculo):
      
      #Seta novos valores default para o tipo Carro
      cor_padrao        = "prata" # Ford style: "qualquer cor desde que seja preto" 
      quantidade_rodas  = 4      
      quantidade_portas = 2
      
class Moto(Veiculo):
      
      cor_padrao        = "preto" # Ford style: "qualquer cor desde que seja preto" 
      quantidade_rodas  = 2
      
      # Override do Metodo construtor, pois moto sempre será porte pequeno
      def __init__(self, pMarca):
          Veiculo.__init__(self, pMarca, eVeiculoPorte.pequeno)


# Criei um enum para setar o porte do veiculo e facilitar a visualizacao      
class eVeiculoPorte:
      pequeno, medio, grande = range(1,4)
      
"""
def main():
    uno = Veiculo("Fiat")
    uno.show() # MARCA: Fiat COR DEFAULT: preto COR CUSTOMIZADA: preto
   
    uno.muda_cor("amarelo")
    uno.show() # MARCA: Fiat COR DEFAULT: preto COR CUSTOMIZADA: amarelo

    # Alterei a propriedade para todas as instancias.
    Veiculo.cor_classe = "Laranja"

    palio = Veiculo("Fiat")
    
    print "Palio"
    palio.show() # MARCA: Fiat COR DEFAULT: Laranja COR CUSTOMIZADA: Laranja

    print "Uno"
    uno.show()  # MARCA: Fiat COR DEFAULT: Laranja COR CUSTOMIZADA: amarelo
   
#executa o codigo
main()
"""
