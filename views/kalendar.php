<html>
<head>
	<title></title>
	<style type="text/css">
div{	
	-moz-border-radius-topleft: 4px; -webkit-border-top-left-radius: 4px; -khtml-border-top-left-radius: 4px; border-top-left-radius: 4px;
	-moz-border-radius-topright: 4px; -webkit-border-top-right-radius: 4px; -khtml-border-top-right-radius: 4px; border-top-right-radius: 4px;
	-moz-border-radius-bottomleft: 4px; -webkit-border-bottom-left-radius: 4px; -khtml-border-bottom-left-radius: 4px; border-bottom-left-radius: 4px;
	-moz-border-radius-bottomright: 4px; -webkit-border-bottom-right-radius: 4px; -khtml-border-bottom-right-radius: 4px; border-bottom-right-radius: 4px;
}

.hari{
	float:left;
	padding:2px;
	width:50px;
	text-align:center;
	margin:2px;
	background:#165395;
	color: #fff;
	
/*background-image:-webkit-linear-gradient(top,#ffffff 0%,#218b04 100%);
background-image:-moz-linear-gradient(top,#ffffff 0%,#218b04 100%);
background-image:-o-linear-gradient(top,#ffffff 0%,#218b04 100%);
background-image:-ms-linear-gradient(top,#ffffff 0%,#218b04 100%);
background-image:linear-gradient(top,#ffffff 0%,#218b04 100%); */

}
.tgl{
	float:left;
	padding:2px;
	width:50px;
	text-align:center;
	margin:2px;
	background:#CCC;
	
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), color-stop(25%, #ffffff), to(#e6e6e6));
  background-image: -webkit-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);
  background-image: -moz-linear-gradient(top, #ffffff, #ffffff 25%, #e6e6e6);
  background-image: -ms-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);
  background-image: -o-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);
  background-image: linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);
}
.tgl:hover{
	  background-image: -khtml-gradient(linear, left top, left bottom, from(#049cdb), to(#0064cd));
  background-image: -moz-linear-gradient(top, #049cdb, #0064cd);
  background-image: -ms-linear-gradient(top, #049cdb, #0064cd);
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #049cdb), color-stop(100%, #0064cd));
  background-image: -webkit-linear-gradient(top, #049cdb, #0064cd);
  background-image: -o-linear-gradient(top, #049cdb, #0064cd);
  background-image: linear-gradient(top, #049cdb, #0064cd);
  color:#FFF;
}
.float_habis{
	padding:1px;
	text-align:center;
}
.tgl_blank{
	float:left;
	padding:px;
	width:50px;
	text-align:center;
	margin:2px;
	background:#F8F8F8;
	color:#CCC;
}
.tgl_skrng{
	float:left;
	padding:2px;
	width:50px;
	text-align:center;
	margin:2px;
	background:#FC0;
}
.blokbaris{
	padding:5px;
	text-align:center;
	margin:2px;
}

</style>

</head>
<body>

<?php
	$now = getdate(time());
	$time = mktime(0,0,0, $now['mon'], 1, $now['year']);
	$date = getdate($time);
	$dayTotal = cal_days_in_month(0, $date['mon'], $date['year']);
	//Print the calendar header with the month name.
	print '<br><br>';
	print '<center><h4 style=color:#000;>' . $date['month'] .'</h4></center>';
	
	print '<div class=blokbaris>';
	$hari=array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
	for ($i = 0; $i < 7; $i++) {	
	print "<div class='hari' style='font-size:11px;'>$hari[$i]</div>";
	}
	print '<div class=float_habis> </div></div>';
	

	for ($i = 0; $i < 6; $i++) {
		print '<div class=blokbaris>';
		for ($j = 1; $j <= 7; $j++) {
			$dayNum = $j + $i*7 - $date['wday'];
			
			print '<div';
			if ($dayNum > 0 && $dayNum <= $dayTotal) {
				print ($dayNum == $now['mday']) ? ' class=tgl_skrng>' : ' class=tgl>';
				print "$dayNum";
			}
			else {
				
				print ' class=tgl_blank> - ';
			}
			print '</div>';
		}
		print '<div class=float_habis> </div></div>';
		if ($dayNum >= $dayTotal && $i != 6)
			break;
	}
?>

</body>
</html>