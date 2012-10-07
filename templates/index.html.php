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
		This is an <a href="https://github.com/converspace/pingback.converspace.com">open-source</a> hosted endpoint for <a href="http://activitypingback.org/">Activity Pingback</a>.</div>

		<label for="source">Source</label>
		<input class="input-xlarge" type="text" name='source' id="source" placeholder="" value="http://pingback.converspace.com/test/activity">
		<span class="help-block">URI of the activity you performed</span>

		<label for="target">Target</label>
		<input class="input-xlarge" type="text" name='target' id="target" placeholder="" value="http://pingback.converspace.com/test/resource">
		<span class="help-block">URI of the object of your activity</span>

		<input type="submit" class="btn btn-primary" name='action' value='Send'>

	</form>

		<div  class="alert alert-info">
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
		</div>

<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</div>
</body>
</html>