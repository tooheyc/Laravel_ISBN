// Using vanilla Ajax here, not jQuery.
function getHTTPObject() {
    if (window.ActiveXObject)
        return new ActiveXObject("Microsoft.XMLHTTP");
    else if (window.XMLHttpRequest)
        return new XMLHttpRequest();
    else {
        // Ajax not supported!
        return null;
    }
}

function changeText(myphpurl, data, setchangedstate) {
    httpObject = getHTTPObject();
    // If Ajax is supported, send the request.
    if (httpObject != null) {
        httpObject.open("GET", myphpurl, true);
        httpObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpObject.send(data);
        httpObject.onreadystatechange = setchangedstate;
    } else {
        alert("Your browser does not support AJAX.");
    }
}

// Show the response from the server.
function showValidity() {
    if (httpObject.readyState == 4 && httpObject.status == 200) {
        if (httpObject.responseText != "") {
            var response = JSON.parse(httpObject.responseText);
            setFormResponse(setResponses(response));
        }
    }
}

function setResponses(response) {
    var allGood = true;
    for (var prop in response) {
        if (response[prop].vResponse.valid) {
            document.getElementById(prop + "Resp").innerHTML = "";
        } else {
            allGood = false;
            document.getElementById(prop + "Resp").innerHTML = response[prop].vResponse.err;
        }
    }

    return allGood;
}

function setFormResponse(Good) {
    var respond = document.getElementById('responder');
    if (Good) respond.className = "goodResponse"; else respond.className = "goodResponseHide";
}

// Grab the book number and send it in a request to the server to validate it.
function validator() {
    var isbn = document.getElementById("isbn").value;
    var copyright = document.getElementById("copyright").value;
    var bookName = document.getElementById("bookName").value;
    var bookAuthor = document.getElementById("bookAuthor").value;
    var myData = 'isbnAjax?isbn=' + isbn + '&copyright=' + copyright + '&bookName=' + bookName + '&bookAuthor=' + bookAuthor;

    changeText(myData, '', showValidity);
}

function clearEntries() {
    var ids = ['isbn', 'copyright', 'bookName', 'bookAuthor' ];
    for(var i in ids) {
        document.getElementById(ids[i]).value = "";
        document.getElementById(ids[i]+"Resp").innerHTML = "";
    }
    setFormResponse(false);
}

