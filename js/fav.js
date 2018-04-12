var fav = document.querySelector("#fav");
fav.addEventListener("click", function(e) {
     var favAlert = document.querySelector("#favAlert");
     favAlert.classList.remove('collapse');
     document.cookie = "test=true";
     setTimeout(function() { favAlert.classList.add('collapse'); }, 2000);
     

});



     

