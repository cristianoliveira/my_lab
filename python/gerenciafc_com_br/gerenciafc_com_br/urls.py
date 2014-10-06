from django.conf.urls import patterns, include, url

from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    # Examples:
    # url(r'^$', 'gerenciafc_com_br.views.home', name='home'),
    # url(r'^blog/', include('blog.urls')),

    url(r'^admin/', include(admin.site.urls)),
    url(r'^gerencia/home', 'partida.views.gerencia_home', name='home'),
    url(r'^$', 'partida.views.home', name='home'),
)
