$(document).ready(function() {
    $('#addReferidos').click(function() {
        var count = $('.referidosRegla').length;
        count++;

        if (count > 1){
            var resultado = count - 1;
            $('#btnreferidosRegla_'+resultado).hide();
        }
        var contenido = $('#LiderazgoBono').html();

        var nuevaRegla = '<div class="row referidosRegla align-items-center" id="referidosRegla_'+count+'"><div class="col"><div class="mb-3"><label for="porcentajeReferido" class="form-label">Porcentaje</label><input name="porcentajeReferido[]" type="number" class="form-control" min="0" aria-describedby="porcentajeReferidoHelp" value=""><div id="porcentajeReferidoHelp" class="form-text">Ingresa el porcentaje de ganancia por referido</div></div></div><div class="col"><div class="mb-3"><label for="referidosMinimos" class="form-label">Referidos mínimos</label><input name="referidosMinimos[]" type="number" class="form-control" min="0" aria-describedby="referidosMinimosHelp" value=""><div id="referidosMinimosHelp" class="form-text">Ingresa el total de referidos requeridos</div></div></div><div class="col"><select name="LiderazgoBono[]" id="LiderazgoBono_'+count+'" class="form-select" aria-describedby="LiderazgoBonoHelp" required>'+contenido+'</select></div><div class="col-1" id="btnreferidosRegla_'+count+'"><button type="button" class="btn btn-danger" onclick="eliminarRegla(\'referidosRegla_'+count+'\')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/></svg></button></div></div>';

        $('#referidosTotal').append(nuevaRegla);
    });

    $('#addInversion').click(function() {
        var count = $('.InversionRegla').length;
        count++;

        if (count > 1){
            var resultado = count - 1;
            $('#btnInversionRegla_'+resultado).hide();
        }

        var nuevaRegla = '<div class="row align-items-center InversionRegla" id="InversionRegla_'+count+'"><div class="col"><div class="mb-3"><label for="Inversion" class="form-label">Inversión</label><input name="Inversion[]" type="number" class="form-control" aria-describedby="InversionHelp" value="" required><div id="InversionHelp" class="form-text">Ingresa la inversion</div></div></div><div class="col-1" id="btnInversionRegla_'+count+'"><button type="button" class="btn btn-danger" id="addInversion" onclick="eliminarInversion(\'InversionRegla_'+count+'\')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/></svg></button></div></div>';

        $('#InversioTotal').append(nuevaRegla);
    });
});

function eliminarRegla(valor){

    var numero = parseInt(valor.split('_')[1]);
    var resultado = numero - 1;

    $('#'+valor).remove();
    $('#btnreferidosRegla_'+resultado).show();
}

function eliminarInversion(valor){

    var numero = parseInt(valor.split('_')[1]);
    var resultado = numero - 1;

    $('#'+valor).remove();
    $('#btnInversionRegla_'+resultado).show();
}

function eliminar(id, tabla){
    var resultado = confirm("¿Deseas eliminar el registro "+id+"?");
    if (resultado) {
        $.ajax({
            url:'EliminarRegistros.php',
            type: 'POST',
            data:{
                    identificador:id,
                    tabla:tabla
                },
            success:function(valor){
                alert (valor);
                location.reload();
            }
        });
    } else {
        alert("El registro esta a salvo");
    }
}