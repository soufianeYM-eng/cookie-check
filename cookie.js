var CookieName = "TestCookie";
document.cookie = "CookieName=TestCookie;SameSite=None;Secure;";

if (document.cookie.indexOf(CookieName) == -1) {
    console.log("Cookies are required to use shopping carts.");
}
else if (document.cookie.indexOf(CookieName) != -1) {
    console.log("Thank you for enabling Third-Party cookies");
}