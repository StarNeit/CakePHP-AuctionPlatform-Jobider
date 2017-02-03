<?php
	function SinceDate($timebyminuites)
{

$to_time = strtotime(date('Y-m-d H:i:s'));
$from_time = $timebyminuites*60;
return date('Y-m-d H:i:s',round(abs($to_time - $from_time),2));
}
?>
