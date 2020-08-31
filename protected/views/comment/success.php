<div class='new-review box-bg'>
    <div class='indent'>
        <?=L::t( 'Yout comment has been added. Will be added after verification.')?>
    </div>
</div>
<script>
    setTimeout(function(){
        $.ajax({
            type: 'get',
            url: $('#jsAddCommentBlock').data('url'),
            success: function(data){
                $('#jsAddCommentBlock').html(data);
                initBtnDesign();
            }
        });
    },10000)
</script>