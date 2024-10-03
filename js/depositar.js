function depositarModal(dato){
    $.ajax({
        url: './controller/depositarInversion.php',
        type: 'POST',
        data: {
            dato: dato
        },
        success: function(response) {
            $("#depositarModal").modal('show');
            $("#CantidadInversion").html(response);
            $("#PlanInversion").val(dato);
        }
    });
}

function cargarInversion(){
    dato = $("#PlanInversion").val();
    depositarModal(dato);
}