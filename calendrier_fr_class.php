<?php
Class Calendar {
	public function __construct() {
		date_default_timezone_set('Europe/paris');
		setlocale(LC_TIME, "fr_FR");
	}
	public function getCalendar($year) {

		$today = strftime('%e %B %Y');

		if ( isset($year) AND is_numeric(intval($year)) ) {

			$calendar = array();

			for ($i=1; $i<=12; $i++){ 

				$month = mktime(0, 0, 0, $i, 1, $year);
				$month_ok = strftime('%B', $month);

				$day_max = cal_days_in_month(CAL_GREGORIAN, $i, $year);

				$j=1;
				while ($j<=$day_max){
					$day = mktime(0, 0, 0, $i, $j, $year);
					$day_wr = strftime('%e %B %Y', $day);
					if ($today === $day_wr) { 
						$calendar[$month_ok][$j] = '<strong>'.$day_wr.'</strong>';
					}else{ 
						$calendar[$month_ok][$j] = $day_wr ;
					}
					$j++;
				}
				
			}
			return $calendar;
		}
	}
}

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>CALENDRIER</title>
    <style>
    table, th, td {
	    border: 1px solid black;
	}
	td{width: 5%;}
	</style>
  </head>

  <body>
  	
  	<?php

  		$mon_calendrier = new Calendar;
  		$annee = date('Y');
  		$annee = 2046;
		$cal_thisYear = $mon_calendrier->getCalendar($annee);

  		$result = '<table><thead><tr>';
  		foreach ($cal_thisYear as $mois => $value) {	
  			$result .= '<th>'. $mois . '</th>';
  		}
  		$result .= '</tr></thead><tbody>';
  		$d=1;
  		while ($d <= 31) {
	  		$result  .=  '<tr>';
	  		foreach ($cal_thisYear as $day) {
	  			$result  .=  '<td>' . $day[$d]. '</td>';
	  		}
	  		$result  .=  '</tr>';
	  		$d++;
	  	}

  		$result .= '</tbody></table>';

		echo $result;

  	?>

  </body>
</html>
