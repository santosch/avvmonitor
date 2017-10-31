(function (window) {
    "use strict";

    var $ = window.jQuery,
        ko = window.ko,

        DepartureMonitor = function (departure) {

            var self = this,
                FETCH_INTERVALL = 15;

            /**
             * @type ko.observable
             */
            self.time = ko.observable('');

            /**
             * Periodically updates the time
             */
            self.calculateTime = function () {
                var now = new Date(),
                    /**
                     * pads an int with a 0
                     * @param i
                     */
                    pad = function (i) {
                        return i < 10 ? '0' + i : i;
                    },

                    time = [now.getHours(), pad(now.getMinutes()), pad(now.getSeconds())].join(':');
                    self.time(time);

                    setTimeout(self.calculateTime, 100);
            };

            self.calculateTime();

            /**
             * @type ko.observableArray
             */
            self.departures = ko.observableArray([]);

            /**
             * periodically fetches the data from the api
             */
            self.fetch = function () {
                $.getJSON('api.php', {station: departure}, function (data) {
                    self.departures(data);
                });

                setTimeout(self.fetch, 1000 * FETCH_INTERVALL);
            };

            self.fetch();

            /**
             * Sends the page to fullscreen
             */
            self.enterFullscreen = function () {
                var requestFullscreen =
                    document.documentElement.requestFullcreen ||
                    document.documentElement.mozRequestFullScreen ||
                    document.documentElement.webkitRequestFullScreen;
                requestFullscreen.call(document.documentElement);
            }

        },

        depMon = new DepartureMonitor(DEPARTURE);

    ko.applyBindings(depMon, $('body')[0]);


})(window);