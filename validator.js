let x, y, r;

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("send").addEventListener("click", send)
    document.getElementById("reset").addEventListener("click", () => send_request('GET', 'clear.php'))
});

function send(){
    if(validateX() && validateY() && validateR()){
        document.getElementsByName("check_box").forEach(x1 => {
            if (x1.checked) {
                x = x1.value
            }
        })
        //y = parseFloat(document.getElementById("y").value.substring(0, 12).replace(',', '.'))
        y=1;
        y = document.querySelector("input[id=input_Y]").value.replace(",", ".");
        document.getElementsByName("radio_buttons").forEach(r1 => {
            if (r1.checked)
                r += r1.value
        })

        let params = "?x=" + x + "&y=" + y + "&r=" + r;
        send_request("GET", 'action.php', params)

    }
}

function send_request(method, url, params = '') {
    let xhr = new XMLHttpRequest();
    xhr.open(method, url + params, false)
    xhr.onload;
    xhr.send();
    if (xhr.status >= 400) {
        alert( xhr.status + ': ' + xhr.statusText );
    } else {
        if (xhr.responseText !== "")
            document.querySelector(".result_table").innerHTML = xhr.responseText
    }
}

function validateX() {
    let xButtons = document.getElementsByName("check_box");
    let checkCounter = 0;
    xButtons.forEach(x => {
        if (x.checked)
            checkCounter++;
    })
    if (checkCounter >= 2) {
        alert("Вы можете выбрать только одно значение X");
        return false;
    } else if (checkCounter === 0) {
        alert("Вы не выбрали значение X");
        return false;
    }
    return true;
}

function validateY(){
    y = document.querySelector("input[id=input_Y]").value.replace(",", ".").substring(0, 12);
    if(y === undefined){
        alert("Y не введён");
        return false;
    }
    else if (!isNumeric(y)){
        alert("Y не является числом");
        return false;
    } else if((y >= 5) || (y <= -5)){
        alert("Y не подходит");
        return false;
    }
    return true;
}

function validateR() {
    if (r === ""){
        alert("Значение R не выбрано")
        return false
    }
    return true
}

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function setR(object){
    let buttons = document.getElementsByName("r")

    for (let button of buttons) {
        button.removeAttribute("style")
    }
    object.setAttribute("style", "background-color: #C5AAE1")

    r = object.value
}