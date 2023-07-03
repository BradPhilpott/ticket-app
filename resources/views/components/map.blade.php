<div>
    <div wire:ignore class="w-full">
        <div {{ $attributes }}>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener("livewire:load", () => {

            let el = $('#{{ $attributes['id'] }}');
            var existingFeatures = el.val();

            var map = L.map('map').setView([51.505, -0.09], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            L.geoJSON(existingFeatures).addTo(map);

            var drawnFeatures = new L.FeatureGroup();
            map.addLayer(drawnFeatures);

            var drawControl = new L.Control.Draw({
                edit: {
                    featureGroup: drawnFeatures,
                    remove: true
                }
            });
            map.addControl(drawControl);

            map.on("draw:created", function (e) {
                var layer = e.layer; 
                drawnFeatures.addLayer(layer);
            });

            map.on('blur', function (e) {
                var featureCollection = drawnFeatures.toGeoJSON();
                @this.set('ticket.map_layers', featureCollection);
            });

            var control = L.Control.fileLayerLoad({
                fitBounds: true,
                layerOptions: {
                    pointToLayer: function (data, latlng) {
                        return L.geoJSON(data).addTo(map);
                    }
                }
            });
            control.addTo(map);
            control.loader.on('data:loaded', function (e) {
                var layer = e.layer;
                @this.set('ticket.map_layers', layer.toGeoJSON());
            });
        });
    </script>
@endpush