<!DOCTYPE html>
<html>
<head>
    <title>Rekam Medis - {{ $rekamMedi->pasien->nama }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #AA60C8;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #AA60C8;
            margin: 0;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #AA60C8;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table td {
            padding: 5px;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        .resep-table th, .resep-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .resep-table th {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Klinik Sehat</h1>
        <p>Laporan Rekam Medis Pasien</p>
    </div>

    <div class="section">
        <div class="section-title">Informasi Pasien</div>
        <table>
            <tr>
                <td class="label">Nama Pasien</td>
                <td>: {{ $rekamMedi->pasien->nama }}</td>
            </tr>
            <tr>
                <td class="label">No. RM</td>
                <td>: {{ $rekamMedi->pasien->no_rm }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Periksa</td>
                <td>: {{ $rekamMedi->tanggal_periksa->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Dokter Pemeriksa</td>
                <td>: {{ $rekamMedi->dokter->nama }} ({{ $rekamMedi->dokter->spesialis }})</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Hasil Pemeriksaan</div>
        <table>
            <tr>
                <td class="label">Keluhan</td>
                <td>: {{ $rekamMedi->keluhan }}</td>
            </tr>
            <tr>
                <td class="label">Diagnosa</td>
                <td>: {{ $rekamMedi->diagnosa }}</td>
            </tr>
            <tr>
                <td class="label">Tindakan</td>
                <td>: {{ $rekamMedi->tindakan }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Resep Obat</div>
        @if($rekamMedi->resep->count() > 0)
            <table class="resep-table">
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekamMedi->resep as $resep)
                        <tr>
                            <td>{{ $resep->obat->nama_obat }} ({{ $resep->obat->jenis }})</td>
                            <td>{{ $resep->jumlah }} {{ $resep->satuan ?? 'pcs' }}</td>
                            <td>{{ $resep->aturan_pakai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada resep obat.</p>
        @endif
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i') }}</p>
    </div>
</body>
</html>
