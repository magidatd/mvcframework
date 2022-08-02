<?php
	/*
 * Copyright (c) 2022. Magida Software - Tazvivinga Daniel Magida.
 */

	/** @var $model \app\models\LoginForm */
?>

<h1>Login</h1>

<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo $form->field($model, 'email',) ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<button type="submit" class="btn btn-primary">Login</button>
<?php echo \app\core\form\Form::end() ?>
