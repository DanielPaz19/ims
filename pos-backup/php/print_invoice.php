<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/w3.css">
    <link rel="stylesheet" href="../styles/w3-customs.css">
    <link rel="stylesheet" href="../styles/receipt-print.css">
    <script defer src="../js/receipt-print.js"></script>
    <title>Sales Invoice</title>
</head>

<body class="w3-light-gray">
    <div class="w3-white" style="width: 8.5in; height: 11in; position:relative;">
        <div class="receipt__input receipt__input--invoice__number" style="position: absolute; top: 2.5cm; left: 18cm;">
            99104
        </div>
        <div class="w3-cell-row w3-small w3-light-gray" style="height:2.5cm; position:absolute; top: 4cm;">
            <div class="w3-cell-row receipt__input--row">
                <div class="w3-cell receipt__label" style="width: 2.7cm;">
                    Sold To
                </div>
                <div class="w3-display-container w3-cell " style="width: 11.3cm;">
                    <div class="w3-display-left receipt__input">PHILIPPINE ACRYLIC AND CHEMICAL CORP.</div>
                </div>
                <div class="w3-cell receipt__label" style="width: 2.3cm;">
                    Date
                </div>
                <div class="w3-display-container w3-cell receipt__input" style="width: 5.3cm">
                    <div class="w3-display-left receipt__input">January 01, 2022</div>
                </div>
            </div>
            <div class="w3-cell-row receipt__input--row">
                <div class="w3-cell receipt__label" style="width: 2.7cm;">
                    TIN
                </div>
                <div class="w3-display-container w3-cell receipt__input" style="width: 11.3cm;">
                    <div class="w3-display-left receipt__input">123-456-789-000</div>
                </div>
                <div class="w3-cell receipt__label" style="width: 2.3cm;">
                    DR No.
                </div>
                <div class="w3-display-container w3-cell receipt__input" style="width: 5.3cm">
                    <div class="w3-display-left receipt__input">12345</div>
                </div>
            </div>
            <div class="w3-cell-row receipt__input--row">
                <div class="w3-cell receipt__label" style="width: 2.7cm;">
                    Address
                </div>
                <div class="w3-display-container w3-cell receipt__input" style="width: 11.3cm;">
                    <div class="w3-display-left receipt__input receipt__input--address">635 Mercedes Ave., Brgy. San Miguel, Pasig City</div>
                </div>
                <div class="w3-cell receipt__label" style="width: 3.2cm;">
                    Shipped Via
                </div>
                <div class="w3-display-container w3-cell receipt__input" style="width: 4.4cm">
                    <div class="w3-display-left receipt__input">Lalamove</div>
                </div>
            </div>
            <div class="w3-cell-row receipt__input--row">
                <div class="w3-cell receipt__label" style="width: 2.7cm;">
                    Deliverd To
                </div>
                <div class="w3-display-container w3-cell receipt__input" style="width: 11.3cm;">
                    <div class="w3-display-left receipt__input receipt__input--address"> 635 Mercedes Ave., Brgy. San Miguel, Pasig City</div>
                </div>
                <div class="w3-cell-row" style="width: 7.6cm;">
                    <div class="w3-cell receipt__label" style="width: 50%">
                        B/L No.
                    </div>
                    <div class="w3-cell receipt__label" style="width: 50%">
                        Voy No.
                    </div>
                </div>
            </div>
        </div>

        <!-- Item List -->
        <div class="w3-cell-row w3-small w3-light-gray" style="height:6.2cm; position:absolute; top: 7.6cm;">
            <div class="w3-cell-row receipt__input--item">
                <div class="w3-cell w3-display-container" style="width: 2.7cm;">
                    <div class="receipt__input--qty" style="text-align:center;">
                        1 pc
                    </div>
                </div>
                <div class="w3-display-container w3-cell " style="width: 12.5cm;">
                    <div class="receipt__input--description receipt__input" style="width: 100%"> 00001234 ACRY PUPPY</div>
                </div>
                <div class="w3-display-container w3-cell " style="width: 2.8cm;">
                    <div class="receipt__input--unit__price receipt__input" style="width: 100%"> 9,999.99 </div>
                </div>
                <div class="w3-display-container w3-cell " style="width: 2.5cm">
                    <div class="receipt__input--total__price receipt__input" style="width: 100%"> 9,999.99 </div>
                </div>
                <div class="w3-cell" style="width: 1.1cm">
                </div>
            </div>

        </div>
        <!-- Summary -->
        <div class="w3-cell-row w3-small w3-light-gray" style="height:2.5cm; position:absolute; top: 15.7cm;">
            <!-- Amount Net of Vat -->
            <div class="w3-cell-row receipt__input--summary">
                <div class="w3-cell w3-display-container" style="width: 2.7cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 12.5cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 2.8cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 2.5cm">
                    <div class="receipt__input--total__price receipt__input" style="width: 100%"> 9,999.99 </div>
                </div>
                <div class="w3-cell" style="width: 1.1cm">
                </div>
            </div>
            <!-- Amount Due -->

            <div class="w3-cell-row receipt__input--summary">
                <div class="w3-cell w3-display-container" style="width: 2.7cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 12.5cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 2.8cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 2.5cm">
                    <div class="receipt__input--total__price receipt__input" style="width: 100%">-</div>
                </div>
                <div class="w3-cell" style="width: 1.1cm">
                </div>
            </div>

            <!-- Add: Vat -->
            <div class="w3-cell-row receipt__input--summary">
                <div class="w3-cell w3-display-container" style="width: 2.7cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 12.5cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 2.8cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 2.5cm">
                    <div class="receipt__input--total__price receipt__input" style="width: 100%"> 9,999.99 </div>
                </div>
                <div class="w3-cell" style="width: 1.1cm">
                </div>
            </div>

            <!-- Total Amount Due -->
            <div class="w3-cell-row receipt__input--summary">
                <div class="w3-cell w3-display-container" style="width: 2.7cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 12.5cm;">
                    <div class="receipt__input--or__number receipt__input" style="width: 100%"> OR#</div>
                </div>
                <div class="w3-display-container w3-cell " style="width: 2.8cm;">

                </div>
                <div class="w3-display-container w3-cell " style="width: 2.5cm">
                    <div class="receipt__input--total__price receipt__input" style="width: 100%"> 9,999.99 </div>
                </div>
                <div class="w3-cell" style="width: 1.1cm">
                </div>
            </div>

        </div>
    </div>
    </div>
</body>

</html>