<ul class="links user-action-toolbar user-action-toolbar__tt_n  pull-right">
    <li>
        <?=CHtml::link(L::t('Home page'), Yii::app()->homeUrl);?>
        <?=UserModule::isAdmin()?CHtml::link(L::t('Admin zone'), array('/admin')):'';?>
        <?=CHtml::link(L::t('My profile'), array('/form/my'));?>
        <?=CHtml::link(L::t('Logout'), array('/user/logout'));?>
    </li>
</ul>