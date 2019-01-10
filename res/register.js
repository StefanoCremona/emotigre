function setUp() {
    if (!document.getElementById("registerForm")) return;
    document.getElementById("registerForm").addEventListener("submit", function() {
        screenName = document.getElementById("screenName").value;
        password = document.getElementById("password").value;
        register(screenName, password);
    });
}

function showSpinner() {
    document.getElementById("spinner").style.visibility = "visible";
}
function hideSpinner() {
    setTimeout(function() {
        document.getElementById("spinner").style.visibility = "hidden";
    }, 500);
}

function register(screenName, password) {
    if (!screenName || !password) {
        alert('Fill the fields, Please!');
        return false;    
    }

    showSpinner();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            switch (this.status) {
                case 200:
                    try {
                        var response = JSON.parse(this.responseText);
                        alert(response.message);
                        //reload the page
                        //location.reload();
                        if (response.success == true) {
                            window.location.replace('home.php');
                        }
                    } catch (error) {
                        alert(error);
                    }
                    
                    break;
                case 403:
                case 404:
                case 500:
                default:
                    alert('An unexpected error occurred: ' + this.status);
            }
            hideSpinner();
        }
    }
    xmlhttp.open("POST", "./json/register.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("screenName="+screenName+"&password="+password);
}

function loginAnyWay(screenName) {
    if (!screenName) {
        alert('Fill the fields, Please!');
        return false;    
    }

    showSpinner();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            switch (this.status) {
                case 200:
                    try {
                        var response = JSON.parse(this.responseText);
                        alert(response.message);
                        //reload the page
                        if (response.success == true) {
                            window.location.replace('home.php');
                        }
                    } catch (error) {
                        alert(error);
                    }
                    
                    break;
                case 403:
                case 404:
                case 500:
                default:
                    alert('An unexpected error occurred: ' + this.status);
            }
            hideSpinner();
        }
    }
    xmlhttp.open("POST", "./json/loginAnyWay.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("screenName="+screenName);
}