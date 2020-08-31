<?php $sn=$_SERVER['SERVER_NAME'];
$path=parse_url($_SERVER['REQUEST_URI'])['path'];
$path = str_replace('tr/', '',str_replace('en/', '', $path));?>
<?php if($this->controller->getM()):?>
    <ul class="language-nav">
        <?php  foreach($list as $lang):
             
            $langs=[
                'ru'=>'RU',
                'ua'=>'UA',
                'pl'=>'PL',
                'en'=>'EN',
                'tr'=>'TR',
            ]
            ?>
            <?php if($lang != 'ru'){ ?>
            <li><a class="language-nav__link" title="<?=$lang?>" href="https://<?php echo $sn.'/'.$lang.$path?>"><?=$langs[$lang]?></a></li>
            <?php } else { ?>
                <li><a class="language-nav__link" title="<?=$lang?>" href="https://<?php echo $sn.$path?>"><?=$langs[$lang]?></a></li>
            <?php } ?>
        <?php endforeach;?>
    </ul><!--/.country-list-->

<?php else:?>
    <div class="pull-left">
        <ul class="country-list">
            <?php  foreach($list as $lang):
                if($lang != 'ru'){ ?>
    
                <li><a class="icon-<?=$lang?>" title="<?=$lang?>" href="https://<?php echo $sn.'/'.$lang.$path?>"></a></li>
            <?php } else { ?>
                <li><a class="icon-<?=$lang?>" title="<?=$lang?>" href="https://<?php echo $sn.$path?>"></a></li>
            <?php } ?>
            <?php endforeach;?>
        </ul><!--/.country-list-->
    </div>
<?php endif?>
