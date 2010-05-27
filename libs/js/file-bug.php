<?php

$js_root        = dirname(  __FILE__ ) . "/";

include( $js_root . "../../conf/site.php" );
include( $js_root . "../../libs/php/globals.php" );


header( "Content-type: text/javascript" );

$PROJECT_FINDER = $SITE_PREFIX . "validate-project.php";

$SCRIPT= <<<EOF
function validate() {
	tex = $('#project').val();
	$.getJSON("$PROJECT_FINDER?p=" + tex,function(data){
EOF;

$SCRIPT .= "
		if ( data.success ) {
			$('#project-ok').html('<img src = \"" . $SITE_PREFIX . "imgs/ok.png\" alt = \"\" />');
			$('#project').addClass(\"ok\");
			$('#project-descr').html( data.descr );
		} else {
			$('#project-ok').html('<img src = \"" . $SITE_PREFIX . "imgs/no.png\" alt = \"\" />');
			$('#project').removeClass(\"ok\");
			$('#project-descr').html( \"Did you mean: \" + data.bestmatch + \"?\" );
		}
";

$SCRIPT .= <<<EOF
	});
}
window.onload = function(){
	$('#project').keyup(function(event) {	
		validate();
	});
}
EOF;

echo $SCRIPT;

?>
