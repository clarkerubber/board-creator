<?php

/* A positions string is defined as following:
White King 		= K
White Queen 	= Q
White Rook 		= R
White Bishop 	= B
White Knight 	= N
White Pawn 		= P

Black King		= k
Black Queen 	= q
Black Rook 		= r
Black Bishop 	= b
Black Knight 	= k
Black Pawn 		= p

From the top left of the board to the bottom right, the string is
either the pieces letter, or a dask (-), for example, the starting
position would be:

rnbqkbnrpppppppp--------------------------------PPPPPPPPRNBQKBNR

*/

header("Content-type: image/png");
$position = $_GET['p'];
$board = imagecreatefrompng("images/board.png");
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

$position = str_split($position, 8);

foreach ($position as $key => $value) {
	$position[$key] = str_split($value);
}

for ( $x = 0; $x < 8; $x++ ) {
	for ( $y = 0; $y < 8; $y++ ) {
		if ( $position[$x][$y] !== '-' && isset( $pieces[$position[$x][$y]] ) ) {
			imagecopy( $board, $pieces[$position[$x][$y]], 50*$y, 50*$x, 0, 0, 50, 50 );
		}
	}
}

imagepng($board);
imagedestroy($board);