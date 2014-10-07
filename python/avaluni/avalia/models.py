from django.db import models
	
class Instituicao(models.Model):
	nome  = models.CharField(max_length = 200)

	def __unicode__(self):
		return self.nome

class Professor(models.Model):
	instituicao = models.ForeignKey(Instituicao)
	nome        = models.CharField(max_length = 200)
	materia     = models.CharField(max_length = 200)

	def __unicode__(self):
		return self.nome

class Atributos(models.Model):
	descricao = models.CharField(max_length = 200)

	def __unicode__(self):
		return self.descricao
		
# Avaliacao professor retem os dados de professores
class AvaliacaoProfessor(models.Model):
	professor   = models.ForeignKey(Professor)
	atributo    = models.ForeignKey(Atributos)
	pontuacao   = models.IntegerField()
	texto_livre = models.TextField()

	def __unicode__(self):
		return "Avaliacao"