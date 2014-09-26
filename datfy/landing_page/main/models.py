from django.db import models

class Tipo(models.Model):
	descricao = models.CharField(max_length = 200)

class Interessado(models.Model):
    #tipo      = models.ForeignKey('Tipo')
    desc_tipo = models.CharField(max_length = 200) 
    nome      = models.CharField(max_length  = 200)
    email     = models.EmailField(max_length = 300)

#    empresa  = models.CharField(max_length  = 300)
#    estado   = models.CharField(max_length  = 500)
#    cidade   = models.CharField(max_length  = 500)
