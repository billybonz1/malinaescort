<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
    <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>
<?php endif; ?>
    <?php echo CHtml::beginForm(array('/user/login'),'post',array('id'=>'jsLoginForm','class'=>'form')); ?>
    <form class="form">
        <h2 class="popup-title"><?=L::t('LOGIN FOR GIRLS')?></h2>
        <?php echo CHtml::errorSummary($model); ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <?php echo CHtml::activeLabelEx($model,'username'); ?>
                    <?php echo CHtml::activeTextField($model,'username',array('class'=>'form-control')) ?>
                </div>

                <div class="form-group">
                    <?php echo CHtml::activeLabelEx($model,'password'); ?>
                    <?=CHtml::link(L::t('Forgot password?'),'#index',array('data-rel'=>'forget-pass','class'=>'link pull-right collapsed','aria-expanded'=>'false'))?>
                    <?php echo CHtml::activePasswordField($model,'password',array('class'=>'form-control',)) ?>
                    <?=CHtml::link(L::t('Registration'),'#reg-popup',array('data-rel'=>'register_user','class'=>'link fancy-popup pull-right'))?>
                </div>
            </div>

            <div class="col-xs-12 mt_15 text-center">
                <button class="btn btn-search" type="submit"><?=L::t('Login')?></button>
            </div>
        </div>
    </form>
    <?php echo CHtml::endForm(); ?>

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>