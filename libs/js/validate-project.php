<?php

$js_root	= dirname(  __FILE__ ) . "/";

include( $js_root . "../../conf/site.php" );
include( $js_root . "../../libs/php/globals.php" );


header( "Content-type: text/javascript" );

$PROJECT_FINDER = $SITE_PREFIX . "validate-project.php";

$SCRIPT= <<<EOF
var projectLastPressed = new Date();
projectLastPressed.setDate(0);
projectFetch();

function projectHandleLoading() {
	projectLastPressed = new Date();
	projectFetch();
}

function projectFetch() {
	var t = new Date();
	if ( projectLastPressed.getTime() + 800 < t.getTime() ) {
		projectLastPressed = new Date();
		projectValidate();
	} else {
		setTimeout( projectFetch, 10 );
	}
}

function projectValidate() {
	tex = $('#project').val();
	$.getJSON("$PROJECT_FINDER?p=" + tex,function(data){
EOF;

$SCRIPT .= "
		if ( data.success ) {
			$('#project-ok').html('<img src = \"" . $SITE_PREFIX . "imgs/ok.png\" alt = \"\" />');
			$('#project').removeClass(\"meh\");
			$('#project').removeClass(\"shit\");
			$('#project').addClass(\"ok\");
			$('#project-descr').html( data.descr );
		} else {
			$('#project-ok').html('<img src = \"" . $SITE_PREFIX . "imgs/no.png\" alt = \"\" />');
			$('#project').removeClass(\"ok\");
			$('#project').removeClass(\"meh\");
			$('#project').addClass(\"shit\");
			if ( data.bestmatch ) {
				$('#project-descr').html( \"Did you mean: \" + data.bestmatch + \"?\" );
			} else {
				$('#project-descr').html( \"I have no goddamn clue what you are talking about.\" );
			}
		}
	});
}
$(window).load( function() {
	$('#project').keyup(function(event) {
		$('#project-ok').html('<img src = \"" . $SITE_PREFIX . "imgs/loading.png\" alt = \"\" />');
		$('#project').removeClass(\"ok\");
		$('#project').removeClass(\"shit\");
		$('#project').addClass(\"meh\");
		projectHandleLoading();
	});
	projectValidate();
});
";

echo $SCRIPT;

?>
