
function validarContrasena(){
    let input = document.querySelector('#Contrasena').value;
    let pasar=true;

    if(!input.includes("+")&&!input.includes ("*")&&!input.includes (".")){
        $("#alerta").append(`<div class="alert alert-danger" role="alert">La contraseña debe incluir al menos un símbolo (+*.)</div>`);
        pasar=false;
    }

    if(input.length<8){
        $("#alerta").append(`<div class="alert alert-danger" role="alert">Las contraseña deben tener 8 caracteres como mínimo</div>`);
        pasar=false;
    }

    if(input.includes(" ")){
        $("#alerta").append(`<div class="alert alert-danger" role="alert">Las contraseña no debe contener espacios</div>`);
        pasar=false;
    }

    return pasar;
}

$("form").submit(function (evento) {  
    var pasar=true;
    mantener = document.querySelector(".mantener").checked;
    console.log(mantener);
    $(".alert").detach();
    $('.entrada').each( function (indexInArray, valueOfElement) { 
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
    
    if(!pasar || (!mantener && !validarContrasena())){
        evento.preventDefault();
    }
});

$('document').ready(function(){
    generarCampos();
})

function generarCampos(){

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