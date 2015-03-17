
	ftp_chdir($ftp_conn, $curfolder);
	$file_list = ftp_nlist($ftp_conn, "/TDS-S2");
	var_dump($file_list);
	
	function file_display($cur_dict, $c){
		
		global $ftp_conn;
		
		echo "<p>".$cur_dict."get</p>";
	
		$file_list = ftp_nlist($ftp_conn, $cur_dict);
		
		var_dump($file_list);
		$count = 0;
		foreach($file_list as $absolute_path){
			
			echo "<p>".$cur_dict."get</p>";
			//ERROR here
			
			$file_name = strrchr($absolute_path,"/");
			$file_name = str_ireplace("/","",$file_name); //and $f is the absolute path
			$id = (($c*10)+$count);
			
			if(ftp_chdir($ftp_conn, $absolute_path)){
				//display the folder in header of collapse
				
				echo '<div class="panel-heading">';
				echo '<h4 class="panel-title">';
				echo '<a data-toggle="collapse" data-parent="#accordion'.$id.'" href="#collapse'.$id.'">'
					 .$file_name.
					 '</h4>
					 </a>';

				//call file_display
				
				file_display($absolute_path, $id);

				//end of format

			}
			else{
				//display the files
				echo '<div id="panel'.$id.'" class="panel-collapse collapse">';
				echo '<div class="panel-body">'.$file_name.'</div></div>';
		        
			}

			$count = $count + 1;

		}//end of for loop
	}//end of function
	
	file_display("/TDS-S2", 0);
	