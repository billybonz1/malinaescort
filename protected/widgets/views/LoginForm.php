<div class="pull-right">
    <ul class="user-action-toolbar">
        <li><a class="icon-enter fancy-popup" href="#signin"><?=L::t('Login')?></a></li>
    </ul><!--/.user-action-toolbar-->
</div>
<div class="popup popup-l" id="signin" style="display: none">
    <div id="enter-popup" >
        <?php $this->render('application.modules.user.views.user.login',array('model'=>$userModel)); ?>
    </div>
    <div id="index"  style="display: none">
        <?php Yii::app()->runController('user/recovery') ?>
    </div>  
</div>
<div id="reg-popup" class="popup popup-l" style="display: none">
        <?php Yii::app()->runController('user/registration') ?>
</div>