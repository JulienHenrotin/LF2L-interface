<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../lib/w3.css">
{{--{!! HTML::script('LF2L/public/js/detailProjet.js'); !!}--}}
{{--<script type="text/javascript" src="../../../public/js/detailProjet.js"></script>--}}
<script type="text/javascript" src="{{ URL::asset('js/detailProjet.js') }}"></script>

<body class="w3-container">

<div class="w3-accordion w3-light-grey">
    <button onclick="myFunction('Demo1')" class="w3-btn-block w3-left-align">Accordion</button>
    <div id="Demo1" class="w3-accordion-content w3-animate-zoom">
        <a href="tryit.asp-filename=tryw3css_accordion_animate.html#">Link 1</a>
        <a href="tryit.asp-filename=tryw3css_accordion_animate.html#">Link 2</a>
        <a href="tryit.asp-filename=tryw3css_accordion_animate.html#">Link 3</a>
    </div>
</div>
</body>
</html>