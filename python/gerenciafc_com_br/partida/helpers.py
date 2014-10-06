#helpers.py
class SessionHelper:
    from django.shortcuts import redirect

    @staticmethod
    def gerente_validate(request):
        if request.session['gerente_id'] is not None:
        	return request.session['gerente_id']
    	else:
    		return redirect('/')