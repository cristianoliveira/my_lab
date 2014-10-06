from django.shortcuts import render_to_response, redirect
from django.template import RequestContext, loader, Context
from django import forms

from helpers import SessionHelper
from models import Gerente, Partida

# Create your views here.

#begin home

def home(request):
    gerente_acess_form = HomeGerenteAcessForm()
    form_mensagem      = ""

    if request.method == 'POST':
    	if Gerente().valida(request.POST['email'], request.POST['senha']):
    		gerente = Gerente.objects.filter(email = request.POST['email']).first()
    		request.session['gerente_id'] = gerente.id
    		return redirect('/gerencia/home')
    	else:
    		form_mensagem = "Senha invalida"

    return render_to_response('home.html', 
    	{ 'gerente_acess_form': gerente_acess_form, 
    	'form_mensagem': form_mensagem }, 
    	RequestContext(request))


class HomeGerenteAcessForm(forms.Form):
    email  = forms.EmailField()
    senha  = forms.CharField()

#end home


def gerencia_home(request):
    gerente_id = SessionHelper().gerente_validate(request)
    partidas_gerente = Partida.objects.filter(gerente_id = gerente_id)
	
    return render_to_response('gerencia_home.html', { 'partidas_gerente':partidas_gerente })