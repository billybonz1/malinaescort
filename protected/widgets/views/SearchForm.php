
    <?php if($this->controller->getM()):?>
        <aside id="filter" class="filter">
            <div class="filter__close"></div>
            <form class="filter-form"  action="<?=(Yii::app()->controller->action->id!='viewService')?Yii::app()->createAbsoluteUrl("form/ajaxSearch"):Yii::app()->createAbsoluteUrl("form/ajaxSearchService");?>" id="searchForm">
                <h2 class="filter-form__header">
                    <span><?=L::t('GIRLS SEARCH')?></span>
                </h2>

                <div class="filter-form__body">

<div class="girl-list filter-new">
	<div class="girl-list__row">
		<div class="form-group girl-list_col_2">
			<label class="checkbox">
				<input type="checkbox" id="pseudo_speak_english" value="1" class="serch">
				<span class="checkbox__fixture"></span>
                 <?=L::t('Speak English')?>
			</label>
		</div>
		<div class="form-group girl-list_col_2">
			<label class="checkbox">
				<input type="checkbox" id="pseudo_real_photo" value="1" class="serch">
				<span class="checkbox__fixture"></span>
                 <?=L::t('100% real')?>
				
			</label>
		</div>
	</div>
</div>

                    <div class="form-group">
                        <label for="yearOld1"><?=Yii::t('lang', 'Age:')?></label>
                        <div class="form-group__inner">
                            <?=CHtml::dropDownList('age',0,
                                array(
                                    '0'=>Yii::t('lang',"Doesn't mater"),
                                    '18-20'=>Yii::t('lang','18-20 years'),
                                    '21-23'=>Yii::t('lang','21-23 years'),
                                    '24-26'=>Yii::t('lang','24-26 years'),
                                    '27-29'=>Yii::t('lang','27-29 years'),
                                    '30-34'=>Yii::t('lang','30-34 years'),
                                    '35-39'=>Yii::t('lang','35-39 years'),
                                    '40-49'=>Yii::t('lang','40-49 years'),
                                    '50-58'=>Yii::t('lang','50-58 years'),
                                ),array("class"=>"form-control","id"=>"yearOld1"))
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input12"><?=Yii::t('lang', 'Rise:')?></label>
                        <div class="form-group__inner">
                            <?=CHtml::dropDownList('rise',0,
                                array(
                                    '0'=>Yii::t('lang',"Doesn't mater"),
                                    '150-156'=>Yii::t('lang',"150-156 cm"),
                                    '157-162'=>Yii::t('lang',"157-162 cm"),
                                    '163-168'=>Yii::t('lang',"163-168 cm"),
                                    '169-174'=>Yii::t('lang',"169-174 cm"),
                                    '175-180'=>Yii::t('lang',"175-180 cm"),
                                    '181-186'=>Yii::t('lang',"181-186 cm"),
                                    '187-192'=>Yii::t('lang',"187-192 cm"),
                                    '193-198'=>Yii::t('lang',"193-198 cm"),
                                    '199-205'=>Yii::t('lang',"199-205 cm"),
                                ),array("class"=>"form-control","id"=>"input12"))
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input10"><?=Yii::t('lang', 'Breast short:')?></label>
                        <div class="form-group__inner">
                            <?=CHtml::dropDownList('breast',0,
                                array(
                                    '0'=>Yii::t('lang',"Doesn't mater"),
                                    '1','2','3','3','4','5','6',
                                ),array("class"=>"form-control","id"=>"input10"))
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input14"><?=Yii::t('lang', 'Price:')?></label>
                        <div class="form-group__inner">
                            <?=CHtml::dropDownList('price',0,
                                array(
                                    '0' => Yii::t('lang', "Doesn't mater"),
                                    '800-1000' => Yii::t('lang', "800-1000 UAH"),
                                    '1000-1200' => Yii::t('lang', "1000-1200 UAH"),
                                    '1200-1400  ' => Yii::t('lang', "1200-1400 UAH"),
                                    '1400-1600' => Yii::t('lang', "1400-1600 UAH"),
                                    '1600-1800' => Yii::t('lang', "1600-1800 UAH"),
                                    '2000-2200' => Yii::t('lang', "2000-2200 UAH"),
                                    '2200-9999' => Yii::t('lang', "From 2200 UAH"),
                                ),array("class"=>"form-control","id"=>"input14"))
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input1"><?=Yii::t('lang', 'Hair:')?></label>
                        <div class="form-group__inner">
                            <?php echo CHtml::dropDownList('hair',0, array_map((function($el){return L::t($el);}), Yii::app()->params['hairs']),array("class"=>"form-control","id"=>"input1")
                            );?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input11"><?=Yii::t('lang', 'Weight:')?></label>
                        <div class="form-group__inner">
                            <?=CHtml::dropDownList('weight',0,
                                array(
                                    '0'=>Yii::t('lang',"Doesn't mater"),
                                    '41-50'=>Yii::t('lang',"41-50 kg"),
                                    '51-60'=>Yii::t('lang',"51-60 kg"),
                                    '61-70'=>Yii::t('lang',"61-70 kg"),
                                    '71-80'=>Yii::t('lang',"71-80 kg"),
                                    '81-90'=>Yii::t('lang',"81-90 kg"),
                                    '91-100'=>Yii::t('lang',"91-100 kg"),
                                ),array("class"=>"form-control","id"=>"input11"))
                            ?>
                        </div>
                    </div>
                </div>

                <div class="filter-form__controll">
                    <button type="reset" class="btn btn_filter"><?=L::t('Ochist')?></button>
					<input type="hidden" class="filter_dinamic_input" name="0" value="0">
					<input type="hidden" id="pagination_page" name="page" value="1">
					<input type="hidden" id="pagination_limit" name="limit" value="20">
					
					<input type="hidden" id="speak_english" name="speak_english" value="0">
					<input type="hidden" id="real_photo" name="real_photo" value="0">
					
					
                    <button class="btn btn_filter" type="submit" id="submitSearch"><?=L::t('Show')?></button>
                </div>
            </form>
        </aside>

    <?php else:?>
    <form class="form-horizontal" action="<?=(Yii::app()->controller->action->id!='viewService')?Yii::app()->createAbsoluteUrl("form/ajaxSearch"):Yii::app()->createAbsoluteUrl("form/ajaxSearchService");?>" id="searchForm">
        <fieldset class="filter container ">

            <div class="hide-filter">
                <span class="text-uppercase"> <?=L::t('GIRLS SEARCH')?></span>
                <a class="collapsed" role="button" data-toggle="collapse" data-parent=".form-horizontal" href="#smallFilter" aria-expanded="false">
                    <i class="icon-search"></i> <?=L::t('Show')?>
                </a>
            </div>

            <div id="smallFilter" class="panel-collapse collapse">
                <div  class="clearfix">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="input13" class="col-sm-4 control-label"><?=Yii::t('lang', 'Age:')?></label>
                            <div class="col-sm-8">
                                <?=CHtml::dropDownList('age',0,
                                    array(
                                        '0'=>Yii::t('lang',"Doesn't mater"),
                                        '18-20'=>Yii::t('lang','18-20 years'),
                                        '21-23'=>Yii::t('lang','21-23 years'),
                                        '24-26'=>Yii::t('lang','24-26 years'),
                                        '27-29'=>Yii::t('lang','27-29 years'),
                                        '30-34'=>Yii::t('lang','30-34 years'),
                                        '35-39'=>Yii::t('lang','35-39 years'),
                                        '40-49'=>Yii::t('lang','40-49 years'),
                                        '50-58'=>Yii::t('lang','50-58 years'),
                                    ),array("class"=>"form-control","id"=>"input13"))
                                ?>
                            </div>
                        </div><!--/.form-group-->

                        <div class="form-group">
                            <label for="input12" class="col-sm-4 control-label"><?=Yii::t('lang', 'Rise:')?></label>
                            <div class="col-sm-8">
                                <?=CHtml::dropDownList('rise',0,
                                    array(
                                        '0'=>Yii::t('lang',"Doesn't mater"),
                                        '150-156'=>Yii::t('lang',"150-156 cm"),
                                        '157-162'=>Yii::t('lang',"157-162 cm"),
                                        '163-168'=>Yii::t('lang',"163-168 cm"),
                                        '169-174'=>Yii::t('lang',"169-174 cm"),
                                        '175-180'=>Yii::t('lang',"175-180 cm"),
                                        '181-186'=>Yii::t('lang',"181-186 cm"),
                                        '187-192'=>Yii::t('lang',"187-192 cm"),
                                        '193-198'=>Yii::t('lang',"193-198 cm"),
                                        '199-205'=>Yii::t('lang',"199-205 cm"),
                                    ),array("class"=>"form-control","id"=>"input12"))
                                ?>
                            </div>
                        </div><!--/.form-group-->
                    </div><!--/.col-end-->

                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="input10" class="col-sm-4 control-label"><?=Yii::t('lang', 'Breast short:')?></label>
                            <div class="col-sm-8">
                                <?=CHtml::dropDownList('breast',0,
                                    array(
                                        '0'=>Yii::t('lang',"Doesn't mater"),
                                        '1','2','3','4','5','6',
                                    ),array("class"=>"form-control","id"=>"input10"))
                                ?>
                            </div>
                        </div><!--/.form-group-->

                        <div class="form-group">
                            <label for="input1" class="col-sm-4 control-label"><?=Yii::t('lang', 'Hair:')?></label>
                            <div class="col-sm-8">

                                <?php echo CHtml::dropDownList('hair',0, array_map((function($el){return L::t($el);}), Yii::app()->params['hairs']),array("class"=>"form-control","id"=>"input1")
                                );?>
                            </div>
                        </div><!--/.form-group-->
                    </div><!--/.col-end-->

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="input14" class="col-sm-4 control-label"><?=Yii::t('lang', 'Price:')?></label>
                            <div class="col-sm-8">
                                <?=CHtml::dropDownList('price',0,
                                    array(
                                        '0'=>Yii::t('lang',"Doesn't mater"),
                                        '250-350'=>Yii::t('lang',"250-350 UAH"),
                                        '351-450'=>Yii::t('lang',"351-450 UAH"),
                                        '451-500'=>Yii::t('lang',"451-500 UAH"),
                                        '501-600'=>Yii::t('lang',"501-600 UAH"),
                                        '601-750'=>Yii::t('lang',"601-750 UAH"),
                                        '751-999'=>Yii::t('lang',"751-999 UAH"),
                                        '1000-9999'=>Yii::t('lang',"From 1000 UAH"),
                                    ),array("class"=>"form-control","id"=>"input14"))
                                ?>
                            </div>
                        </div><!--/.form-group-->
                        <div class="form-group">
                            <label for="input11" class="col-sm-4 control-label"><?=Yii::t('lang', 'Weight:')?></label>
                            <div class="col-sm-8">
                                <?=CHtml::dropDownList('weight',0,
                                    array(
                                        '0'=>Yii::t('lang',"Doesn't mater"),
                                        '41-50'=>Yii::t('lang',"41-50 kg"),
                                        '51-60'=>Yii::t('lang',"51-60 kg"),
                                        '61-70'=>Yii::t('lang',"61-70 kg"),
                                        '71-80'=>Yii::t('lang',"71-80 kg"),
                                        '81-90'=>Yii::t('lang',"81-90 kg"),
                                        '91-100'=>Yii::t('lang',"91-100 kg"),
                                    ),array("class"=>"form-control","id"=>"input11"))
                                ?>
                            </div>
                        </div><!--/.form-group-->
                    </div><!--/.col-end-->

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="input19" class="col-sm-4 control-label"><?=L::t('Name:')?></label>
                            <div class="col-sm-8">
                                <input id="input19" type="text" class="form-control" name="name">

                            </div>
                        </div><!--/.form-group-->

                        <div class="form-group">
                            <label for="input20" class="col-sm-4 control-label"><?=L::t('P.')?>:</label>
                            <div class="col-sm-8">
                                <input id="input20" type="tel" name="cell_phone" class="form-control">
                            </div>
                        </div><!--/.form-group-->


                    </div><!--/.col-end-->

                    <div class="col-md-3">
						<input type="hidden" class="filter_dinamic_input" name="0" value="0">
						<input type="hidden" id="pagination_page" name="page" value="1">
						<input type="hidden" id="pagination_limit" name="limit" value="20">
                        <button class="btn btn-search btn-w_100 mt_15" type="submit" id="submitSearch"><i class="icon-search"></i><?=L::t('Show')?></button>

                    </div>
                </div>
            </div>
        </fieldset><!--/.filter-->
    </form>
        <?php endif;?>


<script>
	$('.filter-new .checkbox').click(function(){
		if ($("#pseudo_speak_english").prop('checked')) {
			$("#speak_english").val(1);
		} else {
			$("#speak_english").val(0);
		}
		if ($("#pseudo_real_photo").prop('checked')) {
			$("#real_photo").val(1);
		} else {
			$("#real_photo").val(0);
		}
		//$('#submitSearch').trigger('click');
	})
	
	
	
</script>