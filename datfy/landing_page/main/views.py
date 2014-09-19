from django.shortcuts import render
from django.http import HttpResponse
from django.template import RequestContext, loader, Context
from django import forms

from main.models import Tipo


# Create your views here.
def home(request):
    template = loader.get_template('main.html')
    if request.method == 'post':

    	 form_interesse = InteresseForm();
         context = RequestContext(request, {'form_interesse':form_interesse})
    
    else:
         form_interesse = InteresseForm();
         context = RequestContext(request, {'form_interesse':form_interesse})
    return HttpResponse(template.render(context))

class InteresseForm(forms.Form):
	#nome  = forms.CharField(max_length = 200, label = 'Nome')
	email = forms.EmailField(label = 'Contato') 