<!DOCTYPE HTML>
<head>
	<title> DNA </title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="dna.png">

	<!-- Include css file -->
	<link rel="stylesheet" href="styles.css">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Prompt:400,500,600" rel="stylesheet">

</head>
<style>
	* {
		margin: 0;
	}

	body {
		margin: 3vh 1.5vw 0 1.5vw;
 		background-color: #31353D;
 		color: #EEEFF7;
 		font-size: 11px;
 		font-family: 'Courier New', 'Prompt', sans-serif;
 	}

 	hr {
 		margin: 10px 0 10px 0;
 	}

 	.form-head {
 		font-size: 17px;
 	}

 	.form-span {
 		display: inline;
 		position: static;
 		font-size: 12px;
 		height: 10vh;
 		width: 20vw;

 		padding-left: 0;
 		padding-right: 0;
 	}

 	.form-input {
 		display: inline;
 		position: static;
 		width: 80vw;
 	}

 	.form-input input {
 		color: #000;
 		font-size: 11px;
 	}

 	.form-container input {
 		color: #000;
 		font-size: 12px;
 	}

 	.form-input textarea {
	    width: 50vw;
	    height: 20vh;
	    padding: 1px;
	    box-sizing: border-box;
	    border: 2px solid #222;
	    background-color: #eaeaea;
	    resize: none;
	}

	.output-container .running {
 		display: block;
 		word-wrap: break-word;
 		width: inherit;
 		height: auto;
 	}

 	.running .linear {
 		display: block;
 	}

 	.running .linear .line {
 		width: 10vw;
 		display: block;
 	}

 	.running .linear .output {
 		width: 88vw;
 		display: block;
 		word-wrap: break-word;
 		margin-bottom: 10px;
 	}

 	.running .linear ._code {
 		display: inline-block;
 		padding-right: 0vw;
 		width: 45vw;
 		border-right: #FFF solid 1px;
 	}

 	.running .linear ._sort {
 		display: inline-block;
 		width: 45vw;
 	}


 	.running .image {
 		text-align: center;
 	}

</style>
<?php
	$have_nucl = false;
	if(!empty($_POST['nucl'])) {
		$have_nucl = true;
	}

	$have_enzyme = false;
	if(isset($_POST['enzyme']) && !empty($_POST['enzyme'])) {
		$have_enzyme = true;
	}
?>
<body>
	<div class="wrapper" id="wrapper">
	</div>

	<div class="form-container" id="form">
		<div class="form-head">
			RESTRICTION ENDONUCLEASE
		</div>
		<hr>
		<form id="foo" action="#" method="POST">
			<div class="form-span">Nucleotide</div><br>
			<div class="form-input">
				<textarea form="foo" id="nucl" name="nucl" style="height: 20vh; width: 30vw"><?php if($have_nucl){echo $_POST['nucl'];}?></textarea>
			</div>
			<br>
			<?php
				if($have_nucl) {
					echo "<div class=\"form-span\">Restriction enzyme</div>
						  <div class=\"form-input\" id=\"enzyme\">
							  <input type=\"checkbox\" name=\"enzyme[]\" value=\"enzyme1\" id=\"BamHI\" ".(isset($_POST['enzyme']) ? (in_array('enzyme1', $_POST['enzyme']) ? "checked" : "") : "")."/> <span style=\"background-color: #5c5cd6;color:#000;font-size:12px;\">BamHI</span>
							  <input type=\"checkbox\" name=\"enzyme[]\" value=\"enzyme2\" id=\"EcoRI\" ".(isset($_POST['enzyme']) ? (in_array('enzyme2', $_POST['enzyme']) ? "checked" : "") : "")."/> <span style=\"background-color: #ff4d4d;color:#000;font-size:12px;\">EcoRI</span>
							  <input type=\"checkbox\" name=\"enzyme[]\" value=\"enzyme3\" id=\"HaeIII\" ".(isset($_POST['enzyme']) ? (in_array('enzyme3', $_POST['enzyme']) ? "checked" : "") : "")."/> <span style=\"background-color: #ffdb4d;color:#000;font-size:12px;\">HaeIII</span>
							  <input type=\"checkbox\" name=\"enzyme[]\" value=\"enzyme4\" id=\"HindIII\" ".(isset($_POST['enzyme']) ? (in_array('enzyme4', $_POST['enzyme']) ? "checked" : "") : "")."/> <span style=\"background-color: #47d147;color:#000;font-size:12px;\">HindIII</span>
							  <input type=\"checkbox\" name=\"enzyme[]\" value=\"enzyme5\" id=\"SalI\" ".(isset($_POST['enzyme']) ? (in_array('enzyme5', $_POST['enzyme']) ? "checked" : "") : "")."/> <span style=\"background-color: #e67300;color:#000;font-size:12px;\">SalI</span>
							  <input type=\"checkbox\" name=\"enzyme[]\" value=\"enzyme6\" id=\"PstI\" ".(isset($_POST['enzyme']) ? (in_array('enzyme6', $_POST['enzyme']) ? "checked" : "") : "")."/> <span style=\"background-color: #ff33ff;color:#000;font-size:12px;\">PstI</span>
						  </div>
						 ";
				}
			?>
			<br>
			<input style="font-size: 13px" type="submit" value="Submit">
		</form>
	</div>
	<hr>
	<div class="output-container" id="output">
		<div class="running">
			<div class="codon">
				<?php
					if($have_nucl && $have_enzyme) {
						$line_dna = $_POST['nucl'];
						$line_dna = preg_replace("/[^A-Za-z0-9]/", "", $line_dna);
						$line_dna = str_replace(array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0'), '', $line_dna);

						$disp_dna = $line_dna;
						if(in_array('enzyme1', $_POST['enzyme'])) {
						    $keyword = "ggatcc";
						    $disp_dna = preg_replace("/($keyword)/i","<b style=\"background-color:#5c5cd6;color:#000\">$0</b>", $disp_dna);
						    $line_dna = str_replace($keyword, 'g|gatcc', $line_dna);
						}
						if(in_array('enzyme2', $_POST['enzyme'])) {
						    $keyword = "gaattc";
						    $disp_dna = preg_replace("/($keyword)/i","<b style=\"background-color:#ff4d4d;color:#000\">$0</b>", $disp_dna);
						    $line_dna = str_replace($keyword, 'g|aattc', $line_dna);
						}
						if(in_array('enzyme3', $_POST['enzyme'])) {
						    $keyword = "ggcc";
						    $disp_dna = preg_replace("/($keyword)/i","<b style=\"background-color:#ffdb4d;color:#000\">$0</b>", $disp_dna);
						    $line_dna = str_replace($keyword, 'gg|cc', $line_dna);
						}
						if(in_array('enzyme4', $_POST['enzyme'])) {
						    $keyword = "aagctt";
						    $disp_dna = preg_replace("/($keyword)/i","<b style=\"background-color:#47d147;color:#000\">$0</b>", $disp_dna);
						    $line_dna = str_replace($keyword, 'a|agctt', $line_dna);
						}
						if(in_array('enzyme5', $_POST['enzyme'])) {
						    $keyword = "gtcgac";
						    $disp_dna = preg_replace("/($keyword)/i","<b style=\"background-color:#e67300;color:#000\">$0</b>", $disp_dna);
						    $line_dna = str_replace($keyword, 'g|tcgac', $line_dna);
						}
						if(in_array('enzyme6', $_POST['enzyme'])) {
						    $keyword = "ctgcag";
						    $disp_dna = preg_replace("/($keyword)/i","<b style=\"background-color:#ff33ff;color:#000\">$0</b>", $disp_dna);
						    $line_dna = str_replace($keyword, 'ctgca|g', $line_dna);
						}
						echo $disp_dna."<br>";
					}
				?>
			</div>
			<?php if($have_nucl && $have_enzyme) {echo "<hr>";}?>
			<div class="linear">
				<div class="_code">
				<?php
					if($have_nucl && $have_enzyme) {
						$lengths = array();
	 					$linears = explode("|", $line_dna);
						$counter = 1;
						echo "<b style=\"text-decoration: underline;\">Cutting</b>";
						foreach($linears as $key => $value) {
							$value = str_replace(' ', '', $value);
							echo "<div class=\"line\">Line ".($key+1)." : ".strlen($value)."</div>";
							array_push($lengths, strlen($value));
						}
					}
				?>
				</div>
				<div class="_sort">
				<?php
					if($have_nucl && $have_enzyme) {
						$_sorting_codon = array();
						
						sort($lengths);
						echo "<b style=\"text-decoration: underline;\">Sorting</b>";
						foreach($lengths as $key => $value) {
							echo "<div class=\"line\">Line ".($key+1)." : ".$value."</div>";
						}
					}
				?>
				</div>
			</div>
			<?php if($have_nucl && $have_enzyme) {echo "<hr>";}?>
			<div class="image">
				<?php
					if($have_nucl && $have_enzyme) {
						$d = date("U_m_d_y");
						$_size = 1;
						$_width = (($lengths[sizeof($lengths)-1]+15)/2);
						$_height = ($lengths[sizeof($lengths)-1]+15) * $_size;

						echo "<img src=image/image_".$d.".png>";
						$image = ImageCreate($_width, $_height);
						$background_color = imagecolorallocate($image, 0, 0, 0);
						$red = ImageColorAllocate($image, 255, 0, 0);                  
						$blue = ImageColorAllocate($image, 0, 0, 255);
						$green = ImageColorAllocate($image, 0, 255, 0); 

						//*** line ***//
						$counter = 0;
						foreach($lengths as $key => $value) {
							//ImageLine($image, x1, y1, x2, y2, ($color) ImageColorAllocate);
							if($key+1 < sizeof($lengths)) {
								if($lengths[$key+1] == $value) {
									$counter += 1;
									continue;
								} else {
									$counter = 0;
								}
							}
							ImageLine($image, 15, ($value*$_size)+5, $_width-15, ($value*$_size)+5, ImageColorAllocate($image, 0, (255-($counter*30)), 0));
							//ImageFilledrectangle($image, 15, ($value*$_size)+5, $_width-15, ($value*$_size)+5, ImageColorAllocate($image, (255-($counter*25)), 0, 0));
						}

						/** Box **
						ImageRectangle ($im,5,10,250,50,$red);
						ImageFilledrectangle ($im,5,100,250,140,$blue);
						*/
						ImagePng($image,"image/image_".$d.".png");
						imageDestroy($image);
					}
				?>
			</div>
			<?php if($have_nucl && $have_enzyme) {echo "<hr>";}?>
		</div>
	</div>
	<div class="footer" style="padding-bottom: 10px; text-align: right">
		-- Woramat Ngamkham
	</div>
	
	<!-- Jquery -->
	<script src="core/jquery-3.2.1.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="core/bootstrap/js/bootstrap.min.js"></script>
</body>