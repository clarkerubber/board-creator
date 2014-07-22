<?php

function createBoard ( $p = 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR', $s = 'w', $lastmove = '', $board = 'blue2') {
	header("Content-type: image/png");
	$board = imagecreatefrompng("images/boards/$board.png");
	$move = imagecreatefrompng("images/last.png");
	$pieces = array(
		'K' => imagecreatefrompng("images/wk.png"),
		'Q' => imagecreatefrompng("images/wq.png"),
		'R' => imagecreatefrompng("images/wr.png"),
		'B' => imagecreatefrompng("images/wb.png"),
		'N' => imagecreatefrompng("images/wn.png"),
		'P' => imagecreatefrompng("images/wp.png"),
		'k' => imagecreatefrompng("images/k.png"),
		'q' => imagecreatefrompng("images/q.png"),
		'r' => imagecreatefrompng("images/r.png"),
		'b' => imagecreatefrompng("images/b.png"),
		'n' => imagecreatefrompng("images/n.png"),
		'p' => imagecreatefrompng("images/p.png")
		);

	$a_to_n = array(
		'a' => 0,
		'b' => 1,
		'c' => 2,
		'd' => 3,
		'e' => 4,
		'f' => 5,
		'g' => 6,
		'h' => 7
		);

	if ( strlen( $lastmove ) == 4 ) {
		$lastmove = str_split( $lastmove );
		if ( $s == 'w' ) {
			imagecopy( $board, $move, 50*($a_to_n[$lastmove[0]]), 50*(8-$lastmove[1]), 0, 0, 50, 50 );
			imagecopy( $board, $move, 50*($a_to_n[$lastmove[2]]), 50*(8-$lastmove[3]), 0, 0, 50, 50 );
		} else {
			imagecopy( $board, $move, 50*(7-$a_to_n[$lastmove[0]]), 50*($lastmove[1]-1), 0, 0, 50, 50 );
			imagecopy( $board, $move, 50*(7-$a_to_n[$lastmove[2]]), 50*($lastmove[3]-1), 0, 0, 50, 50 );
		}
	}

	$position = explode('/', $p);

	if ( $s == 'b' ) {
		foreach ( $position as $key => $rank ) {
			$position[7-$key] = array_reverse( str_split ($rank) );
		}
	} else {
		foreach ( $position as $key => $rank ) {
			$position[$key] = str_split ($rank);
		}
	}

	foreach ( $position as $number => $rank ) {
		$row = 0;
		foreach ( $rank as $square ) {
			if ( intval( $square ) > 0 ) {
				$row += intval( $square );
			} else {
				imagecopy( $board, $pieces[$square], 50*$row, 50*$number, 0, 0, 50, 50 );
				$row++;
			}
		}
	}

	imagepng($board);
	imagedestroy($board);
}

createBoard($argv[1], $argv[2], $argv[3]);
