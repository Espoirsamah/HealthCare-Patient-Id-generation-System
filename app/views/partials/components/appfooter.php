<template id="AppFooter">
	<footer class="footer">
		<div  class="container text-center">
			<div class="row">
				<div  class="col-sm-4">
					<div class="copyright">&copy; <?php echo SITE_NAME; ?> | All Rights Reserved | DESIGN BY <a href="https://nahel-technology.org/" target="_blank">NAHEL TECHNOLOGY</a> &reg;</div>
				</div>
				<div  class="col-sm-8">
					<div class="footer-links">
						<a href="<?php print_link('info/about'); ?>">About <?php echo SITE_NAME ?></a> | 
						<a href="<?php print_link('info/help'); ?>">Help &amp; FAQ's</a> |
						<a href="<?php print_link('info/contact'); ?>">Contact</a>  |
						<a href="<?php print_link('info/privacy_policy'); ?>">Privacy Policy</a> |
						<a href="<?php print_link('info/terms_and_conditions'); ?>">Terms &amp; Conditions</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</template>

<script>
	var AppFooter = Vue.component('AppFooter', {
		template:'#AppFooter',
	})
</script>