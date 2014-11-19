<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <script src="js/slides.min.jquery.js"></script>
        <script>
            $(function(){
                // Set starting slide to 1
                var startSlide = 1;
                // Get slide number if it exists
                if (window.location.hash) {
                    startSlide = window.location.hash.replace('#','');
                }
                // Initialize Slides
                $('#slides').slides({
                    preload: true,
                    generatePagination: true,
                    play: 8000,
                    pause: 10500,
                    hoverPause: true,
                    // Get the starting slide
                    start: startSlide
                });
            });
        </script>
        <title>
            Primous Soluções Inteligentes
        </title>
        <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
    </head>
    <body id="body-margim">
        <div id="content">
            <div id="header">
                <h2 id="logo">
                    <a href="http://www.primous.com.br"  ><image src="imagens/logo.png" /></a>
                    Primous Soluções Inteligentes
                </h2>
                <div id="menu">
                    <?php echo $menuItens; ?>
                </div>
            </div>