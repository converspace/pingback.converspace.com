<!DOCTYPE html>
<html>
	<head>
	<title>Activity Pingback</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">

	<form action="" method="post">

		<legend>Activity Pingback</legend>

		<div class="well well-small">
		This is an <a href="https://github.com/converspace/pingback.converspace.com">open-source</a> hosted service for manually sending <a href="http://activitypingback.org/">Activity Pingbacks</a>.</div>

		<label for="source">Actor URL</label>
		<input class="input-xlarge" type="text" name='actor' id="actor" placeholder="" value="http://<?php echo $endpoint_host ?>/test/actor">
		<span class="help-block">URL of the entity that performed the activity</span>

		<label for="target">Activity ID</label>
		<input class="input-xlarge" type="text" name='activityid' id="activityid" placeholder="" value="http://<?php echo $endpoint_host ?>/test/activity">
		<span class="help-block">The permanent, universally unique identifier of the activity</span>

		<label for="target">Object URL</label>
		<input class="input-xlarge" type="text" name='object' id="object" placeholder="" value="http://<?php echo $endpoint_host ?>/test/object">
		<span class="help-block">URL of the object of the activity</span>

		<button type="submit" class="btn btn-primary">Send</button>

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