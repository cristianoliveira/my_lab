from django.db import models

# Create your models here.
class Gerente(models.Model):
	email      = models.EmailField(max_length = 500)
	senha      = models.CharField(max_length = 300)
        
        def valida(self, p_email, p_senha):
            return Gerente.objects.filter(email = p_email, senha  = p_senha).exists()

class Posicao(models.Model):
    descricao  = models.CharField(max_length = 200)

class Jogador(models.Model):
    nome       = models.CharField(max_length = 200)
    habilidade = models.IntegerField()
    posicao    = models.ForeignKey( to = Posicao )
    partida    = models.ForeignKey( to = Gerente )

class Equipe(models.Model):
    descricao  = models.CharField( max_length = 100 )
    jogador    = models.ForeignKey( to = Jogador )

class Partida(models.Model):
    descricao  = models.CharField( max_length = 200 )
    gerente    = models.ForeignKey( to = Gerente )
