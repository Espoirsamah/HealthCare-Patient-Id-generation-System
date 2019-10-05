<div class="container">
	<h3>Provide New Password </h3>
	<hr />
	<div class="row">
		<div class="col-sm-6">
			<form method="post" action="<?php print_link(get_current_url()); ?>">
				<?php 
					$errors=(!empty($this->form_error) ? $this->form_error : null); 
					Html :: display_form_errors($errors);			
				?>
				<div class="form-group">
					<label>New Password</label>
					<input placeholder="Your New Password" required="required" value="" class="form-control default" name="password" id="txtpass" type="password" />
					<strong class="help-block">Hints &raquo; Not Less Than 6 Characters </strong>
				</div>
				<div class="form-group">
					<label>Confirm New Password</label>
					<input placeholder="Confirm Password" required="required" class="form-control default" name="cpassword" id="txtcpass" type="password" />
				</div>
				<div class="mt-2 "><button  class="btn btn-success" type="submit">Update Password</button></div>
			</form>
		</div>
	</div>
</div>
