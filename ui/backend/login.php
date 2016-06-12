<!doctype html>
<html class="fixed">
	<head>
		<?php include 'tpl/head.php' ?>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<form action="<?=$base_class->base_url('login/verifyUser')?>" class="login_form" method="post">
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="uname" required type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="input-group input-group-icon">
									<input name="pass" required type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4 text-left">
									<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
							</div>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright <?=date('Y')?>. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.js"></script>
		<script src="vendor/nanoscroller/nanoscroller.js"></script>
		<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="vendor/magnific-popup/magnific-popup.js"></script>
		<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="javascripts/theme.init.js"></script>

		<script>
			$(document).ready(function (e) {
				$(".login_form").submit(function (e) {
					e.preventDefault();
					var frm = $(this);
					$.ajax({
						url:frm.attr("action"),
						type:"POST",
						dataType:"json",
						data:frm.serializeArray(),
						success: function (response) {
							new PNotify({
								title: "Login Message",
								text: response.message,
								type: (response.error ? 'error' : 'info'),
								addclass: 'notification-dark',
								icon: 'fa fa-user'
							});
							if(!response.error){
								setTimeout(function () {
									window.location = response.goto;
								},1500);
							}
						},error:function (error) {
							//console.log(error);
						},complete: function () {

						}
					});
				});
			});
		</script>

	</body>
</html>