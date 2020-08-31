function Card(these){}
Card.prototype = {
    approve: function(these){
        if(!confirm('Are you sure that you want to approve the card?'))
            return false;
        this.url=$(these).attr('href');
        this.sendRequest();
    },
    decline: function(these){
        if(!confirm('Are you sure that you want to decline the card?'))
            return false;
        this.url=$(these).attr('href');
        this.sendRequest();
    },
    sendRequest: function(){
        $.ajax({
            url: this.url,
            context: document.body
        }).done(function(data) {
                $.fn.yiiGridView.update("card-grid")
            });
    }
};
var card = new Card();
