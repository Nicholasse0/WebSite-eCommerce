function validaForm(){
    var ctrl = false;
    var ctrl2 = false;
    if(document.formRec.nome.value.length == 0){
        $("#nome").css("border-color","red");
        $("#inv_nome").show();
        $(".insNome").addClass("shakeMe");
        ctrl = true;
    }
    else{   
        $("#inv_nome").hide();
        $("#nome").css("border-color","rgb(40, 40, 231)");
    }
    
    if(document.formRec.cognome.value.length == 0){
        $("#cognome").css("border-color","red");
        $("#inv_cognome").show();
        $(".insCognome").addClass("shakeMe");
        ctrl = true;
    }
    else{   
        $("#inv_cognome").hide();
        $("#cognome").css("border-color","rgb(40, 40, 231)");
    }

    if(document.formRec.email.value.length == 0){
        $("#email").css("border-color","red");
        $("#inv_email").show();
        $(".insEmail").addClass("shakeMe");
        ctrl = true;
    }
    else{   
        $("#inv_email").hide();
        $("#email").css("border-color","rgb(40, 40, 231)");
    }

    if(document.formRec.password.value.length == 0){
        $("#password").css("border-color","red");
        $("#inv_password").show();
        $(".insPassword").addClass("shakeMe");
        ctrl = true;
    }
    else{   
        $("#inv_password").hide();
        $("#password").css("border-color","rgb(40, 40, 231)");
    }

    if(document.formRec.conferma_password.value.length == 0){
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

    if(document.formRec.password.value != document.formRec.conferma_password.value){
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

    $(".insNome").click(function(){
        $(".insNome").removeClass("shakeMe");
    })
    $(".insCognome").click(function(){
        $(".insCognome").removeClass("shakeMe");
    })
    $(".insEmail").click(function(){
        $(".insEMail").removeClass("shakeMe");
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