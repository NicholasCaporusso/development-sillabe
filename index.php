<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		
		<title>Cerca sillabe</title>
	</head>
	<body>
		<div class="container">
			<h1>Cerca sillabe</h1>
			<form method="POST">
				<div class="mb-3">
					<label class="form-label">Sillaba</label>
					<input type="text" class="form-control" name="sillaba">
				</div>
				<button type="submit" class="btn btn-primary">Cerca</button>
			</form>
		<?php
			if(isset($_POST['sillaba'][0])){
				echo '<h3 class="mt-5">Parole</h3>';
				$sillaba=trim($_POST['sillaba']);
				$words=str_replace('<?php die()?>','',file_get_contents('sillabe.txt.php'));
				preg_match_all('/([\r\n]'.$sillaba.'-[^\r\n]+|[^\r\n]+-'.$sillaba.'-[^\r\n]+|[^\r\n]+-'.$sillaba.'[\r\n])/',$words,$out);
				//print_r($out);
				if(isset($out[0]) && count($out[0])>0){
					echo '<table class="table table-striped">';
					foreach($out[0] as $word) echo '<tr><td>'.$word.'</td></tr>';
					echo '</table>';
				}else{
					echo '<p>Nessuna parola trovata. Inserisci una parola</p>
					<form method="POST">
						<div class="mb-3">
							<label class="form-label">Parola sillabata</label>
							<input type="text" class="form-control" name="parola">
						</div>
						<button type="submit" class="btn btn-primary">Inserisci</button>
					</form>';
				}
			}elseif(isset($_POST['parola'][0])){
				$h=fopen('sillabe.txt.php','a');
				fwrite($h,$_POST['parola'].PHP_EOL);
				fclose($h);
			}
		?>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	</body>
</html>