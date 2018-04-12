var test;
//
var rules;
var theOptionsHaveBeenLoaded = false;
//ajax
$(document).ready(function() {
    $.get('includes/print-services.php')
        .done(function(json) {
            rules = json;
        })
        .fail(function() {})
        .always(function() {
            printService();

        })
});


function printService() {
    var start = $('#printFavorites');
    start.on('click', function() {
        if (!theOptionsHaveBeenLoaded) {
            loadOptions();
            theOptionsHaveBeenLoaded = true;
            calculateTotals();
        }
    })
};

function calculateTotals() {
    calculateIndividual();
    calculateSubtotal();
    calculateShipping();
    calculateGrandTotal();
    
    //grand
}

var calculate = $('#order');
calculate.on('change', function(e) {
    calculateTotals();
});
// var calculate2 = $('.shippingContainer');
// calculate2.on('change', function(e) {
//     calculateTotals();
// });

function calculateIndividual() {

    var total = 0;
    var subtotal = 0;

    var sizeID;
    var sizeCat;


    //q * (1+2+3) = total
    var items = $('.img');
    for (let i = 0; items.length > i; i++) {
        var itemSet = $('.img' + i);
        subtotal = 0;
        for (let j = 0; itemSet.length > j; j++) {
            var currentInput = itemSet[j].value;
            switch (j) {
                case 0:
                    // size
                    subtotal += rules.sizes[currentInput].cost;
                    sizeID = currentInput;
                    sizeCat = getSize(currentInput);
                    break;
                case 1:
                    // stock
                    if (sizeCat == 'small') { subtotal += rules.stock[currentInput].small_cost; }
                    else { subtotal += rules.stock[currentInput].large_cost; }
                    break;
                case 2:
                    // frame
                    subtotal += rules.frame[currentInput].costs[sizeID];
                    break;
                case 3:
                    // quantity
                    subtotal = subtotal * currentInput;
                    break;

                case 4:
                    // total
                    itemSet[j].innerText = '$' + subtotal;
                    break;
                default:
                    // code
                    break;
            }
        }

    }
    return subtotal;
}

function getSize(sizeNum) {
    if (sizeNum < (rules.sizes.length / 2)) {
        return "small";
    }
    else { return "large"; }
}


function addFrame(imageID) {
    var gallery = $('img');
    //if(){}
    // toggle class were has the same id class.
}

function loadOptions() {
    // for each in rules.
    if (rules.hasOwnProperty('sizes')) {
        for (var i = 0; rules.sizes.length > i; i++) {
            $('.size').append('<option value ="' + rules.sizes[i].id + '">' + rules.sizes[i].name + '</option>');
        }
    }
    if (rules.hasOwnProperty('stock')) {
        for (var i = 0; rules.stock.length > i; i++) {
            $('.stock').append('<option value ="' + rules.stock[i].id + '">' + rules.stock[i].name + '</option>');
        }
    }
    if (rules.hasOwnProperty('frame')) {
        for (var i = 0; rules.frame.length > i; i++) {
            $('.frame').append('<option value =' + rules.frame[i].id + '>' + rules.frame[i].name + '</option>');
        }
    }
    if (rules.hasOwnProperty('shipping')) {
        for (var i = 0; rules.shipping.length > i; i++) {
            if (i == 0) {
                $('.shippingContainer').append('<li><input class="radio radio' + i + '" name="shippingType" type="radio" value=' + rules.shipping[i].id + ' checked="checked"></li>');
            }
            else {
                $('.shippingContainer').append('<li><input class="radio radio' + i + '" name="shippingType" type="radio" value=' + rules.shipping[i].id + '></li>');
            }
            $('.radio' + i).after(function() { return rules.shipping[i].name; })

        }

    }
}

function calculateSubtotal() {
    // $() all of the same class
    var individual = $('.total');
    var subtotal = 0;
    for (let i = 0; individual.length > i; i++) {
        subtotal += parseFloat(individual[i].innerText.substring(1));
    }
    
    //adds
    $('#subtotal')[0].innerText = '$' + subtotal;
    
}


function freeCheck() {
    var subtotal =  parseFloat($('#subtotal')[0].innerText.substring(1));
    var check = false;
    var type = ShippingType();
    var amount = rules.freeThresholds[type]['amount'];
    if(subtotal >= amount){
        check = true;
    }
    return check;
}

function calculateShipping() {
    if(freeCheck()){$('#shipping')[0].innerText = '$0';}
    else{
   
    var quantity = 0;
    var items = $('.item');
    var currentValue;
    for (let i = 0; items.length > i; i++) {
        currentValue = $('.img' + i + '.frame')[0].value;
        
        if (currentValue != 0) { 
            quantity += parseInt($('.img'+i+'.quantity')[0].value);
            
        }
    }
    
    var shippingType = ShippingType();
    var shippingCost;
    
    if(quantity < 10 && quantity !=0){
       shippingCost=  rules.shipping[shippingType].rules['under10'];}
    else if(quantity >= 10){
       shippingCost= rules.shipping[shippingType].rules['over10'];}
    else { 
        shippingCost= rules.shipping[shippingType].rules['none'];}

    
    $('#shipping')[0].innerText = '$'+shippingCost;}
}

function ShippingType() {
    var buttons = $('.radio');
    var buttonValue;
    for (let i = 0; buttons.length > i; i++) {
        if (buttons[i].checked) {
            buttonValue = $(buttons[i]).attr('value');
        }
    }
    return buttonValue;
}


function calculateGrandTotal() {
    var grandTotal = 0;
    grandTotal += parseFloat($('#shipping')[0].innerText.substring(1));
    grandTotal += parseFloat($('#subtotal')[0].innerText.substring(1));
    $('#grandTotal')[0].innerText = '$'+grandTotal;
}
