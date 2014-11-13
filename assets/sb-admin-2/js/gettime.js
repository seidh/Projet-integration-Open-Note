var displayArea = document.getElementById("id39018");

// conver a number num to string, pad 0.
function format(num) {
    var xx = num.toString();
    if (xx.length === 1) {
        return "0" + xx;
    } else {
        return xx;
    }
}

function updateTimeDisplay() {
    var dd = new Date();
    var hh = dd.getHours();
    var mm = dd.getMinutes();
    var ss = dd.getSeconds();
    displayArea.firstChild.nodeValue= format(hh) + ":" + format(mm) + ":" + format(ss);
    setTimeout(updateTimeDisplay, 1000);
}

updateTimeDisplay();