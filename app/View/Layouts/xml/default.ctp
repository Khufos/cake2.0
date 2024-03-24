<?php
	header('Content-Type: application/xml');

	echo $xml->header();
	echo $xml->elem('comarcas', NULL, $xml->serialize($comarcas));
?>