<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Hasil Diagnosa</title>

    <!-- AdminLTE and Bootstrap for basic styling -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    
    <!-- Add custom styles -->
    <style>
      @page {
            size: A4 portrait;
            margin: 20mm;
        }
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }

        .text-center {
            text-align: center;
        }

        h3, h4 {
            margin: 10px 0;
        }

        .logo {
            width: 150px;
            margin-bottom: 20px;
        }

        .header-text {
            color: #003366;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #003366;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: bold;
            width: 200px;
            display: inline-block;
            color: #003366;
        }

        .info-value {
            display: inline-block;
            font-size: 14px;
        }

        .info-value,
        .info-label {
            padding: 5px;
        }

        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f1f8ff;
            font-weight: bold;
            color: #003366;
        }

        .table td {
            font-size: 14px;
        }

        .table-bordered {
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-responsive {
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <!-- Header with Logo -->
    <div class="text-center">
        <img src="/dist/img/DiabExpert-Logo.png" alt="Logo" class="logo mb-3 mt-3" style="max-width: 120px; opacity: .8;">
        <p class="fs-4 text-primary" style="font-weight: bold;">DiabExpert</p> <!-- DiabExpert text below the image -->
        <h3 class="header-text"><b>CETAK HASIL DIAGNOSA</b></h3>
        <h4 class="header-text"><b>SISTEM PAKAR DIAGNOSA DIABETES MELLITUS</b></h4>
    </div>

    <!-- Patient Info Section -->
    <div class="section-title">Informasi Pasien</div>
    <div class="info-row">
        <span class="info-label">Umur</span>: <span class="info-value">{{ $pasien->umur }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Jenis Kelamin</span>: <span class="info-value">{{ $pasien->jenis_kelamin }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Nama Penyakit</span>: <span class="info-value">{{ isset($pasien->penyakit) ? $pasien->penyakit->name : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Keakuratan</span>: <span class="info-value">{{ $pasien->akumulasi_cf }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Persentase</span>: <span class="info-value">{{ $pasien->persentase }}%</span>
    </div>
    <div class="info-row">
        <span class="info-label">Solusi Medis</span>: 
        <span class="info-value">
            @php
                $tingkat_penanganan = isset($pasien->penyakit) ? json_decode($pasien->penyakit->tingkat_penanganan, true) : null;
            @endphp
    
            @if($pasien->persentase <= 30)
                {{ $tingkat_penanganan['rendah'] ?? 'Tidak ada data' }}
            @elseif($pasien->persentase <= 60)
                {{ $tingkat_penanganan['sedang'] ?? 'Tidak ada data' }}
            @elseif($pasien->persentase <= 90)
                {{ $tingkat_penanganan['tinggi'] ?? 'Tidak ada data' }}
            @else
                {{ $tingkat_penanganan['sangat_tinggi'] ?? 'Tidak ada data' }}
            @endif
        </span>
    </div>
    <div class="info-row">
        <span class="info-label">Deskripsi</span>: <span class="info-value">{{ isset($pasien->penyakit) ? $pasien->penyakit->desc : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Penanganan</span>: <span class="info-value">{{ isset($pasien->penyakit) ? $pasien->penyakit->penanganan : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}</span>
    </div>

    <!-- Divider Line -->
    <hr>

    <!-- Symptoms Section -->
    <div class="section-title">Gejala yang Ditemukan</div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Gejala</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gejala as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->gejala->name }}</td>
                    <td>{{ number_format($item->cf_hasil, 2) }}</td>
                </tr>
            @endforeach
        </tbody>        
    </table>

    <script>
        // Automatically trigger print dialog when the page is loaded
        window.print();
    </script>

</body>
</html>
