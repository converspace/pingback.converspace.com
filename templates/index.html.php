<!DOCTYPE html>
<html>
	<head>
	<title>Activity Pingback</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">

<div class="page-header">
  <h1><small><a href="https://github.com/converspace/pingback.converspace.com">Open-source</a> executable illustration of the <a href="http://activitypingback.org/">Activity Pingback</a> protocol flow.</small></h1>
</div>

	<form action="" method="post">
		<div class="well well-small">
			Use the form below to test/debug Activity Pingback implementations or just give it a spin with the pre-filled <a href="http://<?php echo $endpoint_host ?>/test/alice/activity">activity</a>: <a href="http://<?php echo $endpoint_host ?>/test/alice">Alice</a> (<code>actor</code>) liked (<code>verb</code>) Bob's <a href="http://<?php echo $endpoint_host ?>/test/bob/post">post</a> (<code>object</code>)
		</div>

		<label for="source">Actor (url):</label>
		<input class="input-xxlarge" type="text" name='actor' id="actor" placeholder="" value="http://<?php echo $endpoint_host ?>/test/alice">
		<!-- <span class="help-block"><small>URL of the entity that performed the activity</small></span> -->

		<label for="target">Activity ID:</label>

		<input class="input-xxlarge" type="text" name='activityid' id="activityid" placeholder="" value="http://<?php echo $endpoint_host ?>/test/alice/activity">
		<!-- <span class="help-block"><small>The permanent, universally unique identifier of the activity</small></span> -->


		<label for="target">Object (url):</label>

		<input class="input-xxlarge" type="text" name='object' id="object" placeholder="" value="http://<?php echo $endpoint_host ?>/test/bob/post">
		<!-- <span class="help-block"><small>URL of the object of the activity</small></span> -->

		<div>
			<button type="submit" class="btn btn-primary">Test</button>
		</div>

	</form>

		<!--div  class="alert alert-info">
			<p>Clicking on send will do the following:
				<ol>
					<li>An attempt will be made to discover the activity pingback endpoint for <code>Target</code>.</li>
					<li>If an endpoint is found
						<ul>
							<li>and it turns out that <code>Target</code> is using <code>pingback.converspace.com</code> as its activity pingback endpoint, then the activity will be retrieved from <code>Source</code> and validated.  All activites for a given resource will be made available at <code>http://pingback.converspace.com/activities/for/{resource}</code> where <code>{resource}</code> is the URI of the resource.</li>
							<li>else, an activity pingback will be sent to the discovered endpoint.</li>
						</ul>
					</li>
				</ol>
			</p>
		</div-->

<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</div>
</body>
</html>