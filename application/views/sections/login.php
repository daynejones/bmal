<div class="login-outer">

	<?= isset($error) ? $error : '' ?>

	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		<div>
			<label>email</label>
			<input type="text" name="email" id="email" />
		</div>
		<div>
			<label>password</label>
			<input type="text" name="password" id="password" />
		</div>
		<div>
			<input type="submit" name="submit" id="submit" class="submit-button" value="Login" />
		</div>
	</form>
</div>