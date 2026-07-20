<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Pembelajaran Santri/wati</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td {
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .signature {
            margin-top: 40px;
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Pembelajaran Santri/Wati</h2>
        <p>Per {{ $bulan_nama . " " . $tahun }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="40%">Nama Santri/Wati</th>
                <th width="20%">Level</th>
                <th width="35%">Penilaian</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $index => $user)

            @php
            $grandTotal = $user->total_iqro + $user->total_quran;
            $grandLancar = $user->lancar_iqro + $user->lancar_quran;

            $persentase = $grandTotal > 0
            ? round(($grandLancar / $grandTotal) * 100, 0)
            : 0;
            @endphp

            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-left">{{ $user->name }}</td>
                <td class="text-center">{{ $user->level ?? '-' }}</td>
                <td class="text-center">
                    {{ $persentase }} <br> ({{ $grandLancar . " kali Lancar dari " . $grandTotal . " kali Kehadiran" }})
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="signature">
        <p>Kliteh, {{ $now }}</p>
        <p>Mengetahui,</p>
        <br>
        <!-- <img src="{{ public_path('images/signature.png') }}" style="width: 15%;" alt=""> -->

        <strong>ttd</strong>
        <p><strong>Guru TPQ</strong></p>
    </div>

</body>

</html>