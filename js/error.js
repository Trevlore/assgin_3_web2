window.onload = function() {
var message = document.querySelector("#error");
var form = document.querySelector("#login");
form.addEventListener("input",function(e) {
        message.style.display = 'none';
});
};

