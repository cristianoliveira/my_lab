from django.conf.urls import patterns, include, url

from main import views

from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    # Examples:
    #url(r'^$', 'landing_page.views.main', name='main'),
    # url(r'^blog/', include('blog.urls')),

    # url(r'^cliente/' , views.cliente , name='cliente'),
    url(r'^admin/'   , include(admin.site.urls)),
    url(r'^'         , views.home    , name='home'),
)
