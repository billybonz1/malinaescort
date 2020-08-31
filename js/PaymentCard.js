function PaymentCard(paymentType){
    this.paymentType = paymentType;
    this.config = this.getConfig();
    this.add();
}

PaymentCard.prototype = {
    cardsListSelector: '#jsCardsList',
    add: function(){
        var these=this;
        
        this.containerValue=$('<div/>',{'class':"form-row"});
    	this.containerNumber=$('<div/>',{'class':"form-row"});
    	this.containerPassword=$('<div/>',{'class':"form-row"});
    	this.containerCheckBox=$('<div/>',{'class':"form-row"});
    	this.containerCheckValue=$('<div/>',{'class':"form-row"});
    	
        this.valueLabel=$('<label/>',{html:this.config.value});
        this.value=$('<input/>',{type:'text',name:'card[value][]','class':'textinput JSIntMask'});
        this.numberLabel=$('<label/>',{html:this.config.number});
        this.number=$('<input/>',{type:'text',name:'card[number][]','class':'textinput JSCardNumber'});
        this.passwordLabel=$('<label/>',{html:this.config.password});
        this.password=$('<input/>',{type:'text',name:'card[password][]','class':'textinput JSCardPassword'});

        if(this.paymentType == 'internet_cards') {
            this.check=$('<input/>',{
                type:'checkbox',
                name:'card[check][]',
                change:function(){$(this).parent().parent().parent().find('.JSCardCheck')[$(this).prop('checked')?'show':'hide']()}
            });
            this.checkLabel=$('<label/>',{html:this.config.check});
            this.checkLabel.append(this.check);
            this.check_value=$('<input/>',{type:'text',name:'card[check_value][]','class':'textinput JSCardCheck'})
            this.check_value.hide();
        };

        this.card = $('<div/>',{'class':'card'});

        with(this){
        	containerValue.append(valueLabel,value);
        	containerNumber.append(numberLabel,number);
        	containerPassword.append(passwordLabel,password);
        	
        	$(card).append(containerValue,containerNumber,containerPassword);
            if(this.paymentType == 'internet_cards'){
            	containerCheckBox.append(checkLabel);
            	containerCheckValue.append(check_value);
            	$(card).append(containerCheckBox,containerCheckValue);
            }
            $(cardsListSelector).append(this.card);
        }

        this.updateCounter().updateMask();
    },
    removeCard: function(){
        $(this.card).remove();
        this.updateCounter();
    },
    getConfig: function(){
        return eval($(this.cardsListSelector).data('config'));
    },
    updateCounter: function(){
        $(this.cardsListSelector).find('.counter').each(function(el){
            $(this).html('#'+(el+1));
        });
        return this;
    },
    updateMask: function(){
//        var conf = {placeholder:" "};
//        $('.JSIntMask').mask("9?99999",conf);
//        $('.JSCardNumber').mask("** ******",conf);
//        $('.JSCardPassword').mask("**** **** **** ****",conf);
//        $('.JSCardCheck').mask("?****************",conf);
    }
}