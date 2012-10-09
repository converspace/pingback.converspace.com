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

<p>
<a href="<?php echo $result['object']['url'] ?>">Object</a>'s Activity Pingback Endpoint: <code><?php echo (false === $result['object']['endpoint']) ? 'Not Found' : htmlentities($result['object']['endpoint']) ?></code>
</p>

<p>
<a href="<?php echo $result['actor']['url'] ?>">Actor</a>'s Activity Pingback Endpoint: <code><?php echo (false === $result['actor']['endpoint']) ? 'Not Found' : htmlentities($result['actor']['endpoint']) ?></code>
</p>

<p>
<a href="<?php echo $result['activityid'] ?>">Activity</a>:
<pre>
<?php echo $result['activity'] ?>
</pre>
</p>

<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</div>
</body>
</html>