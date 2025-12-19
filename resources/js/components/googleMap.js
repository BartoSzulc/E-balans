// googleMap.js

// Custom map styles with gray theme and white roads
const mapStyles = [
    {
        "featureType": "all",
        "elementType": "geometry",
        "stylers": [
            { "color": "#F3F3F3" }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [
            { "color": "#333333" }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.stroke",
        "stylers": [
            { "color": "#ffffff" },
            { "weight": 2 }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            { "color": "#ffffff" }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            { "color": "#ffffff" }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            { "color": "#ffffff" }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            { "color": "#ffffff" }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            { "color": "#e0e0e0" }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            { "color": "#f0f0f0" }
        ]
    },
    // Hide all POI markers and labels
    {
        "featureType": "poi",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "poi.business",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "poi.park",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "poi.place_of_worship",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "poi.school",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "poi.medical",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "poi.government",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "transit.line",
        "stylers": [
            { "visibility": "off" }
        ]
    },
    {
        "featureType": "transit.station",
        "stylers": [
            { "visibility": "off" }
        ]
    }
];


// Custom pin SVG
const customPinSVG = `
    <svg  viewBox="0 0 50 60" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M42.0104 7.0377C37.4623 2.49797 31.4224 0 24.9975 0C24.9821 0 24.9661 0 24.9507 0C18.5308 0.0121875 12.4876 2.54191 7.93429 7.12348C3.37991 11.706 0.886864 17.7664 0.914286 24.1881C0.914989 24.3517 0.917216 24.5149 0.9212 24.6776C1.0405 29.601 2.82585 34.5082 5.94831 38.4952L8.34796 41.5593C8.64796 41.9425 9.20155 42.0096 9.58452 41.7096C9.96749 41.4097 10.0349 40.8561 9.73499 40.473L7.33534 37.4089C4.44503 33.7185 2.79257 29.1819 2.68241 24.6347C2.67878 24.4838 2.67655 24.3326 2.67597 24.1807C2.65054 18.2302 4.96171 12.6135 9.18374 8.36531C13.4048 4.11809 19.0055 1.77293 24.954 1.76168H24.9973C30.9519 1.76168 36.5507 4.07719 40.7659 8.28445C44.9916 12.5021 47.3187 18.113 47.3187 24.0832C47.3187 24.2332 47.3173 24.3827 47.3142 24.5324C47.2239 29.1185 45.5702 33.692 42.658 37.4106L27.1789 57.1758C26.6501 57.851 25.8549 58.2383 24.9973 58.2383C24.1397 58.2383 23.3444 57.851 22.8157 57.1758L12.2699 43.7098C11.9699 43.3266 11.4162 43.2593 11.0333 43.5594C10.6503 43.8593 10.583 44.413 10.8828 44.796L21.4287 58.262C22.2936 59.3665 23.5944 60 24.9973 60C26.4002 60 27.7009 59.3665 28.5658 58.2619L44.045 38.4966C47.1912 34.4794 48.9777 29.5324 49.0757 24.5671C49.0788 24.4061 49.0805 24.2448 49.0805 24.0831C49.0805 17.6418 46.5696 11.5882 42.0104 7.0377Z" fill="#124797"/>
<path d="M40.6755 28.1223C41.1491 28.2333 41.623 27.939 41.734 27.4654C42.0338 26.184 42.1859 24.8611 42.1859 23.5334C42.1859 14.0544 34.4741 6.34277 24.9953 6.34277C15.5163 6.34277 7.80469 14.0545 7.80469 23.5334C7.80469 33.0122 15.5163 40.7239 24.9953 40.7239C31.3998 40.7239 37.2327 37.2002 40.2175 31.528C40.4441 31.0976 40.2788 30.565 39.8482 30.3384C39.4175 30.1117 38.885 30.2773 38.6586 30.7077C35.9793 35.7993 30.7438 38.9623 24.9954 38.9623C16.4878 38.9623 9.56648 32.0409 9.56648 23.5334C9.56648 15.0258 16.4878 8.10445 24.9954 8.10445C33.503 8.10445 40.4243 15.0259 40.4243 23.5334C40.4243 24.7262 40.2878 25.914 40.0187 27.064C39.9079 27.5375 40.2019 28.0113 40.6755 28.1223Z" fill="#124797"/>
<path d="M34.0248 16.1289C33.3349 15.4919 32.438 15.1619 31.5 15.1991C30.5617 15.2365 29.6941 15.6372 29.0572 16.3271L22.5941 23.3274L20.7927 21.5863C19.3988 20.2395 17.1689 20.2772 15.8218 21.671C14.4749 23.0648 14.5129 25.2946 15.9066 26.6418C15.9066 26.6418 20.2935 30.8816 20.2941 30.8822C21.7072 32.248 23.9699 32.2019 25.32 30.7394L34.223 21.0966C34.8601 20.4067 35.1904 19.51 35.1529 18.5718C35.1151 17.6334 34.7147 16.7659 34.0248 16.1289ZM32.9284 19.9014C32.9261 19.9039 24.0253 29.5443 24.0253 29.5443C23.7073 29.8889 23.2559 30.0942 22.7878 30.1075C22.3146 30.1224 21.8591 29.945 21.5182 29.6154L17.1308 25.375C16.4355 24.7029 16.4166 23.5905 17.0885 22.8952C17.4321 22.5398 17.8907 22.361 18.3498 22.361C18.7889 22.361 19.2285 22.5245 19.5683 22.8529L22.0177 25.2202C22.1882 25.385 22.4174 25.4759 22.6549 25.4673C22.892 25.4605 23.1162 25.3586 23.2771 25.1843C23.2771 25.1843 30.3373 17.5375 30.3517 17.5219C31.178 16.6269 32.7555 16.8916 33.2455 18.0032C33.5168 18.6221 33.3867 19.405 32.9284 19.9014Z" fill="#124797"/>
</svg>

`;

/**
 * Initialize Google Map with custom pin
 * @param {Object} options - Configuration options
 * @param {string} options.containerId - ID of the container element
 * @param {number} [options.lat=54.330939] - Latitude
 * @param {number} [options.lng=18.205285] - Longitude
 * @param {number} [options.zoom=16] - Initial zoom level
 * @param {string} [options.title] - Marker title
 * @param {string} [options.address] - Address for info window
 * @returns {Object} - Map instance and marker
 */
export function initGoogleMap(options = {}) {
    const isMobile = window.innerWidth < 1024;
    const {
        containerId,
        lat = 54.330939,
        lng = 18.205285,
        zoom = isMobile ? 12 : 13,
        title = 'Gdańska 29D, 83-300 Kartuzy, Polska',
        address = 'Gdańska 29D, 83-300 Kartuzy, Polska'
    } = options;

    const container = document.getElementById(containerId);
    if (!container) {
        throw new Error(`Container with ID "${containerId}" not found`);
    }

    if (!window.google || !window.google.maps) {
        throw new Error('Google Maps API not loaded');
    }

    const location = { lat, lng };

    // Initialize map with disabled POIs
    const map = new google.maps.Map(container, {
        zoom,
        center: location,
        styles: mapStyles,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
        zoomControl: false,
        // Disable default POI markers
        clickableIcons: false,
        // Disable default business markers
        businessMarkers: false
    });

    // Create custom marker icon
    const customIcon = {
        url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(customPinSVG),
        scaledSize: new google.maps.Size(50, 60),
        anchor: new google.maps.Point(19, 33)
    };

    // Add marker
    const marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: customIcon,
        title: title,
        animation: google.maps.Animation.DROP
    });

    // Create custom logo overlay
    class LogoOverlay extends google.maps.OverlayView {
        constructor(position, map) {
            super();
            this.position = position;
            this.map = map;
            this.div = null;
            this.setMap(map);
        }



        draw() {
            const overlayProjection = this.getProjection();
            const position = overlayProjection.fromLatLngToDivPixel(this.position);
            
            if (position && this.div) {
                this.div.style.left = position.x + 'px';
                this.div.style.top = position.y + 'px';
            }
        }

        onRemove() {
            if (this.div && this.div.parentNode) {
                this.div.parentNode.removeChild(this.div);
                this.div = null;
            }
        }
    }

    // Add logo overlay
    const logoOverlay = new LogoOverlay(location, map);

    // Open Google Maps link on marker click
    marker.addListener('click', () => {
        window.open('https://maps.app.goo.gl/W6EMghAMGbwkAy3n9', '_blank');
    });

    return {
        map,
        marker,
        logoOverlay
    };
}
/**
 * Load Google Maps API dynamically
 * @param {string} apiKey - Your Google Maps API key
 * @returns {Promise} - Promise that resolves when API is loaded
 */
export function loadGoogleMapsAPI(apiKey) {
    return new Promise((resolve, reject) => {
        // Check if API is already loaded
        if (window.google && window.google.maps) {
            resolve();
            return;
        }

        // Create script element
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&v=weekly`;
        script.async = true;
        script.defer = true;

        script.onload = () => resolve();
        script.onerror = () => reject(new Error('Failed to load Google Maps API'));

        document.head.appendChild(script);
    });
}

/**
 * Complete function to load API and initialize map
 * @param {Object} options - Configuration options
 * @param {string} options.apiKey - Google Maps API key
 * @param {string} options.containerId - ID of the container element
 * @param {number} [options.lat] - Latitude
 * @param {number} [options.lng] - Longitude
 * @param {number} [options.zoom] - Initial zoom level
 * @param {string} [options.title] - Marker title
 * @param {string} [options.address] - Address for info window
 * @returns {Promise<Object>} - Promise that resolves with map instance
 */
export async function createGoogleMap(options) {
    const { apiKey, ...mapOptions } = options;
    
    try {
        await loadGoogleMapsAPI(apiKey);
        return initGoogleMap(mapOptions);
    } catch (error) {
        console.error('Error creating Google Map:', error);
        throw error;
    }
}