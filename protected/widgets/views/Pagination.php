<div class="pagination-wrap clearfix">
	
	<?php $model = baners::model()->getBuners(10); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div  class="baner-full-width" ><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive" src="<?=$url;?>"></a></div>
    <?php endif; endforeach;?>
	
    <div id="Load_more" type="button" class="btn btn-default btn-load-more" data-limit="40">
        	<span><?=L::t("Load more")?></span>
			<span class="dots"></span>
    </div>
<!--    <nav aria-label="Page navigation">-->
<!--        <ul class="pagination">-->
<!--            <li class="lilac prev"><a href="#" aria-label="Previous" data-page="1"></a></li>-->
<!--            <li class="lilac prev double"><a href="#" aria-label="Previous" data-page="--><?//=($page-1!=0)?$page-1:1?><!--"></a></li>-->
<!--            --><?php //for($i=1;$i<=$pages;$i++):?>
<!--            <li --><?//=($i == $page)?'class="active"':''?><!-- ><a href="#" data-page="--><?//=$i?><!--">--><?//=$i?><!--</a></li>-->
<!--           --><?php //endfor;?>
<!--            <li class="lilac next"><a href="#" aria-label="Next" data-page="--><?//=($page+1!=$pages)?$page+1:$pages?><!--"></a></li>-->
<!--            <li class="lilac next double"><a href="#" aria-label="Next"  data-page="--><?//=$pages?><!--"></a></li>-->
<!--        </ul>-->
<!--    </nav>-->
</div>

<style>
	#Load_more{
		background: radial-gradient(farthest-corner at center top, #c1c2ba, #122b72);
		color: #000;
		border: none;
		text-transform: uppercase;
		border-radius: 8px;
		font-size: 14px;
		line-height: 1;
		padding: 10px 20px;
		width: 230px;
		text-align: center;
		margin: 15px auto;
		cursor: pointer;
	}
	#Load_more:hover, #Load_more:focus, #Load_more:active {
		opacity: 0.7;
	}
	
</style>