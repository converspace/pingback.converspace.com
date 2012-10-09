<?php

	require __DIR__.'/vendor/phpish/app/app.php';
	require __DIR__.'/vendor/phpish/template/template.php';
	require __DIR__.'/vendor/phpish/http/http.php';

	use phpish\app;
	use phpish\template;
	use phpish\http;

	define('ENDPOINT_HOST', 'pingback.converspace.com');


	app\get('/', function() {

		return template\render('index.html', array('endpoint_host'=>ENDPOINT_HOST));
	});

	app\post('/', function ($req) {

		$actor = $req['form']['actor'];
		$activityid = $req['form']['activityid'];
		$object = $req['form']['object'];

		$endpoint = activity_pingback_discover_endpoint($object);

		if (!preg_match('#^(http://)?'.ENDPOINT_HOST.'/?$#', $endpoint))
		{
			activity_pingback_notify($endpoint, $actor, $activityid, $object);
			return "Activity Pingback sent.";
		}
		else
		{
			if (activity_pingback_get_and_validate_activity($actor, $activityid, $object))
			{
				return "Finished all steps of Activity Pingback.";
			}
		}

		return app\response_500('There was an error');

	});

		function activity_pingback_discover_endpoint($resource)
		{
			//TODO: try/catch
			$response = http\request("GET $resource", '', '', array(), $response_headers);

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

		function activity_pingback_notify($endpoint, $actor, $activityid, $object)
		{
			//TODO: try/catch
			//TODO: Check for 201 response
			http\request("POST $endpoint", '', compact('actor', 'activityid', 'object'));
		}

		function activity_pingback_get_and_validate_activity($actor, $activityid, $object)
		{
			//TODO: try/catch
			$endpoint = activity_pingback_discover_endpoint($actor);

			if (!preg_match('#^(http://)?'.ENDPOINT_HOST.'/?$#', $endpoint))
			{
				$response = http\request("GET $endpoint", compact('actor', 'activityid', 'object'));

				$activity = json_decode($response, true);

				return  (($activity['actor']['url'] == $actor) and
						 ($activity['id'] == $activityid) and
						 ($activity['object']['url'] == $object)) ? $activity : false;
			}

			return false;
		}


	app\get('/test/actor', function() {

		return app\response
		(
			template\render('test-actor.html', array('endpoint_host'=>ENDPOINT_HOST)),
			200,
			array('Link'=>'<http://'.ENDPOINT_HOST.'/test/endpoint>; rel="http://activitypingback.org/"')
		);
	});


	app\get('/test/object', function() {

		return app\response
		(
			template\render('test-object.html', array('endpoint_host'=>ENDPOINT_HOST)),
			200,
			array('Link'=>'<http://'.ENDPOINT_HOST.'/>; rel="http://activitypingback.org/"')
		);
	});

	app\query('/test/endpoint', function ($req) {

		if (preg_match('#^(http://)?'.ENDPOINT_HOST.'/test/actor/?$#', $req['query']['actor']) and
			preg_match('#^(http://)?'.ENDPOINT_HOST.'/test/activity/?$#', $req['query']['activityid']) and
			preg_match('#^(http://)?'.ENDPOINT_HOST.'/test/object/?$#', $req['query']['object']))
		{
			return app\response
			(
				template\render('test-activity.json', array('endpoint_host'=>ENDPOINT_HOST)),
				200,
				array('Content-Type'=>'application/stream+json')
			);
		}
	});


	app\get('/test/activity', function ($req) {

		return app\response
		(
			template\render('test-activity.json', array('endpoint_host'=>ENDPOINT_HOST)),
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