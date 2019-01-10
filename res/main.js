function setUp() {
    document.getElementById("returningUserButton").addEventListener("click", function() {
        const visible = document.getElementById("loginForm").style.visibility;
        let visibility = 'visible';
        console.log('Visibility = ', visible);
        if (visible === 'visible') {
            visibility = 'hidden';
        }
        document.getElementById("loginForm").style.visibility = visibility;
    });
    document.getElementById("loginForm").addEventListener("submit", function() {
        username = document.getElementById("username").value;
        password = document.getElementById("password").value;
        login(username, password);
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

function login(userName, password) {
    if (!username || !password) {
        alert('Fill the fields, Please!');
        return;    
    }

    showSpinner();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            switch (this.status) {
                case 200:
                    try {
                        var response = JSON.parse(this.responseText);
                        
                        //reload the page
                        //location.reload();
                        if (response.success === true){
                            window.location.assign('./home.php');
                        } else {
                            alert(response.message);
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
    xmlhttp.open("POST", "./json/login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("userName="+userName+"&password="+password);
}