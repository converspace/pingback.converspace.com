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

	<h3>Sender Proxy</h3>

	<p>You can use <code>pingback.converspace.com</code> to send <a href="http://activitypingback.org/">Activity Pingbacks</a> on your behalf and take advantages of the following:
		<ul>
			<li>Enable your resources to send Activity Pingbacks by simply sending a HTTP <code>POST</code> request. <code>pingback.converspace.com</code> takes care of the implementation steps like discovering the objects Activity Pingback endpoint.</li>
			<li>(<strong>Coming soon...</strong>) If the object of the activity does not support Activity Pingback, and therefore cannot receive them, <code>pingback.converspace.com</code> will <em>receive and save</em> them on it's behalf and make them available at <code>http://pingback.converspace.com/activities/for/{resource}</code> where <code>{resource}</code> is the <code>URL</code> of the object of the activity. If the object supports Activity Pingbacks in the future, <code>pingback.converspace.com</code> will send it all the Activity Pingbacks it has received on its behalf. <strong>For this reason alone it is advisable to use a proxy till widespread adoption is not achieved.</strong>
			</li>
			<li>(<strong>Coming soon...</strong>) If the Activity Pingback endpoint of the object is unavailable, <code>pingback.converspace.com</code> will periodically <em>retry</em> sending the Activity Pingback.
			</li>
		</ul>
	</p>

	<p>
		By delegating these responsiblitles to <code>pingback.converspace.com</code> you can <em>significantly simply</em> your implemenation.
	</p>


	<p>To use <code>pingback.converspace.com</code> to send Activity Pingbacks on your behalf, simply send it a HTTP <code>POST</code> request with <code>Content-Type: application/x-www-url-form-encoded</code> and the following 3 parameters:</p>


<dl>
  <dt>actor</dt>
  <dd>URL of the entity that performed the activity. This is the <em>actor</em> of the activity.</dd>
  <dt>activityid</dt>
  <dd>The permanent, universally unique identifier of the activity</dd>
  <dt>object</dt>
  <dd>URL of the object of the activity</dd>
</dl>

<p>
Example:
<pre>
POST / HTTP/1.1
Host: pingback.converspace.com
Content-Type: application/x-www-url-form-encoded

actor=http://<?php echo $endpoint_host ?>/test/alice&activityid=http://<?php echo $endpoint_host ?>/test/alice/activity&object=http://<?php echo $endpoint_host ?>/test/bob/post
</pre>
</p>

<p>This is the same as submitting the below form:</p>

	<form action="" method="post">
		<div class="alert alert-success">
			Go ahead and give it a spin for an executable illustration of <a href="http://activitypingback.org/">Activity Pingback</a> using the pre-filled test activity: <a href="http://<?php echo $endpoint_host ?>/test/alice">Alice</a> (<code>actor</code>) <a href="http://<?php echo $endpoint_host ?>/test/alice/activity">liked</a> (<code>verb</code>) <a href="http://<?php echo $endpoint_host ?>/test/bob/post">Bob's Post</a> (<code>object</code>)
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

	<hr />

	<h3>Receiver Proxy (<strong>Coming Soon...</strong>)</h3>

<div class="alert">
	<strong>Important note:</strong> Use this only when you want to receive Activity Pingbacks and <strong>do not intend</strong> to send them. It is meant for non-compliant legacy systems and static resources that cannot send Activity Pingbacks, to at least start receving them.
</div>

	<p>To enable <code>pingback.converspace.com</code> to <em>receive</em> <a href="http://activitypingback.org/">Activity Pingbacks</a> on behalf of a resource, it must be set as the Activity Pingback endpoint for that resource using <strong>one or both</strong> of the following methods:</p>

	<ul>
		<li>Serve the resource with the following HTTP <code>Link</code> header:
			<p>
				<pre>Link: &lt;http://pingback.converspace.com/&gt;; rel="http://activitypingback.org/"</pre>
			</p>
		</li>
		<li>Add the following HTML <code>Link</code> tag in the <code>head</code> section of the resource:
			<p>
				<pre>&lt;link href="http://pingback.converspace.com/" rel="http://activitypingback.org/" /&gt;</pre>
			</p>
		</li>
	</ul>

	<p>
		All activites recevied on behalf of the resource will be made available at <code>http://pingback.converspace.com/activities/for/{resource}</code> where <code>{resource}</code> is the URL of the resource.
	</p>

	<div class="alert alert-info">For more information on Activity Pingback visit: <a href="http://activitypingback.org/">http://activitypingback.org/</a></div>

<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</div>
</body>
</html>