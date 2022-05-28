if (!access_cookie("token")) {
    logout();
}

function logout() {
    window.location.href = "../login.html";
}

function access_cookie(cookie_name) {
    var name = cookie_name + "=";
    var allCookieArray = document.cookie.split(';');
    for (var i = 0; i < allCookieArray.length; i++) {
        var temp = allCookieArray[i].trim();
        if (temp.indexOf(name) == 0)
            return temp.substring(name.length, temp.length);
    }
    return "";
}