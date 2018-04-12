/*selectors*/




var continent = document.getElementById("continent");
var city = document.getElementById("city");
var country = document.getElementById("country");
var search = document.getElementById("search");

var imageParent = document.getElementsByClassName("caption-style-2")[0];


/*array of strings and number that reprsents the current filters.*/
var currentFilter = [0,0,0,0];


checkQueryString();


continent.addEventListener("change", function() {
    var classNum = 0;
    checkFilter(continent.value, classNum);
});

country.addEventListener("change", function() {
    var classNum = 1;
    checkFilter(country.value, classNum);
});

city.addEventListener("change", function() {
    var classNum = 2;
    checkFilter(city.value, classNum);
});

search.addEventListener("change", function() {
    var classNum = 3;
    checkFilter(search.value, classNum);
  });


function checkFilter(selectValue, classNum) {

    //toggle back on.
    if (currentFilter[classNum] != 0) {
        if(classNum == 3){titleSearch(currentFilter[classNum], classNum);}
        else{applyFilter(currentFilter[classNum], classNum);}
    }
    //toggle off.
    if (selectValue != 0) {
        if(classNum == 3){titleSearch(selectValue, classNum);}
        else{applyFilter(selectValue, classNum);}
    }

    currentFilter[classNum] = selectValue;
}


function applyFilter(selectValue, classNum) {

    var image = imageParent.firstElementChild;

    while (image.nextElementSibling) {
        
        if (image.classList[classNum] != selectValue) {

            image.classList.toggle("hide"+classNum);
        }
        image = image.nextElementSibling;
    }
    if (image.classList[classNum] != selectValue) {
        image.classList.toggle("hide"+classNum);
    }


}

function titleSearch(search, classNum) {
    
    search = search.toLowerCase();
    var image = imageParent.firstElementChild;
    
    while(image.nextElementSibling) {
        if(image.getElementsByTagName("p")[0].innerHTML.toLowerCase().indexOf(search) == -1) {
            image.classList.toggle("hide"+classNum);
        }
        image = image.nextElementSibling;
    }
    if(image.getElementsByTagName("p")[0].innerHTML.indexOf(search) == -1) {
            image.classList.toggle("hide"+classNum);
        }
}


function checkQueryString() {
    
    var keyArray = ["continent","country","city","title","search"];
    var queryValue;
    var queryString = window.location.search
    for (var i=0; keyArray.length > i; i++) {
        
        if (queryString.indexOf('?' + keyArray[i] + '=') != -1) {
            queryValue = getUrlParameter(keyArray[i]);
            
            checkFilter(queryValue,i);
            
            
        }
        else if (queryString.indexOf('&' + keyArray[i] + '=') != -1) {
            queryValue = getUrlParameter(keyArray[i]);
            
            currentFilter[i] = queryValue;
            checkFilter(queryValue,i);
        }
    }
    
/*https://davidwalsh.name/query-string-javascript*/
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(window.location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};


}
