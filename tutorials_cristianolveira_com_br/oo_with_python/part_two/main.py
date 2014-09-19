#executa exemplo

from veiculo import Carro, Veiculo, eVeiculoPorte

def main():
    uno = Carro("Fiat", eVeiculoPorte.pequeno)
    uno.show() # MARCA: Fiat COR DEFAULT: preto COR CUSTOMIZADA: preto
   
    #uno.muda_cor("amarelo")
    #uno.show() # MARCA: Fiat COR DEFAULT: preto COR CUSTOMIZADA: amarelo

    # Alterei a propriedade para todas as instancias.
    #Veiculo.cor_classe = "Laranja"

    #palio = Veiculo("Fiat")
    
    #print "Palio"
    #palio.show() # MARCA: Fiat COR DEFAULT: Laranja COR CUSTOMIZADA: Laranja

    #print "Uno"
    #uno.show()  # MARCA: Fiat COR DEFAULT: Laranja COR CUSTOMIZADA: amarelo
   
    

#executa o codigo
main()
