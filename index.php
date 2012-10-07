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

		$source = $req['form']['source'];
		$target = $req['form']['target'];

		$endpoint = activity_pingback_discover_endpoint($target);

		//return "Discovered endpoint: $endpoint";

		if (!preg_match('#(http://)?pingback.converspace.com/?#', 'pingback.converspace.com/'))
		{
			activity_pingback_notify($endpoint, $source, $target);
		}
		else
		{
			return activity_pingback_get_and_validate_activity($source);
		}


	});

		function activity_pingback_discover_endpoint($target)
		{
			//TODO: try/catch
			$response = http\request("GET $target", '', '', array(), $response_headers);

			$link_header_regex = '#<([^"]+)>; rel="http://activitypingback.org/"#';
			$link_header = isset($response_headers['link']) ? $response_headers['link'] : NULL;
			if (preg_match($link_header_regex, $link_header, $matches))
			{
				return $matches[1];
			}

			$link_element_regex = '#<link href="([^"]+)" rel="http://activitypingback.org/" ?/?/>#';
			if (preg_match($link_element_regex, $response, $matches))
			{
				return $matches[1];
			}

			return false;
		}

		function activity_pingback_notify($endpoint, $source, $target)
		{
			//TODO: try/catch
			//TODO: Check for 201 response
			http\request("POST $endpoint", '', compact('source', 'target'));
		}

		function activity_pingback_get_and_validate_activity($source)
		{
			//TODO: try/catch
			$response = http\request("GET $source", '', '', array(), $response_headers);
			return $response;

		}


	app\get('/test/resource', function() {

		return app\response
		(
			template\render('test-resource.html'),
			200,
			array('Link'=>'<http://pingback.converspace.com/>; rel="http://activitypingback.org/"')
		);
	});


	app\get('/test/activity', function () {

		return app\response
		(
			template\render('test-activity.json'),
			200,
			array('Content-Type'=>'application/stream+json')
		);
	});


	app\get('/activities/for/{object}', function () {

		return 'Coming Soon...';
	});


	app\get('/activities/by/{object}', function () {

		return 'Coming Soon...';
	});


?>