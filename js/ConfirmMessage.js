confirmMessage = function(message, title, callbackConfirm, calbackDecline) {
    var newWindow=document.createElement('div');
    newWindow.id='dialog-confirm';
    newWindow.innerHTML=message;
    newWindow.title=title;

    $( newWindow ).dialog({
        modal:true,
        buttons:{
            "Yes": function() {
                $( this ).dialog( "close" );
                if(typeof callbackConfirm != 'undefined') callbackConfirm();
            },
            "No": function() {
                $( this ).dialog( "close" );
                if(typeof calbackDecline != 'undefined') calbackDecline();
            }
        }
    });
}