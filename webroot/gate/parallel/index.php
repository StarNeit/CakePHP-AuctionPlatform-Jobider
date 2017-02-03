<html>
    <head>
        <title>Paypal Parallel Payments Using PHP</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/loadding.css">
        <link rel="stylesheet" type="text/css" href="css/popup-style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <meta name="robots" content="noindex, nofollow">
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-43981329-1']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    <body>
        <div id="main">
            <center><h1>Paypal Parallel Payments Using PHP</h1></center>

            <div id="container">
                <center><h2>Book Together and Save Money and Time</h2></center>
                <hr/>
                <table id="results" >
                    <tbody>
                        <tr>
                            <td style="  padding-bottom: 20px;">
                                <b><p style="color: rgb(77, 125, 179);">Flight = $300<br></p></b>

                            </td >
                            <td style="  padding-bottom: 20px;">
                                <b><p style="color: rgb(77, 125, 179);">Hotel = $200</p></b>
                            </td >
                            <td style="  padding-bottom: 20px;">
                                <b><p style="color: rgb(77, 125, 179);">Cab = $100<br></p></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <center><h3>Select Your Plan</h3></center>
                <form action="process.php" name="form" method="POST">
                    <div id="item-container">
                        <input type="radio" name="booking" value="f" checked="true">Flight Only( $300 )<br>
                        <input type="radio" name="booking" value="h">Hotel Only( $200 )<br>
                        <input type="radio" name="booking" value="c">Car Only( $100 )<br>
                        <input type="radio" name="booking" value="fh">Flight + Hotel ( $500 )<br>
                        <input type="radio" name="booking" value="fc">Flight + Car ( $400 )<br>
                        <input type="radio" name="booking" value="hc">Hotel + Car ( $300 )<br>
                        <input type="radio" name="booking" value="fhc">Flight + Hotel + Car ( $585 )<br>
                    </div>
                    <div id="item-container">
                        <div class="f" id="merchants-details"><p id="title-text">Book Flight<br> and <br> Pay Direct to airline</p><i class="fa fa-plane fa-4x"></i></div>
                        <div class="h" id="merchants-details"><p id="title-text">Book Hotel<br> and <br> Pay  to Company</p><i class="fa fa-bed fa-3x"></i></div>
                        <div  class="c"id="merchants-details"><p id="title-text">Book Car<br> and <br> Pay Direct to Owner</p><i class="fa fa-car fa-3x"></i></div>
                    </div>
                    <input type="submit" id="tatalamount"  value="Pay Now : $000"/>
                </form>

            </div>
            <img id="paypal_logo" src="images/secure-paypal-logo.jpg">
        </div>
        <div id="pop2" class="simplePopup">
            <div id="loader">
                <div id="circularG">
                    <div id="circularG_1" class="circularG">
                    </div>
                    <div id="circularG_2" class="circularG">
                    </div>
                    <div id="circularG_3" class="circularG">
                    </div>
                    <div id="circularG_4" class="circularG">
                    </div>
                    <div id="circularG_5" class="circularG">
                    </div>
                    <div id="circularG_6" class="circularG">
                    </div>
                    <div id="circularG_7" class="circularG">
                    </div>
                    <div id="circularG_8" class="circularG">
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.simplePopup.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('input#tatalamount').click(function() {
                    $('#pop2').simplePopup();
                });
                $("div.f i").css('color', '#FFBC00');
                $("div.f").css('border', '3px solid rgb(255, 188, 0)');
                $("div.f").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                $('input#tatalamount').val('Pay Now : $300');
            });
            // get list of radio buttons with name 'size'
            var sz = document.forms['form'].elements['booking'];
            // loop through list
            for (var i = 0, len = sz.length; i < len; i++) {
                sz[i].onclick = function() {
                    rdata = this.value;
                    $("div.f i").css('color', '');
                    $("div.f").css('box-shadow', '');
                    $("div.h i").css('color', '');
                    $("div.h").css('box-shadow', '');
                    $("div.c i").css('color', '');
                    $("div.c").css('box-shadow', '');
                    $("div.f").css('border', '');
                    $("div.h").css('border', '');
                    $("div.c").css('border', '');
                    if (rdata === 'f') {
                        $("div.f i").css('color', '#FFBC00');
                        $("div.f").css('border', '3px solid rgb(255, 188, 0)');
                        $("div.f").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $('input#tatalamount').val('Pay Now : $300');
                    }
                    if (rdata === 'h') {
                        $("div.h i").css('color', '#FFBC00');
                        $("div.h").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.h").css('border', '3px solid rgb(255, 188, 0)');
                        $('input#tatalamount').val('Pay Now : $200');
                    }
                    if (rdata === 'c') {
                        $("div.c i").css('color', '#FFBC00');
                        $("div.c").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.c").css('border', '3px solid rgb(255, 188, 0)');
                        $('input#tatalamount').val('Pay Now : $100');
                    }
                    if (rdata === 'fh') {
                        $("div.f i").css('color', '#FFBC00');
                        $("div.f").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.f").css('border', '3px solid rgb(255, 188, 0)');
                        $("div.h i").css('color', '#FFBC00');
                        $("div.h").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.h").css('border', '3px solid rgb(255, 188, 0)');
                        $('input#tatalamount').val('Pay Now : $500');
                    }
                    if (rdata === 'fc') {
                        $("div.f i").css('color', '#FFBC00');
                        $("div.f").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.f").css('border', '3px solid rgb(255, 188, 0)');
                        $("div.c i").css('color', '#FFBC00');
                        $("div.c").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.c").css('border', '3px solid rgb(255, 188, 0)');
                        $('input#tatalamount').val('Pay Now : $400');
                    }
                    if (rdata === 'hc') {
                        $("div.h i").css('color', '#FFBC00');
                        $("div.h").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.h").css('border', '3px solid rgb(255, 188, 0)');
                        $("div.c i").css('color', '#FFBC00');
                        $("div.c").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.c").css('border', '3px solid rgb(255, 188, 0)');
                        $('input#tatalamount').val('Pay Now : $300');
                    }
                    if (rdata === 'fhc') {
                        $("div.f i").css('color', '#FFBC00');
                        $("div.f").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.f").css('border', '3px solid rgb(255, 188, 0)');
                        $("div.h i").css('color', '#FFBC00');
                        $("div.h").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.h").css('border', '3px solid rgb(255, 188, 0)');
                        $("div.c i").css('color', '#FFBC00');
                        $("div.c").css('box-shadow', '0px 5px 17px 1px #99A3AD, 0px 0px 40px #EEEEEE');
                        $("div.c").css('border', '3px solid rgb(255, 188, 0)');
                        $('input#tatalamount').val('Pay Now : $585');
                    }
                };
            }
        </script>
    </body>
</html>
