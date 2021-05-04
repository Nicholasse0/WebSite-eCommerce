function validaForm(){
    var ctrl = false;
    if(document.formRecupera.email.value.length == 0){
        $("#email").css("border-color","red");
        $("#inv_email").show();
        $(".insEmail").addClass("shakeMe");
        return false;
    }
    else{   
        $("#inv_email").hide();
        $("#email").css("border-color","rgb(40, 40, 231)");
    }
}