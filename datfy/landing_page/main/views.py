from django.shortcuts import render_to_response
from django.http import HttpResponse
from django.template import RequestContext, loader, Context
from django import forms

from main.models import Interessado


# Create your views here.
def home(request):

    obrigado = 0

    form_interesse = InteresseForm()

    if request.method == 'POST' and request.POST['email'] != "":
        obrigado       = 1
        form_interesse = 0

        exists_interessado  = Interessado.objects.filter(email = request.POST['email']).exists()

        if not exists_interessado:
            new_interessado = Interessado(desc_tipo = "cliente", email = request.POST['email'] )
            new_interessado.save()

    return render_to_response('main.html', {'form_interesse':form_interesse, 'obrigado': obrigado}, RequestContext(request))

class InteresseForm(forms.Form):
    #nome  = forms.CharField(max_length = 200, label = 'Nome')
    email = forms.EmailField(label = 'Contato')
