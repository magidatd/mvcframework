<?php
/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */
?>

<h1>Create an account</h1>

<form method="post" action="">
	<div class="row">
		<div class="col mb-3">
			<label for="firstname" class="form-label">Firstname</label>
			<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname">
		</div>
		<div class="col mb-3">
			<label for="lastname" class="form-label">Lastname</label>
			<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname">
		</div>
	</div>
	<div class="mb-3">
		<label for="email" class="form-label">Email</label>
		<input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Email">
		<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
	</div>
	<div class="mb-3">
		<label for="password" class="form-label">Password</label>
		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
	</div>
	<div class="mb-3">
		<label for="confirmPassword" class="form-label">Password</label>
		<input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
		       placeholder="Confirm Password">
	</div>
	<button type="submit" class="btn btn-primary">Register</button>
</form>