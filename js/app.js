var width_html = 0;
var height_html = 0;
var $cur  = '';
$(document).ready(function(){
    var baseUrl = $('body').data('baseurl');
    var city = $('body').data('city');
    $('#JSCityList').live('change',function(){
        initLocation();
    });
    if(city){
        $('#JSCityList').val(city);
        initLocation();
    }
    $(document).bind('scroll ready',function() {
        $.each($('.formImage'),function(el){isScrolledIntoView(this)})
    });


    // Form tabs for multi language
    $('.forms_edit').hide();
    $('#form_'+(activeLang = $('body').data('language'))).show();
    $('.jsLangPick[data-lang='+activeLang+']').addClass('active');
    $('.jsLangPick').click(function(){
        $('.jsLangPick').removeClass('active');
        $(this).addClass('active');
        $('.forms_edit').hide();
        $('#form_'+$(this).data('lang')).show();
        return false;
    });
    // Payment create
    initVipCheckBox();
    // payment request
    var input = $('#jsPaymentType input[type=radio]:checked');
    if(input.length)
        changePaymentType(input.val());
    $('#jsPaymentType input[type=radio]').change(function(){
        changePaymentType($(this).val());
    });

    $('#jsAddCard').click(function(){
        new PaymentCard(paymentType)
    });
    $('#jsRemoveCard').click(function(){
    	$('#jsCardsList .card:last').remove();
    });

    $( "#jsUploadedImages" ).sortable().disableSelection();

    $(function() {
        var config = eval($('#jsUploadedImages').data('config'));
        var maxSize = 2 * 1000 * 1024;
        var extsAllowed = ['gif', 'GIF', 'png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'];

        $('.fileUploader').on('change', '#jsFilesUpload', function(event) {
            var files = event.target.files;
            var errorMsg = '';
            var validFiles = new Array(files.length);

            for (var i = 0; i < files.length; i++) {
                var isValidFile = true;
                var file = event.target.files[i];
                var name = file.name;
                var ext = name.split('.').pop().toLowerCase();
                if ($.inArray(ext, extsAllowed) === -1) {
                    errorMsg  += 'Some files were not added to the queue:';
                    isValidFile = false;
                }

                if (file.size > maxSize) {
                    errorMsg  += '\nThe file "' + file.name + '" exceeds the size limit (' + maxSize + ' bytes).';;
                    isValidFile = false;
                }
                validFiles[i] = isValidFile;
            }

            if (errorMsg.length > 0) {
                alert(errorMsg);
            }

            for (var i = 0; i < files.length; i++) {
                if (validFiles[i]) {
                    var formData = new FormData();
                    formData.append('Filename', files[i].name);
                    formData.append('Filedata', files[i]);

                    $.ajax({
                        type: 'POST',
                        url: '/uploader/upload',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(fileName) {
                            new FormImage(fileName, config);
                            $( "#jsUploadedImages" ).sortable().disableSelection();
                        }
                    });
                }
            }
            $(this).val('');
        });

        var arr = $('#jsUploadedImages').data('images');

        for(var el in arr){
            new FormImage(arr[el],config);
        }
        arr=arr||[];

        for(var i=arr.length;i<4;i++){
            addPlaceHolder();
        }

        // initBtnDesign();
    });

    $('#submitSearch').click(function(){
        $('#JSFormsList').empty().addClass('preloader');
        $.ajax({
            url: $('#searchForm').attr('action'),
            data: $('#searchForm').serialize(),
            success:function(data){
                $('#JSFormsList').removeClass('preloader').html(data);
                $('html, body').animate({scrollTop: $("#JSFormsList").offset().top-25}, 500);
                initIntemsOverlay();
                $.each($('.formImage'),function(el){isScrolledIntoView(this)})
                initCarusel();
            },
            error: function(data) {}
        });
        return false;
    });

    $('a.more-link').click(function(){
        $(this).parent().parent().find('.row.hidden').removeClass('hidden');
        $(this).parent().remove();
        return false;
    });

    $('#comment-form').live('submit',function(){
        var form = $(this);
        var action = form.attr('action');
        form.append($('<div/>',{'class':'preloader'}));
        $.ajax({
            type: 'post',
            url: action,
            data: form.serialize(),
            success: function(respond){
            	$('#jsCommentForm').replaceWith(respond);
                initBtnDesign();
            }
        });
        return false;
    });

    $('#jsLoginForm,#jsRegistrationForm,#jsContactForm, #jsForgetPass, #jsSmsForm').live('submit',function(){
        var form = $(this);
        var action = form.attr('action');
        form.append($('<div/>',{'class':'preloader'}));
        $.ajax({
            type: 'post',
            url: action,
            data: form.serialize(),
            success: function(respond){
                if(respond==1){
                    window.location.reload();
                }
                else if(respond.length<100){
                    window.location=respond;
                }
                else{
                    form.parent().html(respond);
                    initBtnDesign();
                }
            }
        });
        return false;
    });
    $('.no_photoshop_approved,.JSCommentStatus').live('change',function(){
    	var action = $(this).data('url');
    	var data = 'val='+$(this).is(':checked');
    	$.ajax({
            type: 'get',
            url: action,
            data: data,
            success: function(respond){}
        });
    });
    $('.approveForm').click(function(){
        var action = $(this).attr('href');
        var these = this;
        $.ajax({
            type: 'get',url: action,data: 'val=true',
            success: function(respond){$(these).parent().remove()}
        });
        return false;
    });

    initBtnDesign();

    $('.show-hidden-block').live('click',function(){
        $(this).parents('.form-box').toggleClass('open');
        if (($(this).parents('.form-box').hasClass('open')) && ($(this).hasClass('text-link'))) {$(this).text($('body').data('hide'));}
        if ((!$(this).parents('.form-box').hasClass('open')) && ($(this).hasClass('text-link'))) {$(this).text($('body').data('show'));}
        $(this).parents('.form-box').find('.hidden-box').slideToggle('slow');
    })

    initCarusel();

    initIntemsOverlay();

    width_html = $(document).width();
    height_html = $(window).height();
    $(window).resize(function() {
        width_html = $(document).width();
        height_html = $(window).height();
    })

    $('.show-popup').live('click',function(){
        if ($('.overlay:hidden').length > 0) {
            var max_height = $(document).height();
            $('.overlay').css('width', width_html).css('height',max_height).show();
        }
        var cur_rel = $(this).data('rel');
        var width_popup =  $('#' + cur_rel).width();
        var left_pos_popup = (width_html - width_popup)/2;
        if ($('.popup:visible').length > 0) {
            $('.popup').fadeOut(300, function(){
                $('#' + cur_rel).css('left', left_pos_popup).fadeIn(500);
            })
        } else {$('#' + cur_rel).css('left', left_pos_popup).fadeIn(500);}

        $('#'+cur_rel+' input[type=text]:first').focus();
    });

    $('.popup .close-btn, .overlay').live('click',function(){close_popup();})

    $(document).live('keydown',function(e) {

        e.keyCode == 27 && close_popup();

        if (e.keyCode == 39) {
            $('.profile-photos-area .main-photo .next-photo, .btn-slider.next').click();
        }
        if (e.keyCode == 37) {
            $('.profile-photos-area .main-photo .prev-photo, .btn-slider.prev').click();
        }
    });

    $('.show-pass').live('click',function(){
        $('#' + $(this).data('rel')).slideDown(200);
    });

    if ($('.pay-box .row input[type="radio"]:checked').length > 0) {
        $('.pay-box .row input[type="radio"]:checked').parents('.row').addClass('selected');
    }

    $('.pay-box .left-col .row:not(".title")').live('click',function(){
        if (!$(this).hasClass('selected') && !$(this).hasClass('last')) {
            $('.pay-box .row.selected').removeClass('selected');
            $(this).addClass('selected').find('input[type="radio"]').attr('checked', 'true');
        }
    });

    var cur_src,cur_title,img = '';
    if(!($('.profile-photos-area .main-photo .photo img').length > 0) && ($('.profile-photos-area .slider-box .item').length > 0)) {
        var seletor='.profile-photos-area .slider-box .item:first a';
        cur_src = $(seletor).attr('rel');
        cur_title = $(seletor).attr('title');
        var original = $(seletor).attr('href');
       loadImg(cur_src,original,cur_title);
        $('.profile-photos-area .slider-box .item:first').addClass('active');
    }

    $('.profile-photos-area .slider-box .item a').click(function(){
        if($(this).parent('.item').hasClass('active')) {return false;}
        $('.profile-photos-area .slider-box .item.active').removeClass('active');
        cur_src = $(this).attr('rel');
        cur_title = $(this).attr('title');
        var original = $(this).attr('href');

       loadImg(cur_src,original,cur_title);
        $(this).parent('.item').addClass('active');
        return false;
    });

    if($('img.round').length>1){
        var sel='.profile-photos-area .slider-box .item.active a';
        $('.profile-photos-area .main-photo .next-photo').live('click',function(){
            if (!($('.profile-photos-area .slider-box .item.active').is(":last-child"))){
                $('.profile-photos-area .slider-box .item.active').removeClass('active').next().addClass('active');
                cur_src = $(sel).attr('rel');
                cur_title = $(sel).attr('title');
                var original = $(sel).attr('href');
               loadImg(cur_src,original,cur_title);
                $('.slider-box .next').click();
            }
        });

        $('.profile-photos-area .main-photo .prev-photo').live('click',function(){
            if (!($('.profile-photos-area .slider-box .item.active').is(":first-child"))){
                $('.profile-photos-area .slider-box .item.active').removeClass('active').prev().addClass('active');
                cur_src = $(sel).attr('rel');
                cur_title = $(sel).attr('title');
                var original = $(sel).attr('href');
               loadImg(cur_src,original,cur_title);
                $('.slider-box .prev').click();
            }
        });
    }

    $('#Form_cell_phone').mask("+380?999999999",{placeholder:"_"});
    //$('#SmsForm_phone').mask("+",{placeholder:"_"});

    if(!$('input[type=radio]:checked').val()) {
        $('input[type=radio]:eq(1)').attr('checked', true);
        $('input[type=radio]:eq(1)').parent().parent().addClass('selected');
    }
    $('#jsNewForms input[type=button], #evidencePhoto input[type=button]').live('click',function(){
        var these=this;
        var url=$(this).data('url');
        $.ajax({type: 'get',url: url,success: function(){$(these).parent().remove()}});
    });

    $('.jsAmount').live('change',function(){
        var amount=$(this).val();
        var url=$(this).data('saveurl');
        $.ajax({type: 'get', data: "amount="+amount, url: url,success: function(){}});
    });
    $('.jsValue').live('change',function(){
        var value=$(this).val();
        var url=$(this).data('saveurl');
        $.ajax({type: 'get', data: "value="+value, url: url,success: function(){}});
    });
    $('.jsProlong').live('click',function(){
        var value=$(this).parent().find('.jsProlongValue').val();
        var url=$(this).data('url');

        $('.jsProlong').attr('disabled',true);

        $.ajax({type: 'get', data: "value="+value, url: url, success: function(){
            $.fn.yiiGridView.update("form-grid");
        }});
    });

    $('#jsRemind,#jsClearCache').live('click',function(){
        if(!confirm($(this).data('msg')))return false;
        $(this).attr('disabled',true);
        var these=this;
        var url=$(this).data('link');
        $.ajax({type: 'get', url: url, success: function(data){
            $(these).removeAttr('disabled');
            alert(data);
        }});
    })

    $('#jsShowFormsAreClosed').click(function(){$.fn.yiiGridView.update('form-grid', {url:$('#jsGridSearch').data('url')+'?Form[payed_till]=1'}); $(this).hide(); $('#jsShowAllForms').show()});
    $('#jsShowAllForms').click(function(){$.fn.yiiGridView.update('form-grid', {url:$('#jsGridSearch').data('url')}); $(this).hide(); $('#jsShowFormsAreClosed').show()});
});

function close_popup() {
    $('.popup').fadeOut('500', function(){$('.overlay').hide();})
}

function loadImg(src,original,title) {
    $('.profile-photos-area .main-photo .photo').addClass('loader');
    var img = $('<img/>',{src:src,title:title,alt:title});

    $(img).click(function(){$('.imageLink[href="'+original+'"]').click()});
	$('.sing').click(function(){$(img).click()});
	$('.sing_en').click(function(){$(img).click()});
    $('.profile-photos-area .main-photo .photo').html(img);
    $('.profile-photos-area .main-photo .photo img').load(function(){
        $('.profile-photos-area .main-photo .photo').removeClass('loader');
    });

    $('.imageLink').colorbox({rel:'imageLink',maxHeight:'100%',maxWidth:'100%',current:'{current} / {total}',title:title,alt:title});
};

function mycarousel_initCallback(carousel) {
    if($('img.round').length<=1) return;
    $('.slider-box .next').bind('click', function() {
        carousel.next();
        return false;
    });
    $('.slider-box .prev').bind('click', function() {
        carousel.prev();
        return false;
    });
}

function initIntemsOverlay(){
    if ($('.all-photo-box .item').length > 0) {
        var width_box,height_box,left_pos,top_pos;
        $('.all-photo-box .item .photo img').live('mousemove',function(e){
            if ($(this).parents('.item').find('.info').length > 0) {
                var par=$(this).parents('.item').find('.info');
                var image=par.find('img');

                if(image.attr('src')=='#') image.attr('src',image.data('img'));

                width_box = par.width();
                height_box = par.height();
                if ((e.clientX + width_box + 30) <= width_html){left_pos = e.pageX + 30;} else {left_pos = e.pageX - width_box - 30;}
                par.css('left', left_pos);

                if ((e.clientY + height_box + 30) <= height_html){top_pos = e.pageY + 30;} else {top_pos = e.pageY - height_box - 10;}
                par.css('top', top_pos);
            }
        })
    }
}

function initBtnDesign(where){
    where=where||'body';

    $(where).find( ".btn" ).each(function(){
        if($(this).find('span').length<=1){
            if($(this).children('span').length > 1){
                $cur  = $(this).children('span').html();
                $(this).find('span').remove();

            } else {
                $cur = $(this).html();
                $(this).empty();
            }

            $(this).html('<span class="left-bg">&nbsp;</span><span class="bg"><span class="icon">'+$cur+'</span></span><span class="right-bg">&nbsp;</span>');
        }
    });
}


function updatePrice(prices){
    var id = $('#Payment_days').val()-1 ;
    var isVip = $('#Payment_vip:checked').val();
    $('#jsTotalPrice').html(isVip ? prices[id].priceVip : prices[id].price);
}

function changePaymentType(type){
    paymentType = type;
    var isVM=type=='webmoney';

    $('.extra-content .warning')[isVM?'show':'hide']();

    var act=isVM?'hide':'show';

    $('#jsCardsList').empty()[act]();
    $('.textinput.JSCardCheck').hide();

    if(!isVM)
    	new PaymentCard(type);

    $('.control-area')[act]();
}

function initVipCheckBox(){
    $('#JSPlaceInVIP').is(':checked') && priceDetection();

    $('#JSPlaceInVIP').change(function(){
        priceDetection();
    });
}

function priceDetection(){
    if($('#JSPlaceInVIP').is(':checked') == true){
        $('#payment-form .col.price').hide();
        $('#payment-form .col.price_vip').show();
    }
    else {
        $('#payment-form .col.price').show();
        $('#payment-form .col.price_vip').hide();
    }
}

function showMessage(title, message){
    var overlay=$('<div/>',{'class':'overlay','style':'height:'+$(document).height()+'px'});
    var popup=$('<div/>',{'class':'popup','style':"left:"+($(document).width()/2-150)+"px;display:block;width:300px;background:#000"});
    var container=$('<div/>',{'class':'container form'});
    var div=$('<div/>');
    var message=$("<div/>",{'class':'flash-success','html':message})
    div.append($('<h4/>',{'html':title}),message,$('<div/>',{'class':'relax'}));
    container.append(div);
    popup.append($('<a/>',{'class':'close-btn','html':'x','href':'#'}),container);
    $('body').append(overlay,popup);
    $(popup).fadeIn(500);
    $(overlay).fadeIn(500);
}
function addPlaceHolder(){
    if($('#jsUploadedImages .item').length>=4) return;
    var item=$('<div/>',{'class':'item place'});
    var photo=$('<div/>',{'class':'photo'});
    item.append($('<h6/>',{'html':'&nbsp;'}),photo,$('<br/>'));
    $('#jsUploadedImages').prepend(item);
};
function removePlaceHolder(){
    $('#jsUploadedImages .item.place:first').remove();
}

function initLocation(cId,areaId,subwayId){
    var json = $('#JSCityList').data('data');
    $('#JSSubwayList, #JSAreaList').html($('<option/>',{value:0, html:'-'}));

    if(cId)
        $('#JSCityList').val(cId);

    var cityID=$('#JSCityList').val();

    if((typeof cityID == 'undefined') || cityID==0){
        return;
    }
    var list = json[cityID];
    var sw=list.subways;
    var ar=list.areas;
    for(var id in sw){
        $('#JSSubwayList').append($('<option/>',{value:id, html:sw[id]}));
    }
    for(var id in ar){
        $('#JSAreaList').append($('<option/>',{value:id, html:ar[id]}));
    }

    if(areaId)
        $('#JSAreaList').val(areaId);

    if(subwayId)
        $('#JSSubwayList').val(subwayId);
}

function selectFrom(id) {
    var el=$('.select-on-check[value='+id+']').parent().parent();
    el.addClass('selected');
    $('html, body').animate({scrollTop: el.position().top-100}, 500);
}

function initEditor(){
    var image = $('#jsImageEditor img').imgAreaSelect({
        aspectRatio: '14:19',
        onSelectChange: preview,
        instance: true
    });

    $('#jsImageEditor').scroll(function(){
        image.cancelSelection();
        $("#x1,#y1,#x2,#y2,#w,#h").val('');
    });

    function preview(img, selection) {
        var scaleX = 100 / selection.width;
        var scaleY = 100 / selection.height;

        $("#thumbnail + div > img").css({
            width: Math.round(scaleX * 200) + "px",
            height: Math.round(scaleY * 300) + "px",
            marginLeft: "-" + Math.round(scaleX * selection.x1) + "px",
            marginTop: "-" + Math.round(scaleY * selection.y1) + "px"
        });
        $("#x1").val(selection.x1);
        $("#y1").val(selection.y1);
        $("#x2").val(selection.x2);
        $("#y2").val(selection.y2);
        $("#w").val(selection.width);
        $("#h").val(selection.height);
    }
}

function isScrolledIntoView(elem)
{
    if($(elem).attr('src')!='#') return;

    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    if((elemBottom <= docViewBottom) && (elemTop >= docViewTop)){
        $(elem).attr('src',$(elem).data('img'));
    }
}

function initCarusel(){
    if ($('.slider-box div').length > 0) {
        // $('.slider-box ul').jcarousel({
        //     initCallback: mycarousel_initCallback,
        //     scroll: 1,
        //     buttonNextHTML: null,
        //     buttonPrevHTML: null,
        //     wrap: 'circular'
        // });
     $('.mainSlider').slick({
        slidesToShow: 6,
        prevArrow: '.btn-slider.prev',
        nextArrow: '.btn-slider.next',
         responsive: [
        {
          breakpoint: 1040,
          settings: {
            slidesToShow: 5
          }
        },
        {
          breakpoint: 770,
          settings: {
            slidesToShow: 4
          }
        },
        {
          breakpoint: 540,
          settings: {
            slidesToShow: 1
          }
        }
      ]
      });
     $('.pageSlider').slick({
        slidesToShow: 4,
        prevArrow: '.btn-slider.prev',
        nextArrow: '.btn-slider.next',
         responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 930,
          settings: {
            slidesToShow: 5
          }
        },
        {
          breakpoint: 650,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 500,
          settings: {
            slidesToShow: 2
          }
        },
      ]
      });
    }
}
function urlclick(id){
    $.ajax(
        {
            type: 'POST',
            url: '/site/ajaxurlclick',
            data: {id:id},
            success: {
            }
        }
    )
}
/*$(document).on('click', '.close-baner', function(event) {
    event.preventDefault();
    $(this).closest('.news-baner').hide(200);
});*/
$(document).on('click', '.close-baner', function(event) {
    event.preventDefault();
    $(this).closest('.news-baner').hide(200);
    $(this).closest('.news-baner-static').hide(200);
});
$(document).ready(function(){
    function setEqualHeight(columns){
        var tallestcolumn = 0;
        columns.each(
        function()
        {
        currentHeight = $(this).height();
        if(currentHeight > tallestcolumn)
        {
        tallestcolumn = currentHeight;
        }
        }
        );
        columns.height(tallestcolumn);
    };
    setEqualHeight($('artical-list-inner .artical-item'));
});

