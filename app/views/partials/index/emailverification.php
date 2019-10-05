<?php
	$data=$this->view_data;
	$user_email=$data["user_email"];
	$status=$data["status"];
?>
<div class="container">
	<?php 
		if($status==true){
			?>
			<div class="row">
				<div class="col-xs-2 col-sm-1">
					<i class="material-icons mi-lg text-success animated bounce">email</i>
				</div>
				<div class="col-xs-10 col-sm-11">
					<?php 
						if(!empty($_GET['resend'])){
							?>
							<h4 class="text-info bold animated bounce">Email Verification Has Been Resend.</h4>
							<?php
						}
						else{
							?>
							<h4 class="text-info bold">Email Verification Link Sent</h4>
							<?php
						}
					?>
					<div>
						Please Verify Your Email Address By Following the link in your mailbox
					</div>
					<hr />
					<div>
						<a href="<?php print_link("index/send_verify_email_link/$user_email?resend=true") ?>" class="btn btn-primary"> Resend Email</a>
					</div>
				</div>
			</div>
			<?php
		}
		else{
			?>
			<div class="row">
				<div class="col-xs-2 col-sm-1">
					<i class="material-icons mi-lg text-danger animated bounce">email</i>
				</div>
				<div class="col-xs-10 col-sm-11">
					<div>
						Please Verify Your Email Address By Following the link in your mailbox
					</div>
					<hr />
					<div>
						<a href="<?php print_link("index/send_verify_email_link/$user_email?resend=true") ?>" class="btn btn-primary"> Resend Email</a>
					</div>
				</div>
			</div>
			<?php
		}
	?>
	
</div>


