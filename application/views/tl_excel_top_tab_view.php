            

 <!--<ol class="breadcrumb bc-3" > <li> <a href="dashboard.php"><i class="fa fa-home"></i>Home</a> </li><li class="active"> <strong>Lead Management System</strong> </li> </ol>-->

    
         <script>
 
							function test()
			{
				 		
	
				 var s=document.getElementById("status").value;
				  var a=document.getElementById("assign_to").value;
				
			
				var f=document.getElementById("fromdate").value;
			
			
				 var t=document.getElementById("todate").value;
				 
			

				$.ajax(
				   {
						url:"<?php echo site_url('excel_leads/tl_filter'); ?>
							",
							type:'POST',
							data:{status:s,fromdate:f,todate:t,assign_to:a},
							success:function(response)
							{$("#leaddiv").html(response);}
							});

							}
</script>         
               
<!-- Filter-->
<div class="row">
                        
                            <div class="x_panel">
                         
                              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                     
                                      
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="status" name="lead" required>
										
											
													 <option value="0">All</option>
                                             	<option value="1">Not Yet</option>
                                                  <option value="2">Live</option>
                                                  <option value="3">Postponed</option>
                                                  <option value="4">Lost</option>
                                                  <option value="5">Convert</option>
                                                
                                                </select>
											  
                                            </div>
                            </div>
                                     
                                    
                                    
                           <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                           <div id="txtHint1">
											
                                              <select class="filter_s col-md-12 col-xs-12 form-control" name="user" id="assign_to" >
											
											
												<option value="">Assigned To</option>
										<?php		
													foreach ($select_telecaller as $fetch) {
														
												
 ?>
												 		<option value="<?php echo $fetch -> id; ?>"><?php echo $fetch -> fname . " " . $fetch -> lname; ?></option> 
													 <?php
													}
												  ?>
                                                </select>
												</div>
                                        </div>
                            </div>
                           
                            
							
                                    
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                           
											
                                              <input type="text" id="fromdate" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="From Date" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">
										
                                        </div>
                            </div>
                                    
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                           
											
                                              <input type="text" id="todate" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="To Date" name="to_booking" readonly style="background:#F5F5F5; cursor:default;">
											
                                        </div>
                            </div>
                                     <div class="col-md-12">
                                     <div class="form-group">
                        <div class="col-lg-2 col-md-2 col-md-offset-4 col-lg-offset-4 col-sm-6 col-xs-12" style="padding:20px;">
                             
                                    <button type="submit" id="sub" onclick="test()" class="btn btn-info btn-icon btn-lg ">Search <i class="fa fa-search"></i></button>
                                </div>
                            
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">
                        	<a href="" onclick="clear()" class="btn btn-primary btn-icon btn-lg "  >Reset <i class="fa fa-times"></i></a>
                            
                                </div>
                      </div>       
                     </div> 
                     
                                </div>
                                </div>
    <!-- date script -->
     <script>
    	function clear()
    	{
    		 document.getElementById("status").innerHTML ='All';
				
	document.getElementById("fromdate").innerHTML='' ;
			document.getElementById("assign_to").innerHTML='' ;
			
				document.getElementById("todate").innerHTML='' ;
				 test();
			
    		
    	}
    </script>
                    
                     <script type="text/javascript">
						$(document).ready(function() {
							$('.datett').daterangepicker({
								singleDatePicker : true,
								format : 'DD-MM-YYYY',
								calender_style : "picker_1"
							}, function(start, end, label) {
								console.log(start.toISOString(), end.toISOString(), label);
							});

							$('#fromdate').daterangepicker({
								singleDatePicker : true,
								format : 'DD-MM-YYYY',
								calender_style : "picker_1"
							}, function(start, end, label) {
								console.log(start.toISOString(), end.toISOString(), label);
							});

							$('#todate').daterangepicker({
								singleDatePicker : true,
								format : 'DD-MM-YYYY',
								calender_style : "picker_1"
							}, function(start, end, label) {
								console.log(start.toISOString(), end.toISOString(), label);
							});

							$(window).load(function() {
								var status = $('#status1').val();
								//alert(status);
								if (status == 'Free Stock') {
									$('#booking').hide();
									$('#tl').hide();
									$('#dse').hide();
									$('#fromdate').hide();
									$('#todate').hide();

								} else {
									$('#booking').show();
									$('#tl').show();
									$('#dse').show();
									$('#fromdate').show();
									$('#todate').show();
								}
							})
							//Code for Hide & Show for select control

							$('#status1').change(function() {

								var selectedValue = this.value;

								if (selectedValue == 'Free Stock') {
									$('#booking').hide();
									$('#tl').hide();
									$('#dse').hide();
									$('#fromdate').hide();
									$('#todate').hide();

								} else {
									$('#booking').show();
									$('#tl').show();
									$('#dse').show();
									$('#fromdate').show();
									$('#todate').show();
								}

							})
						});

						function clear_text() {

							window.location.assign("lms.php");
						}
                    </script>
					
                    
                    <!-- date script -->

<!--Filter Ends-->                    