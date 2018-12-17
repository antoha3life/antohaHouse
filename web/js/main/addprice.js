
var antohaJS = {

    x: 1,
    showFirstInput: function () {
        $('#block_dop_pay').show();
        $('#btn_add').attr('onclick', 'antohaJS.addInputDopPrice()');
        $('#delete_btn_dop').append('<span onclick="antohaJS.removedInpurDop(1)">delete</span>');
    },
    addInputDopPrice: function () {
        var max_count = 5;
        console.log(this.x);

        if (this.x === 5){
            $('#btn_add').parent('div').hide();
        }else {
            $('#btn_add').parent('div').show();
        }


        if (this.x <= max_count){
            $('#count_input_dop').html(this.x);
            $('#block_dop_pay').append(
                '<div class="form-group field-paymenthouse-dop_pay-'+this.x+'">' +
                '<label class="control-label" for="paymenthouse-dop_pay-'+this.x+'">Дополнительные траты <span onclick="antohaJS.removedInpurDop('+this.x+')">delete</span></label>' +
                '<input type="text" id="paymenthouse-dop_pay-'+this.x+'" class="form-control" name="PaymentHouse[dop_pay]['+this.x+']">' +
                '</div>'
            );
            this.x++;
        }else {
            console.log('Превышен лемит добавления полей!!!')
        }

    },
    removedInpurDop: function (x, param) {
        if (param === 'yes') {
            $('.field-paymenthouse-dop_pay-1').hide();
            return false;
        }
        if (x===5){
            var c = x-1;
            $('#count_input_dop').html(c);
        }
        $('.field-paymenthouse-dop_pay-'+x).remove();
        $('#count_input_dop').html(x);
        if (c < 5){
            $('#btn_add').parent('div').show();
        }
    }

};

$(document).ready(function () {
   $('#add_price_house').on('click', function (e) {
       //e.preventDefault();
       var lng = $('#add_price_house .has-error').length;


   });
});

