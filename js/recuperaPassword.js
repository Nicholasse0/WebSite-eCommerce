function validaCambiaPassword() {
    if (!validaEmail()) {
        return false;
    }
    else return true;
}

function validaForm(){
    var ctrl = false;
    var ctrl2 = false;
    
    if(document.formcodConferma.codConferma.value.length == 0){
        $("#codConferma").css("border-color","red");
        $("#inv_cod").show();
        $(".insCod").addClass("shakeMe");
        ctrl = true;
    }
    else{   
        $("#inv_cod").hide();
        $("#codConferma").css("border-color","rgb(40, 40, 231)");
    }

    if(document.formcodConferma.password.value.length == 0){
        $("#password").css("border-color","red");
        $("#inv_password").show();
        $(".insPassword").addClass("shakeMe");
        ctrl = true;
    }
    else{   
        $("#inv_password").hide();
        $("#password").css("border-color","rgb(40, 40, 231)");
    }

    if(document.formcodConferma.conferma_password.value.length == 0){
        $("#conferma_password").css("border-color","red");
        $("#inv_conf_password").show();
        $(".insConfPass").addClass("shakeMe");
        ctrl = true;
        ctrl2 = true;
    }
    else{   
        $("#inv_conf_password").hide();
        $("#conferma_password").css("border-color","rgb(40, 40, 231)");
    }

    if(document.formcodConferma.password.value != document.formcodConferma.conferma_password.value){
        if(!ctrl2){
            $("#conferma_password").css("border-color","red");
            $("#inv_conf_password_2").show();
            $(".insConfPass").addClass("shakeMe");
            ctrl = true;
        }
    }
    else{  
        if(!ctrl2){
            $("#inv_conf_password_2").hide();
            $("#conferma_password").css("border-color","rgb(40, 40, 231)");
        }
    }

    
    $(".insCod").click(function(){
        $(".insCod").removeClass("shakeMe");
    })
    $(".insPassword").click(function(){
        $(".insPassword").removeClass("shakeMe");
    })
    $(".insConfPass").click(function(){
        $(".insConfPass").removeClass("shakeMe");
    })

    if(ctrl == true){
        ctrl = false;
        return false;
    }
}