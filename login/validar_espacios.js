$("#formulario").submit(function (evento) {  //extraccion del formulario
    var pasar=true;//Comprobacion si se pasara sin datos vacios
    $(".alert").detach();
    $('.entrada').each( function (indexInArray, valueOfElement) { //busqueda a todos los datos de entrada
        if($(this).val() ==""){//si los valores estan vacios
            $("#alerta").append(`<div class="alert alert-danger" role="alert">${$(this).attr('id')} se encuentra vacio</div>`);
            pasar=false;//se desactiva el pase al logeo
        }
    });
    if(!pasar){
        $("#modalAlerta").modal("show");//Se muestra la modal de alerta
        evento.preventDefault();        //Se cancela el envio del formulario
    }
});

$("#ocultarModal").click(function () { //ocultar la modal con el boton
    $("#modalAlerta").modal("hide");
});

    