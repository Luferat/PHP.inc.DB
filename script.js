function runApp() {

    let theme = getCookie('thisSiteTheme');
    if (theme == 'dark')
        setTheme('dark');
    else
        setTheme('light');

    $('#theme').click(themeToggle);

}

function themeToggle() {
    if ($('#themeCSS').attr('href') == "/light.css")
        setTheme('dark');
    else
        setTheme('light');
}

function setTheme(theme) {
    if (theme == 'light') {
        $('#themeCSS').attr('href', '/light.css');
        setCookie('thisSiteTheme', 'light', 365);
    } else {
        $('#themeCSS').attr('href', '/dark.css');
        setCookie('thisSiteTheme', 'dark', 365);
    }
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

$(document).ready(runApp);