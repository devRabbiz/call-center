<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class facebook_leads extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('facebook_lead_model');
		
	}
		 public function session()
	{
	    if($this->session->userdata('username')=="")
		{
			redirect('login');
		}
	}	
	
	public function telecaller_lead($enq)
	{
		$data['select_leads']=$this->facebook_lead_model->select_lead($enq);
		$data['enq']=$enq;
		$this->load->view('include/telecaller_header.php');
			$this->load->view('telecaller_facebook_top_tab.php',$data);
		$this->load->view('facebook_lead_view.php',$data);
		$this->load->view('include/footer.php');
	}
	public function team_leader_lead($enq)
	{
		
		$data['select_leads']=$this->facebook_lead_model->select_tl_lead($enq);
		$data['select_telecaller']=$this->facebook_lead_model->select_telecaller();
		$data['enq']=$enq;
		$this->load->view('include/admin_header.php');
				$this->load->view('tl_facebook_top_tab_view.php',$data);
		$this->load->view('facebook_lead_view.php',$data);
		$this->load->view('include/footer.php');
	}
	public function tl_filter()
	{
		$enq=$this->input->post('enq');
		$select_leads=$this->facebook_lead_model->select_tl_lead($enq);
		?>
		  <div id="abc">
<?php
$today = date('d-m-Y');
?>
 <script type="text/javascript">
	jQuery(document).ready(function($) {
		var $table4 = jQuery("#table-4");
		$table4.DataTable({
			dom : 'Bfrtip',
			buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
		});
	}); 
</script>

                       <h1 style="text-align:center;">Facebook Leads</h1>
                       <div  class="table-responsive"  style="overflow-x:auto;"> 
		<table class="table table-bordered datatable table-responsive"" id="table-4"> 
						<thead>
						<tr>
							<th>Sr No.</th>
							<th>Interested In</th>
                            <th>Name</th>							
							<th>Contact</th>			
							<th>Email</th>
							<th>Lead (Date/Time)</th>
                            <th>Status</th>
							<th>Assign To</th>
						<th>Comment</th>
								<th> Remark</th>
					
							<th>Action</th>
							
						</tr>	
					</thead>
					<tbody>
						<?php
						$i=0;
				foreach($select_leads as $fetch)
						{
							
							$enq_id=$fetch->enq_id;
							$i++;
						?>
						<tr>
							<td><?php echo $i; ?></td>
						
								<td><?php echo $fetch->enquiry_for; ?></td>
                               	<?php 
								//$query1=mysql_query("select count(id) as fcount from lead_followup where leadid='$enq_id'");
								//	$fetch2=mysql_fetch_array($query1);
								?>
                                <td><b><a href="lms_details.php?id=<?php echo $enq_id; ?>"><?php echo $fetch->name; ?></a>(<?php echo $fetch->fcount?>)</b></td>
							<td><?php echo $fetch->contact_no; ?></td>
								<td><?php echo $fetch->email; ?></td>
								
								<td><?php echo $fetch->created_date; ?></td>
								
                                <td>
                                	<?php $status = $fetch->status;

									if ($status == 1) {
										echo "Not Yet";
									}

									if ($status == 2) {
										echo "Live";
									}
									if ($status == 3) {
										echo "Postpone";
									}
									if ($status == 4) {
										echo "Lost";
									}
									if ($status == 5) {
										echo "Convert";
									}
                                	?>
                                	
                            
                                	
                                </td>
								<td>
									<?php 

									echo $fetch->fname . " " . $fetch->lname;
									?>
								</td>
								<td><?php echo $fetch->comment; ?></td>
								<td>
									<?php 
									$query2 = $this->db->query("select comment from lead_followup where leadid='$enq_id'  order by id desc limit 1")->result() ;
							
									echo $query2[0]->comment ;
									?>
								</td>
								
								
								
							<?php if($_SESSION['role']==3)
{?>
				<td><a href="<?php echo site_url();?>add_followup/detail/<?php echo $enq_id;?>/Facebook">Add Follow Up </a> | <a href="<?php echo site_url();?>remove_duplicate/leads/<?php echo $enq_id;?>/Website"  onclick="return confirm('Do you want to delete this record?')">Remove</a><!--<td><a href="request_lead_transfer.php?id=<?php echo $enq_id; ?>">Request To Transfer</a></td>--></td>

<?php }else{
	if($fetch->assign_to_telecaller==0){ ?>
	<td><a href="<?php echo site_url();?>manager_remark/leads/<?php echo $enq_id;?>/Facebook">Manager Remark </a></td>
	<?php }else
{
	?>
	<td></td>
<?php }} ?>
						
						</tr>
						<?php } ?>
					</tbody>
					
					
				</table>
			</div>
			</div>
				<?php
	}
public function telecaller_filter()
	{
		$enq=$this->input->post('enq');
		$select_leads=$this->facebook_lead_model->select_lead($enq);
		?>
		  <div id="abc">
<?php
$today = date('d-m-Y');
?>
 <script type="text/javascript">
	jQuery(document).ready(function($) {
		var $table4 = jQuery("#table-4");
		$table4.DataTable({
			dom : 'Bfrtip',
			buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
		});
	}); 
</script>

                       <h1 style="text-align:center;">Facebook Leads</h1>
                       <div  class="table-responsive"  style="overflow-x:auto;"> 
		<table class="table table-bordered datatable table-responsive"" id="table-4"> 
						<thead>
						<tr>
							<th>Sr No.</th>
							<th>Interested In</th>
                            <th>Name</th>							
							<th>Contact</th>			
							<th>Email</th>
							<th>Lead (Date/Time)</th>
                            <th>Status</th>
							<th>Assign By</th>
						<th>Comment</th>
								<th> Remark</th>
					
							<th>Action</th>
							
						</tr>	
					</thead>
					<tbody>
						<?php
						$i=0;
				foreach($select_leads as $fetch)
						{
							
							$enq_id=$fetch->enq_id;
							$i++;
						?>
						<tr>
							<td><?php echo $i; ?></td>
						
								<td><?php echo $fetch->enquiry_for; ?></td>
                               	<?php 
								//$query1=mysql_query("select count(id) as fcount from lead_followup where leadid='$enq_id'");
								//	$fetch2=mysql_fetch_array($query1);
								?>
                                <td><b><a href="lms_details.php?id=<?php echo $enq_id; ?>"><?php echo $fetch->name; ?></a>(<?php echo $fetch->fcount?>)</b></td>
							<td><?php echo $fetch->contact_no; ?></td>
								<td><?php echo $fetch->email; ?></td>
								
								<td><?php echo $fetch->created_date; ?></td>
								
                                <td>
                                	<?php $status = $fetch->status;

									if ($status == 1) {
										echo "Not Yet";
									}

									if ($status == 2) {
										echo "Live";
									}
									if ($status == 3) {
										echo "Postpone";
									}
									if ($status == 4) {
										echo "Lost";
									}
									if ($status == 5) {
										echo "Convert";
									}
                                	?>
                                	
                            
                                	
                                </td>
								<td>
									<?php 

									echo $fetch->fname . " " . $fetch->lname;
									?>
								</td>
								<td><?php echo $fetch->comment; ?></td>
								<td>
									<?php 
									$query2 = $this->db->query("select comment from lead_followup where leadid='$enq_id'  order by id desc limit 1")->result() ;
							
									echo $query2[0]->comment ;
									?>
								</td>
								
								
								
							<?php if($_SESSION['role']==3)
{?>
				<td><a href="<?php echo site_url();?>add_followup/detail/<?php echo $enq_id;?>/Facebook">Add Follow Up </a> | <a href="<?php echo site_url();?>remove_duplicate/leads/<?php echo $enq_id;?>/Website"  onclick="return confirm('Do you want to delete this record?')">Remove</a><!--<td><a href="request_lead_transfer.php?id=<?php echo $enq_id; ?>">Request To Transfer</a></td>--></td>

<?php }else{
	if($fetch->assign_to_telecaller==0){ ?>
	<td><a href="<?php echo site_url();?>manager_remark/leads/<?php echo $enq_id;?>/Facebook">Manager Remark </a></td>
	<?php }else
{
	?>
	<td></td>
<?php }} ?>
						
						</tr>
						<?php } ?>
					</tbody>
					
					
				</table>
			</div>
			</div>
				<?php
	}
}
?>