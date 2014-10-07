from django.shortcuts import render, render_to_response
from helpers import NetworkHelper
import re

# Create your views here.
def home(request):
    context_vars = {"home_title":"Titulo Teste"}
    return render_to_response('social_login.html', context_vars)

def facebook_login(request):
    remote_ip    = request.META['REMOTE_ADDR']
    print "##### sudo /usr/sbin/arp -an %s  " % remote_ip

    nh = NetworkHelper()
    print nh
    remote_mac = nh.get_mac_from_ip(remote_ip)
    
    context_vars = { "remote_ip" : remote_ip, "remote_mac" : remote_mac } 
    return render_to_response('facebook_login.html', context_vars )