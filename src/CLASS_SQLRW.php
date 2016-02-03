<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

class SQLRW
{
	
	function __construct()
	{
		# code...
	}

	public function writeSQL($tables = '*', $dir, $filename){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		
		//get all of the tables
		if($tables == '*')
		{
			$tables = array();
			$result = mysqli_query($db,'SHOW TABLES');
			while($row = mysqli_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		
		//cycle through
		foreach($tables as $table)
		{
			$result = mysqli_query($db,'SELECT * FROM '.$table);
			$num_fields = mysqli_num_fields($result);
			
			$return.= 'DROP TABLE '.$table.';';
			$row2 = mysqli_fetch_row(mysqli_query($db,'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysqli_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j]= trim(preg_replace('/\s+/', ' ', $row[$j]));
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
	
		//save file
		$handle = fopen($dir.$filename.".sql",'w+');
		fwrite($handle,$return);
		fclose($handle);
	}

	public function readSQL($file){

		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();

    	
		// Temporary variable, used to store current query
	    $templine = '';
	    // Name of the file
	    $filename = $file;
	    // Read in entire file
	    $lines = file($filename);
	    // Loop through each line
	    foreach ($lines as $line)
	    {
	        // Skip it if it's a comment
	        if (substr($line, 0, 2) == '--' || $line == '')
	            continue;

	        // Add this line to the current segment
	        $templine .= $line;
	        // If it has a semicolon at the end, it's the end of the query
	        if (substr(trim($line), -1, 1) == ';')
	        {
	            // Perform the query
	            mysqli_query($db, $templine) or print('Error performing query \'<strong>'
	                . $templine . '\': ' . mysqli_error() . '<br /><br />');
	            // Reset temp variable to empty
	            $templine = '';
	        }
    	}
	}

}

?>