<?php
	function newPhoto( $name, $x, $y ) {
		$ret['name'] = $name;
		$ret['x']    = $x;
		$ret['y']    = $y;
		return $ret;
	}

	function appendPhoto( $src, $name, $x, $y ) {
		array_push(
			$src,
			newPhoto(
				$name,
				$x,
				$y
			)
		);
		return $src;
	}

	function prefixPhoto( $src, $name, $x, $y ) {
		array_unshift(
			$src,
			newPhoto(
				$name,
				$x,
				$y
			)
		);
		return $src;
	}

	$phplib_root = dirname(__FILE__) . "/";

	include( $phplib_root . "core.php"    );
	include( $phplib_root . "globals.php" );

	include( $phplib_root . "../../model/user.php" );
	
	$img_root = $phplib_root . "../../";
	
	$ids = explode( ".", $_GET['p'] );
	if ( isset ( $ids[1] ) ) {
		$type = $ids[1];
	} else {
		$type = "png";
	}
	if ( isset ( $ids[0]  ) ) {
		$name = clean( $ids[0] );
	} else {
		$name = "";
	}

	if ( isset($name) && $name != "" ) {

		$uID = $name;
		$USER_OBJECT->getByCol( "username", $uID );

		$user = $USER_OBJECT->getNext();

		$rights = getRights( $user['uID'] );
		
		
				$sourcePhotos = array();
		$loadedPhotos = array();

		$sourcePhotos = appendPhoto(
			$sourcePhotos,
			$img_root . "./imgs/crest-data/crest.png",
			100,
			100
		);

		if ( $rights['banned'] ) {
			$sourcePhotos = prefixPhoto(
				$sourcePhotos,
				$img_root . "./imgs/crest-data/bg-banned.png",
				0,
				0
			);
		} else if ( $rights['admin'] ) {
			$sourcePhotos = prefixPhoto(
				$sourcePhotos,
				$img_root . "./imgs/crest-data/bg-root.png",
				0,
				0
			);
		} else if ( $rights['staff'] ) {
			$sourcePhotos = prefixPhoto(
				$sourcePhotos,
				$img_root . "./imgs/crest-data/bg-staff.png",
				0,
				0
			);
		} else if ( $rights['modi'] ) {
			$sourcePhotos = prefixPhoto(
				$sourcePhotos,
				$img_root . "./imgs/crest-data/bg-modi.png",
				0,
				0
			);
		} else if ( $rights['member'] ) {
			$sourcePhotos = prefixPhoto(
				$sourcePhotos,
				$img_root . "./imgs/crest-data/bg-member.png",
				0,
				0
			);
		} else {
			$sourcePhotos = prefixPhoto(
				$sourcePhotos,
				$img_root . "./imgs/crest-data/bg-default.png",
				0,
				0
			);
		}

		if ( isset ( $u['gpg'] ) ) {
			$sourcePhotos = appendPhoto(
				$sourcePhotos,
				$img_root . "./imgs/crest-data/paw.png",
				110,
				110
			);
		}

		for ( $i = 0; $i < sizeof( $sourcePhotos ); $i++ ) {
			$photo = imagecreatefrompng(
				$sourcePhotos[$i]['name']
			);
			array_push(
				$loadedPhotos,
				newPhoto(
					$photo,
					$sourcePhotos[$i]['x'],
					$sourcePhotos[$i]['y']
				)
			);
		}
		$iOut = imagecreatetruecolor("350","400");
		$bg_c = imagecolorallocate($iOut, 255, 255, 255);
		imagefilledrectangle($iOut, 0, 0, 350, 400, $bg_c);
		for ( $i = 0; $i < sizeof( $loadedPhotos ); $i++ ) {
			imagecopy (
				$iOut,
				$loadedPhotos[$i]['name'],
				$loadedPhotos[$i]['x'],
				$loadedPhotos[$i]['y'],
				0,
				0,
				imagesx(
					$loadedPhotos[$i]['name']
				),
				imagesy(
					$loadedPhotos[$i]['name']
				)
			);
			imagedestroy ($loadedPhotos[$i]['name']);
		}
		switch ( $type ) {
			case 'png':
				header ("Content-type: image/png");
				imagepng($iOut);
				break;
			case 'jpeg':
			case 'jpg':
				header ("Content-type: image/jpeg");
				imagejpeg($iOut);
			default:
				echo "Error. Bad Extention";
				break;
		}
		
	}

?>
