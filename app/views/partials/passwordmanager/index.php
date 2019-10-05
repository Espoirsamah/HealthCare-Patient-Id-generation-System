<div class="container">
	<div>
		<h3>Password Reset Manager</h3>
		<small class="text-muted">
			Please provide the valid email address you used to register
		</small>
	</div>
	<hr />
	<div class="row">
		<div class="col-md-8">
			<?php 
				$errors=(!empty($this->form_error) ? $this->form_error : null); 
				Html :: display_form_errors($errors); 
			?>
			<form method="post" action="<?php print_link("passwordmanager/postresetlink"); ?>">
				<div class="row">
					<div class="col-9">
						<input value="<?php echo get_form_field_value('email'); ?>" placeholder="Enter Your Email Address" required="required" class="form-control default" name="email" type="email" />
					</div>
					<div class="col-3">
						<button class="btn btn-success" type="submit"> Send <i class="material-icons">email</i></button>
					</div>
				</div>
			</form>
			
		</div>
	</div>
	<br />
	<div class="text-info">
		A Link Will Be Sent to your Email containing the information you need for your password
	</div>
</div>




