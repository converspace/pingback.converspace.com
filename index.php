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


		$result = array();
		$result['actor']['url'] = $actor;
		$result['activityid'] = $activityid;
		$result['object']['url'] = $object;

		$endpoint = activity_pingback_discover_endpoint($object, $result['object']);

		$result['object']['endpoint'] = $endpoint;



		if (!preg_match('#^(http://)?'.ENDPOINT_HOST.'/?$#', $endpoint))
		{
			activity_pingback_notify($endpoint, $actor, $activityid, $object);
			return "Activity Pingback sent.";
		}
		else
		{
			if (activity_pingback_get_and_validate_activity($actor, $activityid, $object, $result))
			{
				return template\render('test.html', compact('result'));
			}
		}

		return app\response_500('There was an error');

	});

		function activity_pingback_discover_endpoint($resource, &$result)
		{
			//TODO: try/catch
			$response = http\request("GET $resource", '', '', array(), $response_headers);

			$result['response'] = $response;
			$result['response_headers'] = $response_headers;

			$link_header_regex = '#<([^"]+)>; rel="http://activitypingback.org/"#';
			$link_header = isset($response_headers['link']) ? $response_headers['link'] : NULL;

			if (preg_match($link_header_regex, $link_header, $matches))
			{
				$result['link_header'] = $matches[0];
				return $matches[1];
			}

			$link_element_regex = '#<link href="([^"]+)" rel="http://activitypingback.org/" ?/?/>#';
			if (preg_match($link_element_regex, $response, $matches))
			{
				$result['link_element'] = $matches[0];
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

		function activity_pingback_get_and_validate_activity($actor, $activityid, $object, &$result)
		{
			//TODO: try/catch
			$endpoint = activity_pingback_discover_endpoint($actor, $result['actor']);

			$result['actor']['endpoint'] = $endpoint;

			if (!preg_match('#^(http://)?'.ENDPOINT_HOST.'/?$#', $endpoint))
			{
				$response = http\request("GET $endpoint", compact('actor', 'activityid', 'object'));
				$result['activity']['json'] = $response;

				$activity = json_decode($response, true);

				$result['activity']['php'] = $activity;

				return  (($activity['actor']['url'] == $actor) and
						 ($activity['id'] == $activityid) and
						 ($activity['object']['url'] == $object)) ? $activity : false;
			}

			return false;
		}


	app\get('/test/alice', function() {

		return app\response
		(
			template\render('test-alice.html', array('endpoint_host'=>ENDPOINT_HOST)),
			200,
			array('Link'=>'<http://'.ENDPOINT_HOST.'/test/alice/endpoint>; rel="http://activitypingback.org/"')
		);
	});


	app\get('/test/bob/post', function() {

		return app\response
		(
			template\render('test-bobs-post.html', array('endpoint_host'=>ENDPOINT_HOST)),
			200,
			array('Link'=>'<http://'.ENDPOINT_HOST.'/>; rel="http://activitypingback.org/"')
		);
	});


	app\query('/test/alice/endpoint', function ($req) {

		if (preg_match('#^(http://)?'.ENDPOINT_HOST.'/test/alice/?$#', $req['query']['actor']) and
			preg_match('#^(http://)?'.ENDPOINT_HOST.'/test/alice/activity/?$#', $req['query']['activityid']) and
			preg_match('#^(http://)?'.ENDPOINT_HOST.'/test/bob/post/?$#', $req['query']['object']))
		{
			return app\response
			(
				template\render('test-alice-activity.json', array('endpoint_host'=>ENDPOINT_HOST)),
				200,
				array('Content-Type'=>'application/stream+json')
			);
		}
	});


	app\get('/test/alice/activity', function ($req) {

		return app\response
		(
			template\render('test-alice-activity.json', array('endpoint_host'=>ENDPOINT_HOST)),
			200,
			array('Content-Type'=>'application/stream+json')
		);
	});

?>