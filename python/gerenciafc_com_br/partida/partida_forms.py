#forms
from django import forms


class HomeGerenteAcessForm(forms.Form):
    email = forms.EmailField()
    senha = forms.PasswordInput()
