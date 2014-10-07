from django.shortcuts import render
from django.http import HttpResponse
from django.template import loader, Context


# Create your views here.
def home(request):

    template = loader.get_template('social_login.html')
    html     = template.render();

    return HttpResponse(html)
