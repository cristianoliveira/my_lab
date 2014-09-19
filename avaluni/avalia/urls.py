from django.conf.urls import patterns, url
from avalia import views

urlpatterns = patterns('', 
	url(r'^$', views.index, name='index')
)