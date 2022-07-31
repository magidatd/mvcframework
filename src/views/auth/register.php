<?php
/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */
?>

<h1>Create an account</h1>

<?php $form = \app\core\form\Form::begin('', "post") ?>
	<div class="row">
		<div class="col">
			<?php echo $form->field($model, 'firstname', 'First Name') ?>
		</div>
		<div class="col">
			<?php echo $form->field($model, 'lastname', 'Surname') ?>
		</div>
	</div>
	<?php echo $form->field($model, 'email', 'Email Address') ?>
	<?php echo $form->field($model, 'password', 'Password')->passwordField() ?>
	<?php echo $form->field($model, 'confirmPassword', 'Confirmation Password')->passwordField() ?>
	<button type="submit" class="btn btn-primary">Register</button>
<?php echo \app\core\form\Form::end() ?>