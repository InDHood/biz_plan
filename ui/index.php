<?php // echo 1; exit(); ?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Learning Polymer Contacts</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">

	<meta name="theme-color" content="#303F9F">

	<!-- Thanks to https://github.com/geelen/x-gif for the snippet -->
	<script>
		if ('registerElement' in document && 'createShadowRoot' in HTMLElement.prototype && 'import' in document.createElement('link') && 'content' in document.createElement('template')) {
			/* We're using a browser with native WC support! */
		} else {
			document.write('<script src="/components/webcomponentsjs/webcomponents.js"><\/script>');
		}
	</script>

	<!-- build:vulcanized elements/elements.critical.vulcanized.html -->
	<link rel="import" href="/_poly/tmpl/elements/elements.html">
	<link rel="stylesheet" href="/_poly/tmpl/css/css.css">

	<!-- endbuild-->
</head>

<body unresolved>

<template id="app" is="auto-binding">

		
		<more-route-selector>

			<core-animated-pages selected="{{selected}}" transitions="cross-fade-all" fit>
			<!-- <core-pages selected="{{selected}}" fit> -->
					
					<login-page></login-page>

					<main-page></main-page>


			<!-- </core-pages> -->
			</core-animated-pages>

		</more-route-selector>


</template>



	<!-- build:js scripts/app.js -->	
	<!-- <script src="/components/director/build/director.js"></script>
	-->
	<script src="/_poly/tmpl/js/app.js"></script>
	<!-- endbuild-->	


</body>

</html>