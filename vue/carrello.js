var app = new Vue({
    el: '#app',
    data: {
        cart: parseInt(getCookie('carrello'))
    },
    methods: {
        addToCart: function () {
            var var1 = parseInt(document.getElementById('inp').value);
            var var2 = this.cart += var1;
            setCookie('carrello', var2, 30);
        },
        resetCartCount: function () {
            setCookie('carrello', 0, 30);
        }
    }
});


function aggiungi() {
    var qua = document.getElementById('inp').value;
    if (qua > 0) {
        var nom = document.getElementById('adt').value;
        var url_casa = document.getElementById('casa').href;
        var casa = url_casa + "?nome=" + nom + "&quanti=" + qua;
        
        axios.get(casa);
        
        return;
    }
}

async function del(id) {
    var url = "/Carrello/ShoppingBag.php?del=" + id;
    await axios.get(url);
    window.location.reload();
    return;
}

async function acquista() {
    var url = "/Carrello/ShoppingBag.php?checkout=";
    await axios.get(url);
    window.location.reload();
    return;
}