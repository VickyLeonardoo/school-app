<x-app-layout>
    <div class="py-12 bg-blue-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Alamat Baru</h2>
                    <form action="{{ route('addresses.store') }}" method="POST" class="max-w-lg mx-auto">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border border-blue-300 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="whatsapp" class="block text-gray-700 text-sm font-bold mb-2">Nomor WhatsApp:</label>
                            <input type="text" name="whatsapp" id="whatsapp" class="shadow appearance-none border border-blue-300 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
                            <textarea name="alamat" id="alamat" rows="3" class="shadow appearance-none border border-blue-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        </div>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <div class="mb-4">
                            <button type="button" id="useCurrentLocation" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                                Gunakan Lokasi Saat Ini
                            </button>
                        </div>
                        <div id="map" class="w-full h-64 mb-4 rounded-lg overflow-hidden"></div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                                Simpan Alamat
                            </button>
                            <a href="{{ route('addresses.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const centerLat = -7.755732;
            const centerLon = 110.356416;
            const maxDistance = 2000;

            var map = L.map('map').setView([centerLat, centerLon], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker;
            var circle = L.circle([centerLat, centerLon], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.1,
                radius: maxDistance
            }).addTo(map);

            function updateMarker(lat, lng) {
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker([lat, lng]).addTo(map);
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
            }

            function onMapClick(e) {
                var distance = map.distance(e.latlng, [centerLat, centerLon]);
                if (distance <= maxDistance) {
                    updateMarker(e.latlng.lat, e.latlng.lng);
                } else {
                    alert('Lokasi yang dipilih terlalu jauh. Silakan pilih lokasi dalam radius 2km.');
                }
            }

            map.on('click', onMapClick);

            document.getElementById('useCurrentLocation').addEventListener('click', function() {
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lon = position.coords.longitude;
                        var distance = map.distance([lat, lon], [centerLat, centerLon]);
                        if (distance <= maxDistance) {
                            map.setView([lat, lon], 15);
                            updateMarker(lat, lon);
                        } else {
                            alert('Lokasi Anda saat ini terlalu jauh. Silakan pilih lokasi dalam radius 5km.');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>