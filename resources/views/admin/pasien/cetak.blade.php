<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Hasil Diagnosa</title>

    <link rel="stylesheet" href="/dist/css/adminlte.min.css">

</head>
<body>

    <style>
        @page{
            size: portrait;
            margin: 90px;
        }
    </style>
    <div class="text-center">
        <h3><b>CETAK HASIL DIAGNOSA</b></h3>
        <h4><b>SISTEN PAKAR DIAGNOSA PADA PEROKOK</b></h4>
    </div>

    <table class="table">
        <tr>
            <td width="200px">Nama Pasien</td>
            <td>: {{ $pasien->name }}</td>
        </tr>

        <tr>
            <td>Umur</td>
            <td>: {{ $pasien->umur }}</td>
        </tr>

        <tr>
            <td>Nama Penyakit </td>
            <td>: {{ isset($pasien->penyakit) ? $pasien->penyakit->name : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}</td>
        </tr>

        <tr>
            <td>Keakuratan</td>
            <td>: {{ $pasien->akumulasi_cf }}</td>
        </tr>

        <tr>
            <td>Persentase</td>
            <td>: {{ $pasien->persentase }}%</td>
        </tr>

        <tr>
            <td>Deskripsi </td>
            <td>: {{ isset($pasien->penyakit) ? $pasien->penyakit->desc : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}</td>
        </tr>

        <tr>
            <td>Penanganan</td>
            <td>: {{ isset($pasien->penyakit) ? $pasien->penyakit->penanganan : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}</td>
        </tr>
    </table>

<hr>
    <h4>Gejala</h4>

    <table class="table">
        <tr>
            <th>No</th>
            <th>Gejala</th>
            <th>Nilai</th>
        </tr>

        @foreach ($gejala as $item)
          @if ($item->cf_hasil != 0)
              
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->gejala->name }}</td>
            <td>{{ $item->cf_hasil }}</td>
        </tr>

        @endif  


        @endforeach

    </table>

    <script>
        window.print()
    </script>
</body>
</html>