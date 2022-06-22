	<!-- Form Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Building</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data" id="bldForm">
					<div id='notification' >
					</div >
						<div class="form-group">
							<label for="bldname">Name:</label>
							<input type="text" class="form-control" name="bldname" id="bldname" placeholder="Building Name">
						</div>

						<div class="form-group">
							<label for="bldaddress">Address</label>
							<input type="text" class="form-control" name="bldaddress" id="bldaddress" placeholder="Building Address">
						</div>

						<div class="form-group">
							<label for="blddesc">Description</label>
							<input type="text" class="form-control" name="blddesc" id="blddesc" placeholder="Short Description of the Building">
						</div>



						<div class="form-group">
							<label for="photos">Photos</label>
							<input type="file" class="form-control" name="image[]" id="images"  multiple="">
						</div>

						<input type="hidden" class="form-control" name="bldLat" id="bldLat" placeholder="Lat">
						<input type="hidden" class="form-control" name="bldLng" id="bldLng" placeholder="Lgn">

						<button type="submit" class="btn btn-primary">Submit</button>

						<input type="hidden" id="user_id" name="user_id" value=<?=$_SESSION["user_id"]?>>

					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- ./Form Modal -->
	<!--Notification Modal -->
	<div class="modal fade" id="successModal" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Success!</h4>

					<button type="button" onClick="location.reload()" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div id="successMessage"></div>
				</div>

				<div class="modal-footer">
					<button type="button" onClick="location.reload()" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="failModal" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">fail.. Retry</h4>

					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div id="successMessage"></div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end notifications -->

	<!--infowindow modal -->
	<div class="modal fade" id="infoWindowModal" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<!-- <div class="modal-header" id="building-image" style="margin:0; padding:0;height:200px; width:100%; background-size: cover; background-repeat:no-repeat;"> -->
				<div class="modal-header" id="building-image" style="margin:0; padding:0;height:200px; width:100%; background-size: cover; background-repeat:no-repeat;">
					<button type="button" style="opacity:.7; color:black;" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="padding:0px;">
				<div id="building-name" style="background:#545454; color: #ffffff; margin:-1px 0 0 0; padding:20px 10px;"></div>
				<div id="building-description" style="padding:20px 10px;"></div>
				<!-- <div id="successMessage"></div> -->
				<ul style="list-style-type: lower-alpha;">
            		<!-- <li id="units-link" style="padding:3px 10px;"></li>
            		<li id="building-photos" style="padding:3px 10px;"></li>
            		<li id="directions-link" style="padding:3px 10px;"></li> -->
					<!-- <li><a href="edit_building.php?id=<?=$row['building_id']?>" class="btn btn-primary">Edit Building</a></li> -->
					<li id="edit-building-link" style="padding:3px 10px;"></li>

				</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--end infoWindow -->