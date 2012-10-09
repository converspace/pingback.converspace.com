{
	"published": "2012-10-10T00:00:00Z",
	"actor": {
		"url": "http://<?php echo $endpoint_host ?>/test/alice",
		"displayName": "Alice",
		"objectType": "person"
	},
	"id": "http://<?php echo $endpoint_host ?>/test/alice/activity",
	"verb": "like",
	"object" : {
		"url": "http://<?php echo $endpoint_host ?>/test/bob/post"
	}
}