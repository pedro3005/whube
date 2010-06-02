$(window).load( function() {
	$("#edit-bug").hide();
	$("#edit-bug-control").click( function() {
		$("#edit-bug").show();
	});
	$("#edit-close").click( function() {
		$("#edit-bug").hide();
	});
});
