<?php
 
// Zeit in UNIX-Timestamp
	function TimeToUnix($input){
		@list ($date, $time)      = explode(' ', $input, 2);
		@list ($day, $mon, $year) = explode('.', $date);   
		
		$timestamp = strtotime("$year-$mon-$day $time");
		
		return $timestamp;
	}
	
	
// UNIX-Timestamp in dd.mm.yyyy hh:mm:ss
	function UnixToTime($input){
		$datum  = date("d.m.Y", $input);
		$zeit   = date("H:i:s", $input);
		
		$timestring = "$datum $zeit";
				
		return $timestring;
	}	
	
	function UnixToStarttime($input){
		setlocale(LC_ALL, "de_DE.utf8");
		$datum  = date("w", $input);
		$zeit   = date("H:i", $input);
		
		$tag[0] = "So";
		$tag[1] = "Mo";
		$tag[2] = "Di";
		$tag[3] = "Mi";
		$tag[4] = "Do";
		$tag[5] = "Fr";
		$tag[6] = "Sa";
		
		$datum = $tag[$datum];
		
		$timestring = "$datum $zeit";
				
		return $timestring;
	}	
	
	function UnixToFileTime($input){
		$datum  = date("Y.m.d", $input);
		$zeit   = date("H.i.s", $input);
		
		$timestring = "$datum.$zeit";
				
		return $timestring;
	}	
// UNIX-Timestamp in  hh:mm
	function UnixToClock($input){
		$datum  = date("d.m.Y", $input);
		$zeit   = date("H:i", $input);
		
		$timestring = "$zeit";
				
		return $timestring;
	}	
		
// UNIX-Timestamp in dd.mm.yyyy
	function UnixToShortTime($input){
		$datum  = date("d.m.Y", $input);
			
		$timestring = "$datum";
				
		return $timestring;
	}	

// UNIX-Timestamp in dd.mm.yyyy
	function UnixToDate($input){
		$datum  = date("d.m.Y", $input);
			
		$timestring = "$datum";
				
		return $timestring;
	}	
// UNIX-Timestamp in YYYY
	function UnixToYear($input){
		$Jahr = date("Y", $input);

		
		return $Jahr;
	}	
// UNIX-Timestamp in DD
	function UnixToDay($input){
		$Jahr = date("d", $input);

		
		return $Jahr;
	}	
// UNIX-Timestamp in mm.yyyy
	function UnixToMonth($input){
		$datum  = date("m.Y", $input);
			
		$timestring = "$datum";
				
		return $timestring;
	}	
	
	function UnixToBirth($input){
		
		if($input == 0){
			return "<i> bitte angeben! </i>";
		}else{
			return date("d.m.Y", $input);
		}
	}
	
	function UnixToBirthForm($input){
		
		if($input == 0){
			return "";
		}else{
			return date("d.m.Y", $input);
		}
	}

	function UnixToStreamTime($input){

		$wota[0]		= "So";
		$wota[1]		= "Mo";
		$wota[2]		= "Di";
		$wota[3]		= "Mi";
		$wota[4]		= "Do";
		$wota[5]		= "Fr";
		$wota[6]		= "Sa";

		$zeit			= date("H:i:s", $input);
		$returnstring	= "".$wota[date("w", $input)]." ".$zeit;

		return $returnstring;
	}

	function timespanArray( $seconds ){
    
		$td['total'] = $seconds;
		
		$td['sec'] = $seconds % 60;
	
		$td['min'] = (($seconds - $td['sec']) / 60) % 60;
	
		$td['std'] = (((($seconds - $td['sec']) /60)- 
						$td['min']) / 60) % 24;
		
		$td['day'] = floor( ((((($seconds - $td['sec']) /60)- 
						$td['min']) / 60) / 24) );

		if($td['sec']<10){
			$td['sec'] = "0".$td['sec'];
		}

		
		if($td['min']<10){
			$td['min'] = "0".$td['min'];
		}

		
		if($td['std']<10){
			$td['std'] = "0".$td['std'];
		}

		
		if($td['day']<10){
			$td['day'] = "0".$td['day'];
		}

		$td['hms'] = $td['std'].":".$td['min'].":".$td['sec'];
						
		return $td;
		
	}
/*
Format Beschreibung                          Beispiel
  ========================================================
  d      Tag des Monats, zweistellig           03, 28
  j      Tag des Monats                        7, 13
  m      Nummer des Monats, zweistellig        01, 11
  n      Nummer des Monats                     2, 10
  y      Jahr zweistellig                      99, 00
  Y      Jahr vierstellig                      1999, 2001
  H      Stunde im 24-Stunden-Format, zweist.  08, 16
  G      Stunde im 24-Stunden-Format           7, 18
  i      Minuten, zweistellig                  08, 45
  s      Sekunden, zweistellig                 06, 56

  w      Wochentag in Zahlenwert               2, 6
*/
?>