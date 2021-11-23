
(function ($) {
    "use strict";

    
    /*==================================================================
    [ Validate ]*/
    var nama = $('.validate-input input[name="nama"]');
    var nohp = $('.validate-input input[name="telp"]');
    var foto = $('.validate-input input[name="foto"]');
    var ket = $('.validate-input textarea[name="ket"]');


    $('.validate-form').on('submit',function(){
        var check = true;

        if($(nama).val().trim() == ''){
            showValidate(nama);
            check=false;
        }

        if($(foto).val().trim() == ''){
            showValidate(foto);
            check=false;
        }


        if($(nohp).val().trim() == ''){
            showValidate(nohp);
            check=false;
        }

        if($(ket).val().trim() == ''){
            showValidate(ket);
            check=false;
        }

        return check;
    });


    $('.validate-form .input1').each(function(){
        $(this).focus(function(){
           hideValidate(this);
       });
    });

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);