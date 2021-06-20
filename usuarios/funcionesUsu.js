
function validarContrasena(){//Funcion par validar contraseña
    let input = document.querySelector('#Contrasena').value;//Se extrae el valor del input de la contraseña
    let pasar=true;//Funcion para que el formlario pueda subirse

    if(!input.includes("+")&&!input.includes ("*")&&!input.includes (".")){//Detecta si no hay uno de lso simbolos especiales
        $("#alerta").append(`<div class="alert alert-danger" role="alert">La contraseña debe incluir al menos un símbolo (+*.)</div>`);
        pasar=false;
    }

    if(input.length<8){//Detecta si la contrseña es mayor a 8 caracteres
        $("#alerta").append(`<div class="alert alert-danger" role="alert">Las contraseña deben tener 8 caracteres como mínimo</div>`);
        pasar=false;
    }

    if(input.includes(" ")){//Detecta si la contraseña tiene esacios
        $("#alerta").append(`<div class="alert alert-danger" role="alert">Las contraseña no debe contener espacios</div>`);
        pasar=false;
    }

    return pasar;
}

$("form").submit(function (evento) {  //funcion de evento al tratar de subir el formulario
    var pasar=true;
    mantener = document.querySelector(".mantener").checked; //funcion para mantener usuaario
    console.log(mantener);
    $(".alert").detach();//Se eliminan alertas
    $('.entrada').each( function (indexInArray, valueOfElement) { //recorrido por las entradas y valores vacios
        if($(this).val() ==""){
            if($(this).attr("id")=="Contrasena"){
                if(!mantener){
                    $("#alerta").append(`<div class="alert alert-danger" role="alert">${$(this).attr('id')} se encuentra vacio</div>`);
                }
            }else{
                $("#alerta").append(`<div class="alert alert-danger" role="alert">${$(this).attr('id')} se encuentra vacio</div>`);
                pasar=false;
            }
        }
    });
    
    if(!pasar || (!mantener && !validarContrasena())){//condiciones para que se detenga el envio del formulario
        evento.preventDefault();
    }
});

$('document').ready(function(){
    generarCampos();
})

function generarCampos(){//Agregar estilos 

    if($("#tipo").val()=="estado"){
        $("#estado").css("display", "block");
        $("#tipo2").css("display", "none");
        $("#busqueda").css("display", "none");

    }else if($("#tipo").val()=="tipo"){
        $("#estado").css("display", "none");
        $("#tipo2").css("display", "block");
        $("#busqueda").css("display", "none");

    }else{
        $("#estado").css("display", "none");
        $("#tipo2").css("display", "none");
        $("#busqueda").css("display", "block");
    }

}