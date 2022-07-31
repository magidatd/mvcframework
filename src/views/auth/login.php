<?php
/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */
?>

<h1>Login</h1>

<form method="post" action="">
	<div class="mb-3">
		<label for="email" class="form-label">Email</label>
		<input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Email">
		<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
	</div>
	<div class="mb-3">
		<label for="password" class="form-label">Password</label>
		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
	</div>
	<button type="submit" class="btn btn-primary">Login</button>
</form>