<!DOCTYPE html>
<html>
	<head>
	<title>Activity Pingback</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">

	<form action="" method="post">

		<legend>Send Acitivity Pingback</legend>

		<label for="source">Source</label>
		<input class="input-xlarge" type="text" name='source' id="source" placeholder="http://pingback.sender/activity/foobar">
		<span class="help-block">URI of the activity you performed</span>

		<label for="target">Target</label>
		<input class="input-xlarge" type="password" name='target' id="target" placeholder="http://pingback.receiver/referenced-resource">
		<span class="help-block">URI of the object of your activity</span>

		<input type="submit" class="btn btn-primary" name='action' value='Send'>

	</form>

		<div>
			<p>Clicking on send will do the following:
				<ol>
					<li><code>Target</code> will be visited and an attempt will be made to <em>discover</em> an acitivity pingback endpoint.</li>
					<li>If an endpoint is found
						<ul>
							<li>and it turns out that <code>Target</code> is using <code>pingback.converspace.com</code> as its activity pingback endpoint, then it will retrieve the activity from <code>source</code> and valdate it.  All activites for a given resource will be made available at <code>http://pingback.converspace.com/activities/for/{resource}</code> where <code>{resource}</code> is the URI of the resource.</li>
							<li>else it will send an activity pingback to the endpoint.</li>
						</ul>
					</li>
				</ol>
			</p>

			<p>Read the <a href="http://activitypingback.org/">Activity Pingback Specification</a> for more info.</p>
		</div>

<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</div>
</body>
</html>