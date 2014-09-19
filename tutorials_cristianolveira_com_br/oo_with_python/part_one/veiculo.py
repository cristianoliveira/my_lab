class Veiculo(object):
  
   marca        = ""

   # este atributo sera visivel e compartilhado entre todas as instancias inclusive quando alterado.
   cor_classe   = "preto" # Ford style: "qualquer cor desde que seja preto" 
 
   def __init__(self, pMarca):
       self.marca           = pMarca
       # Este atributo somente sera visivel para a instancia.
       self.cor_instancia   = self.cor_classe

   def muda_cor(self, pNovaCor):
       self.cor_instancia = pNovaCor

   def show(self):
       print "MARCA: %s COR DEFAULT: %s COR CUSTOMIZADA: %s" % (self.marca, self.cor_classe, self.cor_instancia)

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

