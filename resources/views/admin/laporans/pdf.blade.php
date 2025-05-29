<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Klinik</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        h2 { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; text-align: left; padding: 8px; }
        th { background-color: #f2f2f2; }
        .periode { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Laporan Klinik</h1>
    <p class="periode">Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>

    <h2>Kunjungan Per Hari</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjunganPerHari as $kunjungan)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('d M Y') }}</td>
                    <td>{{ $kunjungan->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Tindakan Terbanyak</h2>
    <table>
        <thead>
            <tr>
                <th>Tindakan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tindakanTerbanyak as $tindakan)
                <tr>
                    <td>{{ $tindakan->nama }}</td>
                    <td>{{ $tindakan->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Obat Paling Sering Diresepkan</h2>
    <table>
        <thead>
            <tr>
                <th>Obat</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obatTerbanyak as $obat)
                <tr>
                    <td>{{ $obat->nama }}</td>
                    <td>{{ $obat->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
