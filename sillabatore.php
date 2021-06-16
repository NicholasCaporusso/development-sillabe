<?php
set_time_limit(5000000);
$words=str_replace('<?php die()?>','',file_get_contents('parole.txt.php'));
$words=explode(PHP_EOL,$words);
foreach($words as $word){
	$t=file_get_contents('http://www.divisioneinsillabe.it/dividi/'.trim($word));
	$t=explode('div id="res"',$t);
	$t=explode('</div>',$t[1]);
	echo trim(explode('>',$t[0])[1]);
	$h=fopen('output.txt','a+');
	fwrite($h,trim(explode('>',$t[0])[1]).PHP_EOL);
	fclose($h);
	//$out=$word."\t".trim(explode('>',$t[0])[1])
}