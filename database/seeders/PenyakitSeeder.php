<?php
namespace database\seeders; // Harus ditulis dengan huruf kecil

use Illuminate\database\seeder;
use App\Models\Penyakit;

class PenyakitSeeder extends Seeder
{
    public function run()
    {
        Penyakit::updateOrCreate(
            ['name' => 'Diabetes Mellitus Tipe 1'], // Cari berdasarkan nama penyakit
            [
                'desc' => 'Diabetes Mellitus Tipe 1 adalah kondisi di mana sistem kekebalan tubuh menyerang sel-sel penghasil insulin di pankreas, sehingga tubuh tidak dapat memproduksi insulin yang diperlukan untuk mengatur kadar gula darah.',
                'penanganan' => 'Penanganan utama untuk Diabetes Mellitus Tipe 1 melibatkan terapi insulin harian untuk mengontrol kadar gula darah. Selain itu, penting untuk menerapkan pola makan sehat dengan memperhatikan asupan karbohidrat, rutin berolahraga, dan memantau kadar gula darah secara berkala.',
                'tingkat_penanganan' => json_encode([
                    'rendah' => 'Hasil diagnosis menunjukkan risiko rendah terkena Diabetes Tipe 1. Disarankan untuk mempertahankan gaya hidup sehat dan melakukan pemeriksaan rutin untuk memantau kadar gula darah.',
                    'sedang' => 'Hasil diagnosis menunjukkan risiko sedang. Sebaiknya konsultasikan dengan dokter untuk evaluasi lebih lanjut dan pemeriksaan tambahan guna memastikan kondisi Anda.',
                    'tinggi' => 'Hasil diagnosis menunjukkan risiko tinggi atau kemungkinan adanya Diabetes Tipe 1. Segera temui dokter spesialis untuk mendapatkan diagnosis pasti dan memulai penanganan yang sesuai.',
                    'sangat_tinggi' => 'Hasil diagnosis menunjukkan indikasi kuat adanya Diabetes Tipe 1. Penting untuk segera mendapatkan perawatan medis dan memulai terapi insulin sesuai anjuran dokter.',
                ]),
            ]
        );
        
        Penyakit::updateOrCreate(
            ['name' => 'Diabetes Mellitus Tipe 2'], // Cari berdasarkan nama penyakit
            [
                'desc' => 'Diabetes Mellitus Tipe 2 adalah kondisi di mana tubuh tidak menggunakan insulin secara efektif atau tidak memproduksi cukup insulin, menyebabkan peningkatan kadar gula darah.',
                'penanganan' => 'Penanganan utama untuk Diabetes Mellitus Tipe 2 melibatkan perubahan gaya hidup, seperti mengadopsi pola makan sehat yang rendah kalori dan lemak, meningkatkan aktivitas fisik, dan menurunkan berat badan jika diperlukan. Jika perubahan gaya hidup tidak cukup, dokter mungkin akan meresepkan obat antidiabetes oral atau terapi insulin.',
                'tingkat_penanganan' => json_encode([
                    'rendah' => 'Hasil diagnosis menunjukkan risiko rendah terkena Diabetes Tipe 2. Disarankan untuk mempertahankan gaya hidup sehat, termasuk pola makan seimbang dan olahraga rutin, serta melakukan pemeriksaan gula darah secara berkala.',
                    'sedang' => 'Hasil diagnosis menunjukkan risiko sedang. Sebaiknya konsultasikan dengan dokter untuk evaluasi lebih lanjut dan pertimbangkan perubahan gaya hidup yang lebih intensif untuk mencegah perkembangan diabetes.',
                    'tinggi' => 'Hasil diagnosis menunjukkan risiko tinggi atau kemungkinan adanya Diabetes Tipe 2. Penting untuk segera berkonsultasi dengan dokter untuk mendapatkan diagnosis pasti dan memulai rencana penanganan, termasuk kemungkinan penggunaan obat antidiabetes.',
                    'sangat_tinggi' => 'Hasil diagnosis menunjukkan indikasi kuat adanya Diabetes Tipe 2. Segera temui profesional kesehatan untuk penanganan intensif, yang mungkin meliputi terapi obat dan perubahan gaya hidup signifikan.',
                ]),
            ]
        );        
    }
}
