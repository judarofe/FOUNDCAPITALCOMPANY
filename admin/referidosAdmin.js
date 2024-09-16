$(document).ready(function() {
    $('#addReferidos').click(function() {
        var nuevaRegla = '<div class="row"><div class="col"><div class="mb-3"><label for="porcentajeReferido" class="form-label">Porcentaje</label><input name="porcentajeReferido[]" type="number" class="form-control" min="0" aria-describedby="porcentajeReferidoHelp" value=""><div id="porcentajeReferidoHelp" class="form-text">Ingresa el porcentaje de ganancia por referido</div></div></div><div class="col"><div class="mb-3"><label for="referidosMinimos" class="form-label">Referidos mínimos</label><input name="referidosMinimos[]" type="number" class="form-control" min="0" aria-describedby="referidosMinimosHelp" value=""><div id="referidosMinimosHelp" class="form-text">Ingresa el total de referidos requeridos</div></div></div></div>';

        $('#referidosTotal').append(nuevaRegla);
    });
});