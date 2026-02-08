<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    @php
        $statePath = $getStatePath();
        $latitudePath = 'data.' . $getLatitudeField();
        $longitudePath = 'data.' . $getLongitudeField();
        $addressPath = $getAddressField() ? 'data.' . $getAddressField() : null;
        
        $config = [
            'zoom' => $getZoom(),
            'defaultLat' => $getDefaultLat(),
            'defaultLng' => $getDefaultLng(),
            'tileLayer' => $getTileLayer(),
            'attribution' => $getAttribution(),
            'isDraggable' => $getIsDraggable(),
            'isClickable' => $getIsClickable(),
            'hasAddressField' => (bool) $addressPath,
        ];
    @endphp

    <div
        x-data="{
            state: $wire.entangle('{{ $statePath }}'),
            latitude: $wire.entangle('{{ $latitudePath }}'),
            longitude: $wire.entangle('{{ $longitudePath }}'),
            address: {{ $addressPath ? "\$wire.entangle('{$addressPath}')" : 'null' }},
            config: {{ json_encode($config) }},
            map: null,
            marker: null,
            init() {
                $nextTick(() => {
                    this.initMap();
                });
            },
            initMap() {
                if (typeof L === 'undefined') {
                    setTimeout(() => this.initMap(), 200);
                    return;
                }

                if (this.map) return;

                const initialLat = parseFloat(this.latitude) || this.config.defaultLat;
                const initialLng = parseFloat(this.longitude) || this.config.defaultLng;

                this.map = L.map($refs.map).setView([initialLat, initialLng], this.config.zoom);

                L.tileLayer(this.config.tileLayer, {
                    attribution: this.config.attribution
                }).addTo(this.map);

                this.marker = L.marker([initialLat, initialLng], {
                    draggable: this.config.isDraggable
                }).addTo(this.map);

                if (this.config.isClickable) {
                    this.map.on('click', (event) => {
                        const position = event.latlng;
                        this.updateCoords(position.lat, position.lng);
                    });
                }

                if (this.config.isDraggable) {
                    this.marker.on('dragend', (event) => {
                        const position = event.target.getLatLng();
                        this.updateCoords(position.lat, position.lng);
                    });
                }

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && this.map) {
                            this.map.invalidateSize();
                        }
                    });
                }, { threshold: 0.1 });
                
                observer.observe($refs.map);

                $watch('latitude', (value) => this.syncMap());
                $watch('longitude', (value) => this.syncMap());
            },
            updateCoords(lat, lng) {
                this.latitude = lat.toFixed(8);
                this.longitude = lng.toFixed(8);
                this.marker.setLatLng([lat, lng]);

                if (this.config.hasAddressField) {
                    this.reverseGeocode(lat, lng);
                }
            },
            async reverseGeocode(lat, lng) {
                try {
                    const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
                    const data = await response.json();
                    if (data && data.display_name) {
                        this.address = data.display_name;
                    }
                } catch (error) {
                    console.error('Reverse geocoding failed:', error);
                }
            },
            syncMap() {
                if (!this.map || !this.marker) return;
                const lat = parseFloat(this.latitude);
                const lng = parseFloat(this.longitude);
                if (!isNaN(lat) && !isNaN(lng)) {
                    const currentPos = this.marker.getLatLng();
                    if (currentPos.lat !== lat || currentPos.lng !== lng) {
                        this.marker.setLatLng([lat, lng]);
                        this.map.panTo([lat, lng]);
                    }
                }
            }
        }"
        class="w-full"
    >
        <div
            x-ref="map"
            style="height: {{ $getHeight() }}; width: {{ $getWidth() }}; min-height: {{ $getHeight() }};"
            class="rounded-lg border border-gray-300 shadow-sm overflow-hidden"
            wire:ignore
        >
            <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                <span>Loading Map...</span>
            </div>
        </div>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    </div>
</x-dynamic-component>