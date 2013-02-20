<div class="signup-outer">

	<?php echo validation_errors(); ?>

	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		<div>
			<label>first name</label>
			<input type="text" name="firstname" id="firstname" />
		</div>
		<div>
			<label>last name</label>
			<input type="text" name="lastname" id="lastname" />
		</div>
		<div>
			<label>username <span id="username-details">(beermealink.com/u/username)</span></label>
			<input type="text" name="username" id="username" />
		</div>
		<div>
			<label>email</label>
			<input type="text" name="email" id="email" />
		</div>
		<div>
			<label>password</label>
			<input type="text" name="password" id="password" />
		</div>
		<div>
			<input type="submit" name="submit" id="submit" class="submit-button" value="Signup" />
		</div>
	</form>
</div>