<!DOCTYPE html>
<html>
	<head>
	<title>Activity Pingback</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">

<div class="page-header">
  <h1><small><a href="https://github.com/converspace/pingback.converspace.com">Open-source</a> hosted <a href="http://activitypingback.org/">Activity Pingback</a> proxy</small></h1>
</div>

<p>
<a href="<?php echo $result['object']['url'] ?>">Object</a>'s Activity Pingback Endpoint: <code><?php echo (false === $result['object']['endpoint']) ? 'Not Found' : htmlentities($result['object']['endpoint']) ?></code>
</p>

<p>
<a href="<?php echo $result['actor']['url'] ?>">Actor</a>'s Activity Pingback Endpoint: <code><?php echo (false === $result['actor']['endpoint']) ? 'Not Found' : htmlentities($result['actor']['endpoint']) ?></code>
</p>

<p>
<a href="<?php echo $result['activityid'] ?>">Activity</a> returned by the <a href="<?php echo $result['actor']['url'] ?>">Actor</a>'s website:
<pre>
<?php echo $result['activity']['json'] ?>
</pre>
</p>

<p>
Activity Stream entry on <a href="<?php echo $result['object']['url'] ?>">Object</a>'s website:
<div class="well well-small">
<?php echo "<a href='{$result['activity']['php']['actor']['url']}'>{$result['activity']['php']['actor']['displayName']}</a> <a href='{$result['activity']['php']['id']}'>{$result['activity']['php']['verb']}d</a> <a href='{$result['activity']['php']['object']['url']}'>{$result['activity']['php']['object']['displayName']}</a>"  ?>
</div>
</p>

<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</div>
</body>
</html>