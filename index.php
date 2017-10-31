<?php
/**
 * This file is part of "avvmonitor"
 *
 * @author Sebastian Antosch <s.antosch@i-san.de>
 * @copyright 2017 I-SAN.de Webdesign & Hosting GbR
 * @link http://i-san.de
 *
 * @license MIT
 */

$station = urldecode($_GET['station']) ?: 'Haunstetten West P+R';

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="theme-color" content="#333333">

        <title><?php echo $station; ?></title>

        <link href="assets/css/main.min.css" rel="stylesheet">
    </head>

    <body>

        <main class="container-fluid">

            <h1 data-bind="click: enterFullscreen">
                <div class="row">
                    <div class="col">
                        <?php echo $station; ?>
                    </div>
                    <div class="col-auto">
                        <span class="time text-muted" data-bind="text: time"></span>
                    </div>
                </div>
            </h1>

            <div class="stations row" data-bind="foreach: {data: departures, as: 'dep'}">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 d-sm-flex">
                    <div class="station card bg-dark">
                        <div class="card-header" data-bind="css: {
                            'bg-danger': dep.countdown <= 2,
                            'bg-warning': dep.countdown > 2 && dep.countdown <= 4,
                            'bg-success': dep.countdown > 4 && dep.countdown <= 10,
                            'bg-secondary': dep.countdown > 10
                        }">
                            <div class="countdown-outer">
                                <span class="countdown" data-bind="text: dep.countdown"></span><span class="countdown-min">m</span>
                            </div>
                            <span class="time" data-bind="text: dep.time"></span>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title" data-bind="text: dep.direction"></h4>
                            <h6 class="card-subtitle text-muted mb-2">
                                <span data-bind="text: dep.type"></span> Linie <span data-bind="text: dep.line"></span>
                            </h6>
                            <p class="card-text small" data-bind="text: dep.description"></p>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="row">
                                <span class="stop col-auto" data-bind="text: dep.stop"></span>
                                <span class="platform col text-right" data-bind="text: dep.platform"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>



        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="assets/js/knockout-3.4.2.js"></script>
        <script type="text/javascript">
            var DEPARTURE = '<?php echo $station; ?>';
        </script>
        <script src="assets/js/main.js"></script>

    </body>
</html>

