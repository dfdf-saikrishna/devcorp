<?php
 	global $wpdb;
        $mydetails = myDetails($empuserid);
        if($selgrdLim=$wpdb->get_row("SELECT * FROM grade_limits WHERE EG_Id='$mydetails->EG_Id' AND GL_Status=1")){
			$selgrdLim = json_decode(json_encode($selgrdLim), True);
			//print_r($selgrdLim);
			$selgrdLim=array_values($selgrdLim);
			//print_r($selgrdLim);

		
			echo '<table id="expenseLimitId" class="wp-list-table widefat fixed striped admins">';
			echo '<tr>';


				//echo '<h4>Expense limits:</h4>';

				 
				$i=0;

				$selmod=$wpdb->get_results("SELECT MOD_Name FROM mode WHERE COM_Id = 0");

				$i = $gradelimitm = $totalLimitAmnt = 0;

				foreach($selmod as $rowmod){

						$k=$i+4;

						if($selgrdLim[$k]){

			
				  echo '<td>';
					  echo $rowmod->MOD_Name . "Expense Limit - <span class='oval-1'>";
					  echo $selgrdLim[$k] ? IND_money_format($selgrdLim[$k]).".00" : "No Limit</span>";
					 
							$gradelimitm++;
							$totalLimitAmnt += $selgrdLim[$k]; 

						}	

						if($gradelimitm%3==0)
						echo '<tr>';

						$i++; 	
				} 
					
						echo '</td>';
						
						echo '</table>';

				
				if($totalLimitAmnt < 1) echo '<script>document.getElementById("expenseLimitId").style.display = "none";</script>';
		}