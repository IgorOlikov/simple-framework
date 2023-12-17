<?php
/** @var $model \app\models\User */
?>
<h1>Create an account</h1>
<?php $form = \app\core\form\Form::begin('',"post") ?>

            <div class="row">
                <div class="col"></div>
                <?php echo $form->field($model,'firstname') ?>
                <div class="col"></div>

                <div class="col"></div>
                <?php echo $form->field($model,'lastname') ?>
                <div class="col"></div>

                <div class="col"></div>
                <?php echo $form->field($model,'email') ?>
                <div class="col"></div>

                <div class="col"></div>
                <?php echo $form->field($model,'password')->passwordField() ?>
                <div class="col"></div>

                <div class="col"></div>
                <?php echo $form->field($model,'confirmPassword')->passwordField() ?>
                <div class="col"></div>
            </div>


        <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>

