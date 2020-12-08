
class ajaxHandler{
    constructor(){

    }

    static sendRequest(act,req,func,param = ""){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                return func(this.response,param);
            }
        };
        xmlhttp.open("GET", "ajaxHandler.php?a=" + act+"&p="+req, true);
        xmlhttp.send();
    }
}