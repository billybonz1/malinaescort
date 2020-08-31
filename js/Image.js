function FormImage(src,config){
    this.baseUrl = $('body').data('baseurl');
    this.src = src;
    this.config = config;
    removePlaceHolder();
    return $('#jsUploadedImages').prepend(this.createImage());
}
FormImage.prototype = {
    createImage: function(){
        var these = this;
        this.itemDiv = $('<div/>',{'class':'item'});
        this.img = $('<img/>',{src:this.baseUrl + '/images/forms/96x120/' + this.src});
        this.h = $('<h6/>',{html:'Фото'});
        this.photo = $('<div/>',{'class':'photo'});
        $(this.photo).append(this.img);
        this.a = $('<button/>',{html:'<span>Удалить</span>','class':'btn',click:function(){these.removeImg()}});

        this.input = $('<input/>',{
            type: 'hidden',
            value: this.src,
            name: 'Form[images][]'
        });
        with (this)
            $(itemDiv).append(h,photo,a,input);

        return this.itemDiv;
    },
    removeImg: function(){$(this.itemDiv).remove();addPlaceHolder();}
}
