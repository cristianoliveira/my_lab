$(document).ready(function() {

	// aumentando a fonte
	$(".inc-font").click(function () {
		var size = $("alinha_texto_empresa").css('font-size');

		size = size.replace('px', '');
		size = parseInt(size) + 1.4;

		$("alinha_texto_empresa").animate({'font-size' : size + 'px'});
	});

	//diminuindo a fonte
	$(".dec-font").click(function () {
		var size = $("alinha_texto_empresa").css('font-size');

		size = size.replace('px', '');
		size = parseInt(size) - 1.4;

		$("alinha_texto_empresa").animate({'font-size' : size + 'px'});
	});

	// resetando a fonte
	$(".res-font").click(function () {
		$("alinha_texto_empresa").animate({'font-size' : '10px'});
	});

});