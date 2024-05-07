let _sourceToBaseRate = "eur";
    let _destinationToBaseRate = "eur";


    // Calculator For Currency
    function calculate(amount, sourceToBaseRate, destinationToBaseRate, revert = false) {
        let amountOfSource;
        if (_sourceToBaseRate == "irr" && _destinationToBaseRate == "irr") {
            return amount;
        }
        if (revert == false) {
            amountOfSource = Number(amount) * Number(sourceToBaseRate);
            const convertedAmount = amountOfSource / Number(destinationToBaseRate);
            return Number(convertedAmount);
        } else {
            amountOfSource = Number(amount) / Number(sourceToBaseRate);
            const convertedAmount = amountOfSource * Number(destinationToBaseRate);
            return Number(convertedAmount);
        }
    }

    // Send AJAX Request
    function ajax_request() {
        jQuery.ajax({
            type: "GET",
            dataType: "json",
            url: "api url",
            data: {
                api: "custom api"
            },
            success: function (data, status) {
                // Action if Success Request
            },
            error: function (err) {
                // Action if has error 
            }
        })
    }
   
    // Numbers With Digits
    function numberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    // Use This Sample converter For Your Code
    function convert() {
        output.value = Number((convertCurrency(Number(input), sourceToBaseRate, destinationToBaseRate, false)).toFixed(2)).toLocaleString();
            document.getElementById("input1").value = Number(input).toLocaleString();
    }
