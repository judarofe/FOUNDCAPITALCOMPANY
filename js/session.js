$("#btnAcceso").click(function(){
    var proceder = true;

    var email = $("#EmailUser").val().trim();
    var pass = $("#passUser").val().trim();

    var err_form4 = /[\-_*./()&$!#%+=]/g;
    var err_form3 = /[\d]/g;
    var err_form2 = /[A-Z]/g;
    var err_form1 = /[a-z]/g;
    var err_form5 = /([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4})/g;
    var numeroCaracteres = pass.length;
    var palabras = pass.split(" ");

    if (err_form5.test(email) === false) {
        proceder = false;
    }

    if(numeroCaracteres < 8){
        proceder = false
    }
    
    if(!err_form1.test(pass)){
        proceder = false
    }

    if(!err_form2.test(pass)){
        proceder = false
    }

    if(!err_form3.test(pass)){
        proceder = false
    }

    if(!err_form4.test(pass)){
        proceder = false
    }

    if (palabras.length != 1) {
        proceder = false;
    }

    if(proceder === true){
        $.ajax({
            url: 'confirmar.php',
            type: 'POST',
            data: {
                email: email,
                pass: pass
            },
            success: function(response) {
                if (response == "ok"){
                    $('#subscribe').submit();
                }else{
                    $('#respuesta').text(response);
                }
            }
        });

    }else{

        $("#EmailUser").removeClass("is-valid").addClass("is-invalid");
        $("#passUser").removeClass("is-valid").addClass("is-invalid");
    }
    
});