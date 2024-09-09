function addBilletera(){
    var Billetera = $("#Billetera").val();
    var linkBilletera = $("#linkBilletera").val();
    var Iduser = $("#Iduser").val();

    if(Billetera === "" || linkBilletera === ""){
        alert ("Faltan datos por completar");
    }else{
        $.ajax({
            url: './controller/addBilletera.php',
            type: 'POST',
            data:{
                Billetera: Billetera,
                linkBilletera: linkBilletera,
                Iduser: Iduser
            },
            success: function(data){
                $("#resultadoBilletera").html(data);
                $("#Billetera").val("");
                $("#linkBilletera").val("");
            }
        });
    }
    
}

function eliminarBilletera(dato){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('¡Acción confirmada!', '', 'success');
            var Iduser = $("#Iduser").val();
            $.ajax({
                url: './controller/removeBilletera.php',
                type: 'POST',
                data:{
                    dato: dato,
                    Iduser: Iduser
                },
                success: function(data){
                    $("#resultadoBilletera").html(data);
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Acción cancelada', '', 'error');
            return;
        }
    });
}

function passActualizar(){
    var Iduser = $("#Iduser").val();
    var PassActual = $("#PassActual").val();
    var PassNueva = $("#PassNueva").val();
    var PassRepeat = $("#PassRepeat").val();

    $.ajax({
        url: './controller/passActualizar.php',
        type: 'POST',
        data:{
            PassActual: PassActual,
            PassNueva: PassNueva,
            PassRepeat: PassRepeat,
            Iduser: Iduser
        },
        success: function(data){
            if (data === "Bien"){
                Swal.fire('Contraseña actualizada con éxito', '', 'success');
                return;
            }else{
                Swal.fire({
                    title: "Acción cancelada",
                    text: data,
                    icon: "error"
                });
                return;
            }
        }
    });
}