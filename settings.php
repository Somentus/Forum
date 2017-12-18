<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"].'/includes/DB.php');
$pdo = DB();
require_once($_SERVER["DOCUMENT_ROOT"].'/includes/codes.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/includes/settings.php');

$securityErrors = [];
$profileErrors = [];
if(isset($_POST['securitySubmit'])) {
	$securityErrors = security($pdo);
} else if(isset($_POST['profileSubmit'])) {
	$profileErrors = profile($pdo);
}

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Functional Forum</title>

	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

	<script src="/js/scripts.js" type="text/javascript" ></script>

</head>

<body>

	<div>
		<?php navbar($pdo); ?>
	</div>

	<br />
	<div class="container">

				<!-- 
				
				- Security:
					- Change email
					- Change password
				- Personal info:
					- Profile picture
					- Birthdate
					- Bio

				-->
		<div class="row">
			<div class="col-md-2">
				<div class="nav flex-column nav-pills border" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link border active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Security</a>
					<a class="nav-link border" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
				</div>
			</div>

			<div class="col-md-10">


				<div class="tab-content ml-5 p-3 border" id="v-pills-tabContent">

					
					<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

						<div id="errors">
							<?php
								foreach($securityErrors as $error) {
									echo $error."<br />";
								}
							?>
						</div>

						<form action="settings.php" method="POST">
							<div class="form-group row">
								<label for="inputEmail" class="col-md-2 col-form-label">New Email:</label>
								<div class="input-group col-md-4">
									<input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
									<div class="input-group-addon">@</div>
								</div>
							</div>

							<hr />

							<div class="form-group row">
								<label for="inputPassword" class="col-md-2 col-form-label">New Password:</label>
								<div class="input-group col-md-4">
									<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
									<div class="input-group-addon">$</div>
								</div>
							</div>

							<hr>

							<div class="form-group row">
								<div class="col-md-10">
									<button name="securitySubmit" type="submit" class="btn btn-primary">Save</button>
								</div>
							</div>
						</form>

					</div>
					
					<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

						<?php
							foreach($profileErrors as $error) {
								echo $error."<br />";
							}
						?>

						<form action="settings.php" method="POST" enctype="multipart/form-data" class="row">

							<div class="col-md-6">

								<div class="form-group row">
									<label for="inputProfilePicture" class="col-md-4 col-form-label">
										Profile Picture
									</label>
									<div class="input-group col-md-8">
										<input type="file" class="form-control" id="inputProfilePicture" name="image" />
									</div>
								</div>

								<hr>

								<div class="form-group row">
									<label for="inputBirthdate" class="col-md-4 col-form-label">
										Birthdate
									</label>
									<div class="input-group col-md-8">
										<input class="form-control" id="inputBirthdate" type="date">
									</div>
								</div>

								<hr>

								<div class="form-group row">
									<label for="inputBio" class="col-md-4 col-form-label">
										Bio
									</label>
									<div class="input-group col-md-8">
										<textarea name="body" class="form-control" id="inputBio" rows="5"></textarea>
									</div>
								</div>

								<hr>

								<div class="form-group row">
									<div class="col-md-12 text-center">
										<button name="profileSubmit" type="submit" class="btn btn-primary">Save</button>
									</div>
								</div>

							</div>

							<div class="col-md-6">
								<img src='<?php echo retrieveProfilePicture($pdo, $_SESSION['id']); ?>' class='img-fluid rounded'>
							</div>
						</form>

					</div>

				</div>

			</div>
		</div>
	</div>

</body>
</html>
