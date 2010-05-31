<?php

$js_root	= dirname(  __FILE__ ) . "/";

include( $js_root . "../../conf/site.php" );
include( $js_root . "../../libs/php/globals.php" );


header( "Content-type: text/javascript" );

$PROJECT_FINDER = $SITE_PREFIX . "validate-project.php";

$SCRIPT= <<<EOF
var lastPressed = new Date();
lastPressed.setDate(0);
fetch();

function handleLoading() {
	lastPressed = new Date();
	fetch();
}

function fetch() {
	var t = new Date();
	if ( lastPressed.getTime() + 800 < t.getTime() ) {
		lastPressed = new Date();
		validate();
	} else {
		setTimeout( fetch, 10 );
	}
}

function validate() {
	tex = $('#project').val();
	$.getJSON("$PROJECT_FINDER?p=" + tex,function(data){
EOF;

$SCRIPT .= "
		if ( data.success ) {
			$('#project-ok').html('<img src = \"" . $SITE_PREFIX . "imgs/ok.png\" alt = \"\" />');
			$('#project').removeClass(\"shit\");
			$('#project').addClass(\"ok\");
			$('#project-descr').html( data.descr );
		} else {
			$('#project-ok').html('<img src = \"" . $SITE_PREFIX . "imgs/no.png\" alt = \"\" />');
			$('#project').removeClass(\"ok\");
			$('#project').addClass(\"shit\");
			if ( data.bestmatch ) {
				$('#project-descr').html( \"Did you mean: \" + data.bestmatch + \"?\" );
			} else {
				$('#project-descr').html( \"I have no goddamn clue what you are talking about.\" );
			}
		}
	});
}
window.onload = function(){
	$('#project').keyup(function(event) {
		$('#project-ok').html('<img src = \"" . $SITE_PREFIX . "imgs/loading.png\" alt = \"\" />');
		handleLoading();
	});
	validate();
}
";

echo $SCRIPT;

?>
