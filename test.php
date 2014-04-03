 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Author" content="Daniel Hagnoul" />
    <title>Test datepicker</title>
    <link rel="stylesheet" type="text/css" href="humanity/jquery-ui-1.7.1.custom.css" media="all" />
    <style type="text/css">
        body {
            background-color:#696969;
            color:#000000;
            font-family:Arial, Helvetica, sans-serif;
            font-size:medium;
            font-style:normal;
            font-weight:normal;
            line-height:normal;
            letter-spacing:normal;
        }
        div,p,h1,h2,h3,h4,h5,h6,ul,ol,dl,form,table,img {
            margin:0px;
            padding:0px;
        }
        div#conteneur {
            width:95%;
            margin:12px auto;
            padding:6px;
            background-color:#FFFFFF;
            color:#000000;
            border:1px solid red;
            font-size:0.8em;
            text-align:center;
        }
        div#affiche {
            width:100%;
            height:40px;
            margin:12px auto;
        }
        div#datepicker {
            width:80%;
            margin:12px auto;
        }
 
        /* Différentes possibilités pour modifier le style par défaut */
        /*
        .ui-datepicker-current-day {
            background-color:#00FF99;
        }
        .ui-datepicker-today {
            background-color:#FF9933;
        }
        .ui-widget-content {
            color:#0000FF;
            background-color:#FFFFCC;
        }
        */
 
        /* Aujourd'hui */
        /*
        .ui-state-highlight, .ui-widget-content .ui-state-highlight {
            background-color:#FFE45C;
            border:1px solid #FED22F;
            color:#363636;
        }
        */
 
        /* La date sélectionnée */
        /*
        .ui-state-active, .ui-widget-content .ui-state-active {
            background-color:#FFFFFF;
            border:1px solid #FBD850;
            color:#EB8F00;
            font-weight:bold;
            outline-color:-moz-use-text-color;
            outline-style:none;
            outline-width:medium;
        }
        */
 
        /* Couleur de la date */
        .ui-state-default, .ui-widget-content .ui-state-default {
            color:#333333;
        }
 
        .important {
            background-color:#FF0000;
            /* pour modifier le td, ce qui provoque un effet de bordure autour de la date choisie */
            /* je ne sais pas comment modifier le lien <a> contenu dans ce td */
            /* je n'ai rien trouvé sur internet sur ce point */
        }
        .conge {
            background-color:#0000FF;
        }
        .lundiMercredi {
            background-color:#00CCCC;
        }
    </style>
    <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="jquery-ui-1.7.1.custom.min.js"></script>
    <script type="text/javascript" src="datepicker-fr.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){            
            var vacances = [[19, 4, 2009, 'conge'], [21, 4, 2009, 'conge']];
            var reunions = [[8, 5, 2009, 'important'], [12, 5, 2009, 'important']];
 
            function setDays(day, month, year) {
                var result = [true, '', ''];
 
                //getDay() retourne un entier correspondant au jour de la semaine
                // 0 (dimanche), 1 (lundi), 2 (mardi), 3 (mercredi), 4 (jeudi), 5 (vendredi), 6 (samedi)
                var jourSemaine = new Date(year, month, day).getDay();
 
                if ((jourSemaine == 1) || (jourSemaine == 3)) {
                    result = [true, 'lundiMercredi', ''];
                }
 
                if (vacances != null) {
                    for (i = 0; i < vacances.length; i++) {
                        if ((day == vacances[i][0]) && (month == vacances[i][1] - 1) && (year == vacances[i][2])) {
                            result = [false, vacances[i][3], "On est en vacances !"];
                        }
                    }
                }
 
                if (reunions != null) {
                    for (i = 0; i < reunions.length; i++) {
                        if ((day == reunions[i][0]) && (month == reunions[i][1] - 1) && (year == reunions[i][2])) {
                            result = [true, reunions[i][3], $("#longMessage").text()];
                        }
                    }
                }
 
                return result;
            }
 
            function selectedDay(day, month, year) {
                $("#affiche").html("<p>L'utilisateur a choisi le " + day + "/" + (month + 1) + "/" + year + " !</p>");
            }
 
            $("#datepicker").datepicker({
                numberOfMonths: 3,
                //showButtonPanel: true,
                //currentText: "Aujourd'hui",
                minDate: new Date(2009,3-1,15), //du 15 mars 2009
                maxDate: new Date(2009,5-1,28), //au 16 mai 2009
                //defaultDate: new Date(2009,4-1,2), //2 avril 2009
                //showOtherMonths: true,
                beforeShowDay: function(date) {
                    var day = date.getDate(); //entre 1 et 31
                    var month = date.getMonth(); // entre 0 et 11
                    var year = date.getFullYear(); // 4 chiffres
 
                    /*
                    If you don't want the weekends to appear at all, simply:
 
                    th.ui-datepicker-week-end, td.ui-datepicker-week-end {
                        display: none;
                    }
                    */
                    //var noWeekend = $.datepicker.noWeekends(date); //samedi et dimanche non sélectionable !
                    var noWeekend = [true, '', '']; // on garde le samedi et le dimanche !
 
                    if (noWeekend[0]) {
                        return setDays(day, month, year);
                    } else {
                        return noWeekend;
                    }
                },
                onSelect: function(dateText) {
                    var yearTexte = dateText.slice(6);
                    var monthTexte = dateText.slice(3,5); // de 01 à 12 texte !
                    var dayTexte = dateText.slice(0,2); // de 01 à 31 texte !
 
                    dayTexte = dayTexte.replace(/0(?=\d)/g, "");                    
                    monthTexte = monthTexte.replace(/0(?=\d)/g, "");
 
                    var year = parseInt(yearTexte);
                    var month = parseInt(monthTexte) - 1;
                    var day = parseInt(dayTexte);
 
                    selectedDay(day, month, year);
                }
            });
        });
    </script>
</head>
<body>
    <div id="conteneur">
        <div id="affiche"></div>
        <div id="datepicker"></div>
        <div id="longMessage" style="display:none;">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt pulvinar elit. Maecenas nec risus vitae felis suscipit scelerisque. Suspendisse placerat lorem ut nisl. Sed sit amet quam sit amet elit tempus eleifend. Aliquam posuere egestas elit. Donec porttitor, urna nec tincidunt rhoncus, tortor purus lacinia turpis, et pellentesque purus dui sed massa. Vivamus tristique mauris quis quam. Aliquam commodo ipsum iaculis tortor. Curabitur pulvinar sem quis tellus. Vestibulum faucibus. Nam quis nisi. Donec justo risus, molestie a, lacinia eu, tincidunt in, lorem. Mauris ut nisi vel ipsum varius convallis. Sed sit amet orci. Vivamus ultricies sem vel dui. Vivamus venenatis, dolor at porta cursus, libero quam imperdiet orci, vel interdum mauris lorem et ligula. Morbi iaculis lacus luctus erat. In pretium, ipsum a lobortis convallis, leo lacus molestie purus, eget pellentesque est felis eu metus. Suspendisse a nisi. Praesent vitae eros vitae turpis auctor ullamcorper.
            </p>
            <p>
                Aliquam erat volutpat. Phasellus cursus tempor augue. Morbi eu nisi et mi interdum lobortis. Nullam faucibus, enim quis ultricies imperdiet, ante leo lacinia nisi, vitae malesuada enim orci id dolor. Maecenas volutpat porta turpis. Ut nibh massa, luctus commodo, cursus eu, ornare eu, nulla. In vitae felis in ligula tincidunt suscipit. Mauris fermentum, magna nec viverra tristique, magna purus scelerisque ipsum, vel accumsan enim dui eu eros. In hac habitasse platea dictumst. Praesent aliquet ipsum sit amet tellus. Vivamus elit est, rhoncus in, iaculis vel, pellentesque sit amet, quam. Nunc id libero eget dolor molestie hendrerit. Etiam odio lectus, venenatis ut, porta eu, luctus ut, libero. Morbi lacinia, urna in tristique fringilla, urna libero convallis velit, nec auctor neque nulla eget ante. Sed elementum.
            </p>
        </div>
    </div>
</body>
</html>