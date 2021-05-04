function validaCredenziali(){
    ricordami();

    var ctrl = false;
    if(document.formLogin.email.value.length == 0){
        $("#email").css("border-color","red");
        $("#inv_email").show();
        $(".insEmail").addClass("shakeMe");
        ctrl = true;
    }
    else{   
        $("#inv_email").hide();
        $("#email").css("border-color","rgb(40, 40, 231)");
    }
    
    if(document.formLogin.password.value.length == 0){
        $("#password").css("border-color","red");
        $("#inv_password").show();
        $(".insPass").addClass("shakeMe");
        ctrl = true;
    }
    else{   
        $("#inv_password").hide();
        $("#password").css("border-color","rgb(40, 40, 231)");
    }

    
    $(".insEmail").click(function(){
        $(".insEMail").removeClass("shakeMe");
    })

    $(".insPass").click(function(){
        $(".insPass").removeClass("shakeMe");
    })

    if(ctrl == true){
        ctrl=false;
        return false;
    }
}

function ricordami() {  //Checca se l'utente ha accettato i cookies
    var cookie = getCookie("cookie");
    if (cookie == "accettati") {

        if (document.getElementById("checkBox").checked) {
            var user = document.form.email.value;
            var password = document.form.password.value;
            setCookie("user", user, 30);
            setCookie("password", password, 30);
            setCookie("check", "true", 30);
        }
        if (!(document.getElementById("checkBox").checked)) {
            var user = getCookie("user");
            if (user != "") {
                document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "password=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "check=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            }
        }
    }
}

function cookibar() {
    var cookie = getCookie("cookie");
    if (cookie != "accettati") {
        $(document).ready(function () {
            $("div.cookibar").animate({
                top: 0
            }, "slow")
        });
    }
    else {
        var user = getCookie("user");
        var password = getCookie("password");
        document.form.email.value = user;
        document.form.password.value = password;
        if (getCookie("check") == "true")
            document.getElementById("checkBox").checked = true;
        else document.getElementById("checkBox").checked = false;
    }
    setCookie("carrello", 0, 30);
}

function accettaCookies() {
    $(document).ready(function () {
        $("div.cookibar").animate({
            top: -100
        }, "slow")
    });
    setCookie("cookie", "accettati", 30);
}


function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}