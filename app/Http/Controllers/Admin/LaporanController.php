<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\TransaksiKunjungan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::today()->subDays(7);
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::today();

        if ($startDate->gt($endDate)) {
            return back()->withErrors(['start_date' => 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai.']);
        }

        $kunjunganPerHari = Kunjungan::selectRaw('DATE(tanggal_kunjungan) as tanggal, COUNT(*) as jumlah')
            ->whereBetween('tanggal_kunjungan', [$startDate, $endDate])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labelsKunjungan = $kunjunganPerHari->pluck('tanggal')->map(fn($date) => Carbon::parse($date)->format('d M Y'));
        $dataKunjungan = $kunjunganPerHari->pluck('jumlah');

        $tindakanTerbanyak = TransaksiKunjungan::selectRaw('tindakans.nama, COUNT(*) as jumlah')
            ->join('tindakans', 'transaksi_kunjungans.tindakan_id', '=', 'tindakans.id')
            ->join('kunjungans', 'transaksi_kunjungans.kunjungan_id', '=', 'kunjungans.id')
            ->whereBetween('kunjungans.tanggal_kunjungan', [$startDate, $endDate])
            ->groupBy('tindakans.nama')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        $labelsTindakan = $tindakanTerbanyak->pluck('nama');
        $dataTindakan = $tindakanTerbanyak->pluck('jumlah');

        $obatTerbanyak = TransaksiKunjungan::selectRaw('obats.nama, SUM(transaksi_kunjungans.jumlah_obat) as jumlah')
            ->join('obats', 'transaksi_kunjungans.obat_id', '=', 'obats.id')
            ->join('kunjungans', 'transaksi_kunjungans.kunjungan_id', '=', 'kunjungans.id')
            ->whereBetween('kunjungans.tanggal_kunjungan', [$startDate, $endDate])
            ->groupBy('obats.nama')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        $labelsObat = $obatTerbanyak->pluck('nama');
        $dataObat = $obatTerbanyak->pluck('jumlah');

        return view('admin.laporans.index', compact(
            'labelsKunjungan', 'dataKunjungan',
            'labelsTindakan', 'dataTindakan',
            'labelsObat', 'dataObat',
            'startDate', 'endDate'
        ));
    }

    public function exportPdf(Request $request)
{
    $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::today()->subDays(7);
    $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::today();

    $kunjunganPerHari = Kunjungan::selectRaw('DATE(tanggal_kunjungan) as tanggal, COUNT(*) as jumlah')
        ->whereBetween('tanggal_kunjungan', [$startDate, $endDate])
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();


    $tindakanTerbanyak = TransaksiKunjungan::selectRaw('tindakans.nama, COUNT(*) as jumlah')
        ->join('tindakans', 'transaksi_kunjungans.tindakan_id', '=', 'tindakans.id')
        ->join('kunjungans', 'transaksi_kunjungans.kunjungan_id', '=', 'kunjungans.id')
        ->whereBetween('kunjungans.tanggal_kunjungan', [$startDate, $endDate])
        ->groupBy('tindakans.nama')
        ->orderByDesc('jumlah')
        ->limit(5)
        ->get();


    $obatTerbanyak = TransaksiKunjungan::selectRaw('obats.nama, SUM(transaksi_kunjungans.jumlah_obat) as jumlah')
        ->join('obats', 'transaksi_kunjungans.obat_id', '=', 'obats.id')
        ->join('kunjungans', 'transaksi_kunjungans.kunjungan_id', '=', 'kunjungans.id')
        ->whereBetween('kunjungans.tanggal_kunjungan', [$startDate, $endDate])
        ->groupBy('obats.nama')
        ->orderByDesc('jumlah')
        ->limit(5)
        ->get();


    $pdf = Pdf::loadView('admin.laporans.pdf', compact(
        'kunjunganPerHari', 'tindakanTerbanyak', 'obatTerbanyak',
        'startDate', 'endDate'
    ));

    return $pdf->download('laporan-klinik-' . $startDate->format('Ymd') . '-' . $endDate->format('Ymd') . '.pdf');
}
}
