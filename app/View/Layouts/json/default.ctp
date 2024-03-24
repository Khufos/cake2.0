<?php
	header('Content-type: application/json');
	header("X-JSON: ".$this->fetch('content'));
	
	echo $this->fetch('content');
?>