<?php
/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */
?>

<h1>Contact us</h1>

<form method="post" action="">
	<div class="mb-3">
		<label for="subject" class="form-label">Subject</label>
		<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
	</div>
	<div class="mb-3">
		<label for="email" class="form-label">Email</label>
		<input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Email">
		<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
	</div>
	<div class="mb-3">
		<label for="body" class="form-label">Content</label>
		<textarea class="form-control" id="body" name="body"></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>