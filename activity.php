<?php
date_default_timezone_set("UTC");


if (count($argv)<3) {
	echo $argv[0]." <login> <inputfiles>\n";
	exit(1);
}

$login=$argv[1];

for($i=2;$i<count($argv);$i++) {
	if (file_exists($argv[2])) {
		$fh = fopen($argv[$i],"r");
		while($l=fgets($fh)) {
			$data = json_decode($l,true);
			if (is_array($data)) {
				if (is_array($data['data'])) {
					foreach($data['data'] as $row) {
						if (preg_match("/".$login."/i", $row['login'])>0)
						{
							
							$d=date("F j, Y G:i:s",intval($row['time']));
							$l=$row['login'];
							$logins[$l]++;
							echo "$d ".$row['login']." > ".$row['url']."\n";
						}
						// print_r($row);
					}
				}
			}
		}
		fclose($fh); 
	} else {
		echo "Warning: File {$argv[2]} does not exist\n";
	}
}


echo "Found ".count($logins)." different logins\n";


