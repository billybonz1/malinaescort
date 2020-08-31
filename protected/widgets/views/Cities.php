<?php

$prefix='http://'.(($l=Language::getActive())!='ru'?$l.'.':'');
foreach($cities as $city)
    echo CHtml::link($city->name,"{$prefix}{$city->domain_alias}.natashaescort.com");