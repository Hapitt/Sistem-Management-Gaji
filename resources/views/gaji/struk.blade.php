<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Slip Gaji - {{ $karyawan->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @page { margin: 0px; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fbfc;
            margin: 0;
            padding: 40px;
            color: #1e293b;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #2563eb;
            font-size: 26px;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .header p {
            color: #64748b;
            font-size: 13px;
            margin: 5px 0;
        }
        .section-title {
            font-weight: 600;
            color: #334155;
            margin-top: 25px;
            margin-bottom: 10px;
            font-size: 15px;
            border-left: 4px solid #3b82f6;
            padding-left: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th, td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }
        th {
            background: #f8fafc;
            font-weight: 600;
            color: #1e293b;
            width: 40%;
            text-align: left;
        }
        td {
            width: 60%;
            text-align: left;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .highlight {
            background: #f1f5f9;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
        }
        .total {
            font-weight: 700;
            font-size: 16px;
            text-align: right;
            color: #2563eb;
        }
        .logic {
            font-size: 13px;
            text-align: right;
            color: #64748b;
            margin-top: 6px;
        }
        .footer {
            text-align: center;
            margin-top: 35px;
            font-size: 12px;
            color: #94a3b8;
        }
        .footer span {
            color: #2563eb;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Slip Gaji Karyawan</h1>
            <p>Periode: {{ \Carbon\Carbon::parse($gaji->periode)->translatedFormat('F Y') }}</p>
        </div>

        <div class="section-title">Informasi Karyawan</div>
        <table>
            <tr>
                <th>Nama</th>
                <td>{{ $karyawan->nama }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $karyawan->nama_jabatan }}</td>
            </tr>
            <tr>
                <th>Divisi</th>
                <td>{{ $gaji->karyawan->divisi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Rating</th>
                <td>Rating {{ $karyawan->rating }} ({{ round($karyawan->presentase_bonus * 100) }}%)</td>
            </tr>
        </table>

        <div class="section-title">Detail Gaji</div>
        <table>
            <tr>
                <th>ID Gaji</th>
                <td>{{ $gaji->id_gaji }}</td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>{{ $gaji->periode }}</td>
            </tr>
            <tr>
                <th>Lama Lembur</th>
                <td>{{ $gaji->lama_lembur }} jam</td>
            </tr>
            <tr>
                <th>Gaji Pokok</th>
                <td>Rp {{ number_format($karyawan->gaji_pokok ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Tunjangan</th>
                <td>Rp {{ number_format($gaji->total_tunjangan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Bonus</th>
                <td>Rp {{ number_format($gaji->total_bonus, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Lembur</th>
                <td>Rp {{ number_format($gaji->total_lembur, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="highlight">
            <div class="total">Total Pendapatan: Rp {{ number_format($gaji->total_pendapatan, 0, ',', '.') }}</div>
        </div>

        <div class="footer">
            <p>Slip ini dibuat otomatis oleh sistem <span>Manajemen Gaji</span>.<br>
            Dicetak pada {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
        </div>
    </div>
</body>
</html>