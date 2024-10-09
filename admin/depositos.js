function procesar(dato){
   Swal.fire({
        title: '¿Estás seguro?',
        text: "Estás a punto de aceptar el depósito.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            var datos = $("#dato_"+dato).val();
            $.ajax({
                url: 'depositosActualizar.php',
                type: 'POST',
                data:{
                    datos: datos,
                },
                success: function(data){
                    location.reload();
                }
            });
        }
    });
}


function aceptar(dato){
    var datos = $("#dato_"+dato).val();
    var datosArray = datos.split(",");
    $("#Procesar").modal("show");
    
    var arregloDatos = construccionResumen(datosArray);

    $("#BotonAceptar").attr("onclick", "finalizado("+datosArray[0]+")");
    $('#datosListado').html(arregloDatos);
    $('#tituloResumen').html("Finalizar depósito");
}

function finalizado(dato){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Estás a punto de cambiar el estado del deposito a 'Finalizado'.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            var datos = $("#dato_"+dato).val();
            var datosArray = datos.split(",");
        
            $.ajax({
                url: 'depositosActualizar.php',
                type: 'POST',
                data:{
                    idDeposito: datosArray[0],
                    valor: 2
                },
                success: function(data){
                    if(data === "OK"){
                        location.reload();
                    }else{
                        alert ("Error al actualizar registro");
                    }
                }
            });
        }
    });
}

function construccionResumen(datosArray){
    var inicio = new Date(datosArray[10]);
    var dias = parseInt(datosArray[8]);
    inicio.setDate(inicio.getDate() + dias);
    var final = inicio.toISOString().slice(0, 19).replace('T', ' ');
    //var meses = dias / 30;
    //var gananciaMensual = 
    //tener en cuenta la cantidad de dias por pago
    
    var arregloDatos = '<li class="list-group-item"><strong>Nombre: </strong>'+datosArray[2]+' '+datosArray[3]+'</li><li class="list-group-item"><strong>Correo: </strong>'+datosArray[4]+'</li><li class="list-group-item"><strong>Billetera: </strong>'+datosArray[9]+'</li><li class="list-group-item"><strong>Plan: </strong>'+datosArray[5]+'</li>';

    if (datosArray[6] != 0){
        arregloDatos = arregloDatos + '<li class="list-group-item"><strong>Ganancia: </strong>'+datosArray[6]+'%</li>';
    }else{
        arregloDatos = arregloDatos + '<li class="list-group-item"><strong>Ganancia: </strong>USD '+datosArray[7]+'</li>';
    }

    arregloDatos = arregloDatos + '<li class="list-group-item"><strong>Tiempo (días): </strong>'+dias+'</li><li class="list-group-item"><strong>Inicio: </strong>'+datosArray[10]+'</li><li class="list-group-item"><strong>Final: </strong>'+final+'</li><li class="list-group-item"><strong>Cantidad: </strong> USD '+datosArray[11]+'</li><li class="list-group-item"><a target="_blank" href="../controller/uploads/'+datosArray[12]+'" download><strong>Ver recibo: </strong><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\"><path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0\"/></svg></a></li>';

    return arregloDatos;
}