from django.contrib import admin
# Register your models here.
from avalia.models import Instituicao, Professor, Atributos, AvaliacaoProfessor

# Para mostrar apenas alguns campos
# class ProfessorAdmin(admin.ModelAdmin):
# 	fields = ['nome']

class AtributosInLine(admin.StackedInline):
	model = AvaliacaoProfessor
	extra = 4

class ProfessorAdmin(admin.ModelAdmin):
	#fields       = ['nome','materia']
	inlines      = [AtributosInLine]
	
#	list_filter  = ('nome','materia')

admin.site.register([Instituicao, Professor, Atributos, AvaliacaoProfessor], ProfessorAdmin)