<?
ob_start();
include('includes/header.php');
include('includes/navbar.php');
?>
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <? include('includes/topbar.php'); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
			<?
				if ( isset( $_GET['id'] ) && !empty( $_GET['id'])){
					
					if( isset( $_GET['action'])&& !empty($_GET['action'])){
						if($_GET['action']==='delete'){
							if($_GET['success']==1){
								echo "<div class='alert alert-success' > 
								unit deleted successfully 
								</div>";	
							} else {
								echo "<div class='alert alert-danger' > 
								unit was not deleted please try again
								</div>";
							}
						}
						if($_GET['action']==='edit'){
							if($_GET['success']==1){
								echo "<div class='alert alert-success alert-dismissible fade show' > 
								unit edited successfully 
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
								</div>";	
							} else {
								echo "<div class='alert alert-danger' > 
								unit was not edited please try again
								</div>";
							}						
						}						
					}
					$buildingId = $_GET['id'];
					
					//get the building details (name)
					$stmt = $db->prepare("SELECT name FROM tbl_buildings WHERE building_id=:buildingId ");
					$stmt->execute(array(':buildingId' => $buildingId));
					$building = $stmt->fetch(PDO::FETCH_ASSOC);
					
					echo '<h1>'.$building["name"].' Units</h1><br><br>';
					
					//get all he units of this building and display them in a card list
					$stmt = $db->prepare("SELECT * FROM tbl_units WHERE building_id=:buildingId ");
					$stmt->execute(array(':buildingId' => $buildingId));
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$row_count = $stmt->rowCount();
					
					if ($row_count<1){
						echo '<h1>there are no available units in this building add units please:</h1>';
						echo "<a href='add_units.php?id=".$buildingId."'>Click here</a>";

					} else{
					
					// The way we are supplying the variable to get the units 
					//once You get the units you need to list them. 
					foreach($results as $row) {
					?>
					
					<div class="card mb-3" style="border-style: solid; border-width: 1px; border-radius: .25rem!important; margin-bottom: 1rem!important;border-color: #D9DEE4;">
						<div class="row no-gutters">
							<div class="col-md-4">
								<img data-src="holder.js/200x200" class="img-thumbnail" alt="200x200" src="spaceplans/<?= getFeaturedImageUnit($row['unit_id']) ?>" data-holder-rendered="true" style="width: 200px; height: 200px;">
							</div><!--./col-md-4-->
							<div class="col-md-8" style="padding:15px;">
								<div class="card-body">
									<h5 class="card-title"><b>Unit Name:</b><span id="unit_name_<?=$row['unit_id']?>"> <?=$row['unit_name']?></span></h5>
									<p class="card-text"><b>Unit Size:</b> <span id="unit_size_<?=$row['unit_id']?>"> <?=$row['size']?></span></p>
									<p class="card-text"><b>Unit Price:</b><span id="unit_price_<?=$row['unit_id']?>"> <?=$row['price']?></span></p>
									<a href="edit_unit.php?id=<?=$row['unit_id']?>" class="btn btn-primary">Edit Unit</a>
									<a href="scripts/delete_unit_handler.php?id=<?=$row['unit_id']?>" class="btn btn-primary delete_unit">Delete Unit</a>
								</div><!--./card-body-->
							</div><!--./col-md-8-->
						</div><!--./row no-gutters-->
					</div><!--./card-->			
				<?
					}//end for loop	
					}// end of else statement					
				} //end if statement
				else {
					header("Refresh:5; url=view_buildings_template.php");
					echo '<h1>This building does not exist, you have reached this page in error</h1>';
					echo '<h1>click below if you are not redirected in 5 seconds:</h1>';
					echo '<a href= "view_buildings.php" class="btn btn-primary">view buildings </a>';					
				}//end if else
				?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js" ></script>
				<!-- modal here -->				
				<div class="modal fade" id="successModal" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Success!</h4>
								
								<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
							</div>
							
							<div class="modal-body">
								<div id="successMessage"></div>
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<a href="scripts/delete_unit_handler.php?id=" class="btn btn-danger confirm delete-unit-by-id">Confirm</a>
								<? ?>
							</div>
						</div>
					</div>
				</div>		
		</div><!--./col-md-8-->
	</div><!--./row justify-content-md-center-->
</div><!--./container-->

        <div class="clearfix"></div>
    </div>

<!-- footer here -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>


<script>

		// prevent default of following the href
		//supply the link to the modal using show method
		// show the message and the two buttons to either confirm or cancel, confirm 
		//proceeds to delete, cancel hides the modal. stop from appending continued data. use another method other than append. 
		$(document).ready(function(){
			

			
			$(".delete_unit").click(function(e){
				e.preventDefault();
				$('<div class="modal-backdrop"></div>').appendTo(document.body);
				var addressValue = $(this).attr("href");
				
				// i will fix this
						$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			return results[1] || 0;
			}
				console.log(addressValue);
				
				
/////////////////////////this will not work if id is double figures.. fix./////////////////////////////
/////////////////////////////////////////////////////////////////////////////
				
				 
				
				
				
				var unit_id = addressValue.substring(addressValue.lastIndexOf("=")+1);
				console.log(unit_id);
				var _href = $("a.delete-unit-by-id").attr("href");
				$("a.delete-unit-by-id").attr("href", _href + unit_id);


				var unit_name = $("#unit_name_" + unit_id).html();
				var unit_size = $("#unit_size_" + unit_id).html();
				var unit_price = $("#unit_price_" + unit_id).html();

				console.log(unit_name)
				console.log(unit_size)
				console.log(unit_price)
				
				$('#successModal').modal('show');
				
				$('#successMessage').html(`<p>This will DELETE Unit 
				
				${unit_name} which has an area of ${unit_size} sq. feet and a rent ${unit_price}$ a month are you sure?<p>
				
							
				`);			
				
			});
			
		$(".btn-secondary").click(function(){
			$(".modal-backdrop").remove();
		})
		
			
			
		});
		
</script>