
function getData(chart,str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            let lastLab = chart.data.labels[chart.data.labels.length-1];
            let newValue = this.responseText;

            addData(chart,lastLab+10,newValue);

        }
    };
    xmlhttp.open("GET", "ajaxHandler.php?q=" + str, true);
    xmlhttp.send();
}
