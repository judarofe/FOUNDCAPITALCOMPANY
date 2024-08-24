function Actualizar(idUser){
    $.ajax({
        url: 'tablaUser.php',
        type: 'POST',
        data:{
            idUser: idUser
        },
        success: function(data){
            let separado = data.split(",");
            let nombreInput = separado[0];
            let ApellidosInput = separado[1];
            let UserInput = separado[2];
            let EmailInput = separado[3];
            let Iduser = separado[4];

            $("#nombreInput").val(nombreInput);
            $("#ApellidosInput").val(ApellidosInput);
            $("#UserInput").val(UserInput);
            $("#EmailInput").val(EmailInput);
            $("#EmailInput").val(EmailInput);
            $("#Iduser").val(Iduser);

            $('#respuestaForm').modal('show');
            //console.log(data);
        }
    });
}