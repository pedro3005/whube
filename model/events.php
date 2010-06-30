<?php
    /*
     *  License:     GPLv3
     *  Author:      Paul Tagliamonte <paultag@ubuntu.com>
     *  Description:
     *    DB OBJ class
     */
if ( ! class_exists ( "events" ) ) {

class events {
	var $folder_root;

	function events() {
		$model_root = dirname(  __FILE__ ) . "/";
		$event_root = $model_root . "../events/";
		$this->folder_root = $event_root;
	}

	function broadcast( $note ) {
		if ($handle = opendir($this->folder_root)) {
			while (false !== ($file = readdir($handle))) {
				// The "i" after the pattern delimiter indicates a case-insensitive search
				if ( $file != "." && $file != ".." ) {
					$ftest = $file;
					if (preg_match("/.*\.hook$/i", $ftest)) {
						$fh = fopen( $this->folder_root . $file, 'w');
						fwrite($fh, $note . "\n");
						fclose($fh);
					}
				}
			}
		}
	}
}

}

?>
