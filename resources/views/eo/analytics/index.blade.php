<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                    {{ __('Keuntungan & Analitik') }}
                </h2>
                <p class="text-slate-500 text-sm font-medium mt-1">Laporan performa penjualan tiket dan pendapatan seluruh event Anda.</p>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <button onclick="window.print()" class="w-full md:w-auto justify-center bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Laporan
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Summary KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Pendapatan -->
                <div class="bg-gradient-to-br from-[#4F46E5] to-[#3B82F6] rounded-3xl p-6 text-white shadow-lg shadow-blue-500/20 relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-blue-100 uppercase tracking-widest">Total Pendapatan</span>
                        </div>
                        <h3 class="text-3xl font-bold tracking-tight">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <!-- Total Tiket Terjual -->
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tiket Terjual</span>
                        </div>
                        <h3 class="text-3xl font-bold text-deep-navy">{{ number_format($totalTickets) }} <span class="text-sm font-bold text-slate-400">Tiket</span></h3>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Transaksi Sukses</span>
                        </div>
                        <h3 class="text-3xl font-bold text-deep-navy">{{ number_format($totalTransactions) }} <span class="text-sm font-bold text-slate-400">Order</span></h3>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Chart Area (Takes up 2 columns on lg) -->
                <div class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-lg text-deep-navy">Grafik Pendapatan (6 Bulan Terakhir)</h3>
                    </div>
                    <div class="relative h-72 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Top Events List -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                        <h3 class="font-bold text-lg text-deep-navy">Top Event (Berdasarkan Pendapatan)</h3>
                    </div>
                    <div class="flex-1 overflow-y-auto max-h-[350px] p-2">
                        @if($eventStats->isEmpty())
                            <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                                <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </div>
                                <p class="text-xs font-bold text-slate-500">Belum ada data event</p>
                            </div>
                        @else
                            <div class="space-y-1">
                                @foreach($eventStats->take(5) as $index => $stat)
                                    <div class="flex items-center gap-4 p-4 hover:bg-slate-50 rounded-2xl transition-colors">
                                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">
                                            #{{ $index + 1 }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-deep-navy truncate">{{ $stat->name }}</p>
                                            <p class="text-xs text-slate-500">{{ number_format($stat->tickets_sold) }} Tiket Terjual</p>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <p class="text-sm font-bold text-electric-blue">Rp {{ number_format($stat->revenue, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detailed Event Performance Table -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50">
                    <h3 class="font-bold text-lg text-deep-navy">Performa Semua Event</h3>
                </div>
                <div class="overflow-x-auto pb-4">
                    <table class="w-full text-left border-collapse whitespace-nowrap lg:whitespace-normal">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Event</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Tiket Terjual</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($eventStats as $stat)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-deep-navy">{{ $stat->name }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($stat->status === 'published')
                                            <span class="inline-block px-2 py-1 bg-green-50 text-green-600 rounded text-[10px] font-bold uppercase tracking-wider">Aktif</span>
                                        @elseif($stat->status === 'selesai')
                                            <span class="inline-block px-2 py-1 bg-slate-100 text-slate-600 rounded text-[10px] font-bold uppercase tracking-wider">Selesai</span>
                                        @else
                                            <span class="inline-block px-2 py-1 bg-yellow-50 text-yellow-600 rounded text-[10px] font-bold uppercase tracking-wider">Draft</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <p class="text-sm font-bold text-slate-700">{{ number_format($stat->tickets_sold) }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <p class="text-sm font-bold text-deep-navy">Rp {{ number_format($stat->revenue, 0, ',', '.') }}</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <p class="text-sm font-medium text-slate-400">Belum ada data performa event.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js Script -->
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            // Gradient for line chart
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(79, 70, 229, 0.2)'); // #4F46E5 with opacity
            gradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: {!! json_encode($chartRevenue) !!},
                        borderColor: '#4F46E5',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#4F46E5',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#0F172A',
                            titleFont: { size: 13, family: "'Inter', sans-serif" },
                            bodyFont: { size: 14, weight: 'bold', family: "'Inter', sans-serif" },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let value = context.raw;
                                    return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#F1F5F9',
                                drawBorder: false,
                            },
                            ticks: {
                                color: '#94A3B8',
                                font: { size: 11, family: "'Inter', sans-serif", weight: 'bold' },
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000) + ' Jt';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000) + ' Rb';
                                    }
                                    return 'Rp ' + value;
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                color: '#94A3B8',
                                font: { size: 11, family: "'Inter', sans-serif", weight: 'bold' }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
