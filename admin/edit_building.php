<?
include('includes/header.php');
include('includes/navbar.php');
// require_once('css/customsetfeaturedimg.css')
?>
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <? include('includes/topbar.php'); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <!-- <div class="row">

			<h3>Page Title <small>page sub-title</small></h3>
		</div> -->

        <div class="container" style="margin-bottom: 50px;">
            <?
			if (isset($_GET['id']) && is_numeric($_GET['id'])) { // Display the entry in a form:
				
				// get teh unit using the unit id.    
				$stmt = $db->prepare('SELECT building_id , name, short_description FROM tbl_buildings WHERE building_id=:building_id');
				$stmt->execute(array(
					':building_id' => $_GET['id']
				));
				$result    = $stmt->fetch(PDO::FETCH_ASSOC);
				$row_count = $stmt->rowCount();
				
				if ($row_count >= 1) {
			?>
					<div class="row h-100 align-items-center">



        				<div class="col-md-7 col-sm-10 col-xs-12">
                         <div class="card">
                            <div class="card-header">
							<h1 class="title">Edit Building </h1> 
                            </div>
                            <div class="card-body">       
							<form action="scripts/edit_building_handler.php" method="post" >
								<div id='notification' ></div >
								<div class="form-group">            
									<label for="bldname">Name:</label>
									<input type="text" class="form-control" name="bldname" id="bldname" placeholder="Building Name" value="<?= $result["name"] ?>" size="40" maxsize="100">
								</div>
												
								<div class="form-group">
									<label for="blddesc">Description:</label>
									<input type="text" class="form-control" name="blddesc" id="blddesc" placeholder="Short Description of the Building" value="<?= $result["short_description"] ?>" size="40" maxsize="100">
								</div>
								<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
								<button type="submit" class="btn btn-primary" value="update this entry">Submit</button>
							</form>
                                </div>
                            </div>
						</div>






                        
    		 		</div>
                
					</br>
					<hr>

					<div id="imageModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="POST" id="edit_image_form">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Edit Image Details</h4>
									</div>

									<div class="modal-body">
										<div class="form-group">
											<label>Image Description</label>
											<input type="text" name="image_description" id="image_description" class="form-control" />
										</div>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch1" name="isFeatured">
											<label class="custom-control-label" for="switch1">Set Featured</label>
										</div>
									</div>
									<div class="modal-footer">
										<input type="hidden" name="image_id" id="image_id" value="" />
										<input type="hidden" name="building_id" id="building_id" value="<?=$_GET['id']?>" />
										<input type="submit" name="submit" class="btn btn-info" value="Edit" />
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
            		</div>
					<!-- allow user to upload more photos-->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card shadow">

                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Building Photos</h6>
                                </a>
                            <div class="collapse show" id="collapseCardExample">
                            <div class="card-header" style="">
                                <input type="file" class="btn btn-primary" name="multiple_files" id="multiple_files" multiple />
                                <span class="text-muted">Only .jpg, png, .gif file allowed</span>
                                <span id="error_multiple_files"></span>
                            </div>
                        <div class="card-body">
                            <div class="table-responsive" id="image_table"></div>
                        </div>
                </div>
                    </div>
                    
                </div>
                
			<?
    			} else {
        			/* if no results */
        			echo '<div class="alert alert-danger" role="alert">Oops! building not available. Please try again!</div>';
    			}
			} else {
    			/* if there is no link with id set */
    			echo '<div class="alert alert-danger" role="alert">Oops! id is not set. Please try again!</div>';
    			/* id is not set */
			}
			?>
        </div> 


    </div>
</div>
          
<!-- footer here -->
<? 
include('includes/scripts.php');
?>

<script>
    $(document).ready(function() {
        load_image_data();

        function load_image_data() {
            var id = <?= $_GET['id'] ?>;
            console.log('this is the id : ' + id);
            $.ajax({
                data: id,
                url: "scripts/image_crud_buildings/fetch.php?id=" + id,
                method: "POST",
                success: function(data) {
                    $('#image_table').html(data);
                }
            });
        }
        $('#multiple_files').change(function() {
            alert('hi')
            var error_images = '';
            var form_data = new FormData();
            var files = $('#multiple_files')[0].files;
            if (files.length > 10) {
                error_images += 'You can not select more than 10 files';
            } else {
                for (var i = 0; i < files.length; i++) {
                    var name = document.getElementById("multiple_files").files[i].name;
                    var ext = name.split('.').pop().toLowerCase();
                    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        error_images += '<p>Invalid ' + i + ' File</p>';
                    }
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
                    var f = document.getElementById("multiple_files").files[i];
                    var fsize = f.size || f.fileSize;
                    if (fsize > 2000000) {
                        error_images += '<p>' + i + ' File Size is very big</p>';
                    } else {
                        form_data.append("file[]", document.getElementById('multiple_files').files[i]);
                    }
                }
            }
            if (error_images == '') {
                var id = <?= $_GET['id'] ?>;

                form_data.append("building_id", id);
                $.ajax({
                    url: "scripts/image_crud_buildings/upload.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#error_multiple_files').html('<br /><label class="text-primary">Uploading...</label>');
                    },
                    success: function(data) {
                        $('#error_multiple_files').html('<br /><label class="text-success">Uploaded</label>');
                        load_image_data();
                    }
                });
            } else {
                $('#multiple_files').val('');
                $('#error_multiple_files').html("<span class='text-danger'>" + error_images + "</span>");
                return false;
            }
        });
        $(document).on('click', '.edit', function() {
            console.log('editing')
            console.log(this)
                //this is where it gets set to the photo_id columb in the database
            var image_id = $(this).attr("id");
            $('#switch1').prop("checked", false);

            $.ajax({
                url: "scripts/image_crud_buildings/edit.php",
                method: "post",
                data: {
                    image_id: image_id
                },
                dataType: "json",
                success: function(data) {
                    console.log(data.isFeatured);
                    $('#imageModal').modal('show');
                    $('#image_id').val(image_id);
                    $('#image_name').val(data.photos);
                    $('#image_description').val(data.image_description);

                    if (data.isFeatured == 'on') {
                        $('#switch1').prop("checked", true);
                    }

                }
            });
        });
        $(document).on('click', '.delete', function() {
            var image_id = $(this).attr("id");
            console.log('it is :'+this);
            var image_name = $(this).data("photos");
            console.log('this is the image name : ')
            console.log(image_name);

            if (confirm("Are you sure you want to remove it?")) {
                $.ajax({
                    url: "scripts/image_crud_buildings/delete.php",
                    method: "POST",
                    data: {
                        image_id: image_id,
                        image_name: image_name
                    },
                    success: function(data) {
                        load_image_data();
                        alert("Image removed");
                    }
                });
            }
        });
        $('#edit_image_form').on('submit', function(event) {
            event.preventDefault();
            alert('you tried to submit an edit');

            console.log($('#edit_image_form').serialize());
            $.ajax({
                url: "scripts/image_crud_buildings/update.php",
                method: "POST",
                data: $('#edit_image_form').serialize(),
                success: function(data) {
                    console.log('update...this is a success response from update.php with the data  : ')
                    console.log(data);
                    $('#imageModal').modal('hide');
                    load_image_data();
                    alert('Image Details updated');
                }
            });

        });
    }); 
</script>

<?php
include('includes/footer.php');
?>