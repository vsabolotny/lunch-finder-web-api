// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/mobile.css';

// start the Stimulus application
import './bootstrap';

$(function() {
    const gmJsV = $('#GoogleMapsJavascriptVariable').val();
    const map = window[gmJsV];

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setPosition);
        }
    }

    function setPosition(position) {
        const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
        };

        map.setCenter(pos);
    }

    getLocation();
});
