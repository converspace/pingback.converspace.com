<?php

	require __DIR__.'/vendor/phpish/app/app.php';
	require __DIR__.'/vendor/phpish/template/template.php';
	require __DIR__.'/vendor/phpish/http/http.php';

	use phpish\app;
	use phpish\template;
	use phpish\http;


	app\get('/', function() {
		return template\render('index.html');
	});

	app\post('/', function ($req) {
		//TODO: try/catch
		$response = http\request("GET {$req['form']['target']}", '', '', array(), $response_headers);

		$link_header = $link_header_endpoint = $link_element = $link_element_endpoint = '';

		$link_element_regex = '#<link href="([^"]+)" rel="http://activitypingback.org/" ?/?/>#';
		if (preg_match($link_element_regex, $response, $matches))
		{
			list($link_element, $link_element_endpoint) = $matches;
		}

		$link_header = isset($response_headers['link']) ? $response_headers['link'] : NULL;
		$link_header_regex = '#<([^"]+)>; rel="http://activitypingback.org/"#';
		if (preg_match($link_header_regex, $link_header, $matches))
		{
			list($link_header, $link_header_endpoint) = $matches;
		}


		return "Link header endpoint $link_header_endpoint <br /> Link elements $link_element_endpoint";

	});


	app\get('/test-resource', function() {
		return app\response
		(
			template\render('test-resource.html'),
			200,
			array('Link'=>'<http://pingback.converspace.com/>; rel="http://activitypingback.org/"')
		);
	});


	app\get('/activities/for/{object}', function () {
		return 'Coming Soon...';
	});


	app\get('/activities/by/{object}', function () {
		return 'Coming Soon...';
	});

?>