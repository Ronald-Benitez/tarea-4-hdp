$("form").submit(function (evento) {  //funcion de evento al tratar de subir el formulario
    var pasar=true;
    $(".alert").detach();//Se eliminan alertas
    $('.entrada').each( function (indexInArray, valueOfElement) { //recorrido por las entradas y valores vacios
        if($(this).val() ==""){
            $("#alerta").append(`<div class="alert alert-danger" role="alert">${$(this).attr('id')} se encuentra vacio</div>`);
            pasar=false;
        }
    });
    
    if(!pasar){//condiciones para que se detenga el envio del formulario
        evento.preventDefault();
    }
});