<?php

	require __DIR__.'/vendor/phpish/app/app.php';
	require __DIR__.'/vendor/phpish/template/template.php';

	use phpish\app;
	use phpish\template;


	app\get('/', function() {
		return template\render('index.html');
	});

	app\post('/', function () {
		return "Coming Soon...";
	});


	app\get('/activities/for/{object}', function () {
		return 'Coming Soon...';
	});


	app\get('/activities/by/{object}', function () {
		return 'Coming Soon...';
	});

?>