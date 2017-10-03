<?php 
		foreach($rdidarry as $rdid){	
		$round = 0;
		$round2 = 0;
		?>  
        <?php	
		//echo 'Rdid='.$rdid;
		$selrgquote=$wpdb->get_results("SELECT * FROM request_getquote rg, get_quote_flight gqf WHERE RD_Id='$rdid' AND rg.GQF_Id=gqf.GQF_Id AND RG_Active=1");
	    //print "<pre>";print_r($selrgquote);print "</pre>";
			if(count($selrgquote)){			
	                                        
				if($rowRdDetails=$wpdb->get_row("SELECT RD_Dateoftravel, RD_ReturnDate, MOD_Name, RD_Cityfrom, RD_Cityto, rd.MOD_Id, SD_Id FROM request_details rd, mode mo WHERE RD_Id='$rdid' AND rd.MOD_Id=mo.MOD_Id")){
	    ?>

            <?php if($rowRdDetails->MOD_Name=="Flight") { ?>	
            <div class="container-fluid pgbg flight-quote1">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 col-xs-3 pt10" ><i class="fa fa-plane planefa" aria-hidden="true" ></i><span class="gclr 22fnt">FLIGHT </span></div>
                  <div class="col-sm-4 col-md-4 col-xs-5 pt10" ><span class="18fnt"> <i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityfrom ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityto ?> </span></span>  </div>
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo date('d-m-Y',strtotime($rowRdDetails->RD_Dateoftravel));?></span>  </div>
               </div>
               
               <div class="row flight-content1" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ 
               $imgPath = WPERP_EMPLOYEE_ASSETS.'/images/AirlineLogo/'.$rowrgquote->GQF_AirlineCode.'.gif ';
               if($rowrgquote->RG_Pref==2)
	       $style='bghlt';
	       else
	       $style='';
		   if($round<3){
               ?>
                  <div class="col-sm-2 col-md-1 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img src="<?php echo $imgPath;?>" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-3 pt10 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3"><?php echo $rowrgquote->GQF_AirlineName; ?></span> <br> <span class="splane quote-dep3">Dep: <?php echo $rowrgquote->GQF_DepTIme; ?>, Arr: <?php echo $rowrgquote->GQF_ArrTime; ?> </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3"><?php echo $rowrgquote->GQF_Price;?></span></span></div>
               <?php 
			   }
			   $round++;
			   } ?>
               </div>
            </div>
			
			<?php 
			//roundtip
			if($round>3){
			?>
			<div class="container-fluid pgbg flight-quote1">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-plane planefa return-plane" aria-hidden="true" ></i><span class="gclr 22fnt">FLIGHT </span></div>
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><span class="18fnt"> <i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityto ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityfrom ?> </span></span>  </div>
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo date('d-m-Y',strtotime($rowRdDetails->RD_ReturnDate));?></span>  </div>
               </div>
               
               <div class="row flight-content1" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ 
               $imgPath = WPERP_EMPLOYEE_ASSETS.'/images/AirlineLogo/'.$rowrgquote->GQF_AirlineCode.'.gif ';
               if($rowrgquote->RG_Pref==2)
	       $style='bghlt';
	       else
	       $style='';
		   if($round2>=3){
               ?>
                  <div class="col-sm-2 col-md-1 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img src="<?php echo $imgPath;?>" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-3 pt10 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3"><?php echo $rowrgquote->GQF_AirlineName; ?></span> <br> <span class="splane quote-dep3">Dep: <?php echo $rowrgquote->GQF_DepTIme; ?>, Arr: <?php echo $rowrgquote->GQF_ArrTime; ?> </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3"><?php echo $rowrgquote->GQF_Price;?></span></span></div>
               <?php 
			   }
			   $round2++;
			   } ?>
               </div>
            </div>
			
			
 	    
		<?php } }?>
 	    
 	    <?php if($rowRdDetails->MOD_Name=="Hotel") { 
		?>	
            <div class="container-fluid pgbg hotel-quote2">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-hospital-o planefa " aria-hidden="true" ></i><span class="gclr 22fnt">HOTELS</span> </div>
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"> <?php echo $rowRdDetails->RD_Cityfrom;?></span>  </div>
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10"><i class="fa fa-calendar mapfa" aria-hidden="true"></i><span class="18fnt"><?php echo $rowRdDetails->RD_Dateoftravel;?> </span>  </div>
               </div>
               <div class="row hotel-content2" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){ 
			   if($rowrgquote->RG_Pref==2)
			   $style='bghlt';
			   else
			   $style='';
			   ?>
                  <div class="col-sm-2 col-md-1 col-xs-4 quote-image3 imgsty <?php echo $style; ?>" ><img style="width: 100%; padding-top: 5px; height: 100%; padding-bottom: 5px;" alt="Hotel" src="<?php echo $rowrgquote->GQF_FlightNumber;?>" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-3 pt10 <?php echo $style; ?> col-xs-8 imgsty" ><span class="splane quote-name3"><?php echo $rowrgquote->GQF_AirlineName; ?></span> <br> <span class="splane quote-dep3"><strong>CheckIn:</strong> <?php echo date("d-m-y",strtotime($rowrgquote->GQF_DepTIme)); ?>- <strong>CheckOut:</strong> <?php echo date("d-m-y",strtotime($rowrgquote->GQF_ArrTime));?></span><br><span class="22fnt c1a">&#8377;<span class="quote-price3"><?php echo $rowrgquote->GQF_Price;?></span></span></div>
               <?php } ?>
               </div>
            </div>
 	    
 	    <?php } ?>
 	    
 	    <?php if($rowRdDetails->MOD_Name=="Bus") { ?>
            <div class="container-fluid pgbg bus3">
               <div class="row myrow" >
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-bus planefa" aria-hidden="true" ></i><span class="gclr 22fnt">BUS </span></div>
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-map-marker mapfa" aria-hidden="true" ></i><span class="18fnt"><span class="quote-from1"> <?php echo $rowRdDetails->RD_Cityfrom ?></span><span class="quote-to1"> - <?php echo $rowRdDetails->RD_Cityto ?> </span></span>  </div>
                  <div class="col-sm-4 col-md-4 col-xs-4 pt10" ><i class="fa fa-calendar mapfa" aria-hidden="true" ></i><span class="18fnt quote-date1"><?php echo date('d-m-Y',strtotime($rowRdDetails->RD_Dateoftravel));?> </span>  </div>
               </div>
               <div class="row bus-content1" style="background-color:#fff;" >
               <?php foreach($selrgquote as $rowrgquote){
               $imgPath = WPERP_EMPLOYEE_ASSETS.'/images/quote-bus.png';
               if($rowrgquote->RG_Pref==2)
	       $style='bghlt';
	       else
	       $style='';
               ?>
                  <div class="col-sm-2 col-md-1 <?php echo $style; ?> col-xs-6 quote-image3 imgsty" ><img src="<?php echo $imgPath;?>" class="img-responsive"></div>
                  <div class="col-sm-2 col-md-3 pt10 <?php echo $style; ?> col-xs-6 imgsty" ><span class="splane quote-name3"><?php echo $rowrgquote->GQF_AirlineName; ?></span> <br> <span class="splane quote-dep3"> Dep: <?php echo $rowrgquote->GQF_DepTIme; ?>, Arr: <?php echo $rowrgquote->GQF_ArrTime; ?> </span><br><span class="22fnt c1a">&#8377;<span class="quote-price3"><?php echo $rowrgquote->GQF_Price;?></span></span></div>
               <?php } ?>
               </div>
            </div>
 	    
 	    <?php } ?>
 	    
 	    
 	    <?php } ?>
 	    
 	    
 	    <?php } ?>
 	    
	    <?php } ?>