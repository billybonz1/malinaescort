<div class="menu-stat box">
	<ul>
    	<?php foreach($this->items as $item): ?>
        	<li>
        	<?=isset($item['url'])
        		? CHtml::link(L::t($item['label']), $item['url'])
        		: L::t($item['label']); ?>
        	</li>
        <?php endforeach; ?>
	</ul>
    <div class="relax">&nbsp;</div>
</div>