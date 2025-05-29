<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Klinik</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Statistik Klinik</h3>

                    <!-- Form Filter -->
                   <form method="GET" class="mb-6">
                        <div class="flex flex-wrap justify-between items-end gap-4">
                            <!-- Tanggal Mulai & Selesai -->
                            <div class="flex gap-4">
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                    <input type="date" name="start_date" id="start_date" value="{{ $startDate->format('Y-m-d') }}" class="mt-1 block border border-gray-300 rounded-md">
                                    @error('start_date')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                    <input type="date" name="end_date" id="end_date" value="{{ $endDate->format('Y-m-d') }}" class="mt-1 block border border-gray-300 rounded-md">
                                </div>
                            </div>

                            <!-- Tombol Filter dan Export PDF -->
                            <div class="flex gap-2 items-center">
                                <button type="submit"
                                    class="flex items-center px-4 py-2 border border-blue-600 text-blue-600 bg-white hover:bg-blue-600 hover:text-white rounded-md transition">
                                    Filter
                                </button>
                                <a href="{{ route('admin.laporans.export-pdf', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}"
                                    class="flex items-center px-4 py-2 border border-green-600 bg-white hover:bg-green-600 hover:text-white rounded-md transition">
                                    Unduh Laporan
                                </a>
                            </div>
                        </div>
                    </form>



                    <!-- Kunjungan Per Hari -->
                    <div class="mb-8">
                        <h4 class="text-md font-medium mb-2">Kunjungan Pasien ({{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }})</h4>
                        <canvas id="kunjunganChart" height="100"></canvas>
                    </div>

                    <!-- Tindakan Terbanyak -->
                    <div class="mb-8">
                        <h4 class="text-md font-medium mb-2">Tindakan Terbanyak</h4>
                        <canvas id="tindakanChart" height="100"></canvas>
                    </div>

                    <!-- Obat Terbanyak -->
                    <div>
                        <h4 class="text-md font-medium mb-2">Obat Paling Sering Diresepkan</h4>
                        <canvas id="obatChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Kunjungan Per Hari (Line Chart)
        const kunjunganChart = new Chart(document.getElementById('kunjunganChart'), {
            type: 'line',
            data: {
                labels: @json($labelsKunjungan),
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: @json($dataKunjungan),
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Tindakan Terbanyak (Bar Chart)
        const tindakanChart = new Chart(document.getElementById('tindakanChart'), {
            type: 'bar',
            data: {
                labels: @json($labelsTindakan),
                datasets: [{
                    label: 'Jumlah Tindakan',
                    data: @json($dataTindakan),
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Obat Terbanyak (Bar Chart)
        const obatChart = new Chart(document.getElementById('obatChart'), {
            type: 'bar',
            data: {
                labels: @json($labelsObat),
                datasets: [{
                    label: 'Jumlah Obat Diresepkan',
                    data: @json($dataObat),
                    backgroundColor: 'rgba(245, 158, 11, 0.8)',
                    borderColor: 'rgba(245, 158, 11, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</x-app-layout>
