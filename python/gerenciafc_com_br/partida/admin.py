from django.contrib import admin

# Register your models here.
from partida.models import Gerente, Jogador, Partida, Posicao

admin.site.register([Gerente, Jogador, Partida, Posicao])
