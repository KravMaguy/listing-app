<div class="modal fade" id="infoWindowModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" id="building-image"
                style="margin:0; padding:0;height:200px; width:100%; background-size: cover; background-repeat:no-repeat;">
                <button type="button" class="close" data-dismiss="modal"
                    style="position: absolute; margin: 0; top: -20px;    right: -42px;color: #ffffff; z-index:999;">&times;</button>
            </div>

            <div class="modal-body" style="margin:0; padding:0;">
                <div id="building-name"
                    style="background:#545454; color: #ffffff; margin:-1px 0 0 0; padding:3px 10px;"></div>
                <div id="building-description" style="padding:20px 10px;background:whitesmoke"></div>
                <ul style="list-style-type: lower-alpha; margin-top:1em;">
                    <li id="units-link" style="padding:1px 10px;"></li>
                    <li id="building-photos" style="padding:1px 10px;"></li>
                    <li id="directions-link" style="padding:1px 10px;"></li>
                </ul>
            </div>
            <div id="contact-link" style="background:whitesmoke;justify-content:left;" class="modal-footer"></div>
        </div>
    </div>
</div>

	<!-- Form Modal -->
	<div class="modal fade" id="contact-agent-modal" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" id="contact-agent-modal-content">
				<div class="modal-header" style="background: #17a2b8;color: #ffffff;">
					<h2 class="modal-title">Request Information</h2>
					<button type="button" style="color: #ffffff;" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
                    <div id="contact-modal-building-title" style="font-size:x-large"></div>
					<form action="" method="post" enctype="multipart/form-data" id="contact-agent-form">
					<div id='notification' >
					</div >
						<div class="form-group">
							<!-- <label for="tenantname">Name</label> -->
							<input type="text" class="form-control" name="tenantname" id="tenantname" placeholder="your name" required>
						</div>

						<div class="form-group">
							<!-- <label for="email">email</label> -->
							<input type="email" class="form-control" name="tenantemail" id="tenantemail" placeholder="your email" required>
						</div>

                        <div class="form-group">
							<!-- <label for="phone">phone number</label> -->
							<input type="phone" class="form-control" name="tenantphone" id="tenantphone" placeholder="your phone number" required>
						</div>

                        <div class="form-group">
							<!-- <label for="ext">Ext.</label> -->
							<input type="number" class="form-control" name="tenantextension" id="tenantextension" placeholder="Ext.">
						</div>

						<div class="form-group">
							<!-- <label for="info">additional info</label> -->
							<textarea type="text" rows="4" cols="50" class="form-control" name="additionalinfo" id="additionalinfo" required>Please send additional information about this property listing</textarea>
						</div>

						<button type="submit" style="font-size:20px" class="btn btn-primary">message listing agent</button>

						<input type="hidden" id="contact_user_id" name="contact_user_id" value="">

					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>





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