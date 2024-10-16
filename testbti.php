<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Soal</title>
</head>
<body>
    <form method="POST">
        <label>Soal (Masukkan nilai-nilai tiap pertanyaan yang dipisah dengan koma, maksimal 10 pertanyaan):</label>
        <br><br>
        <input type="text" name="nilai_soal" required>
        <br><br>
        <label>T: </label>
        <input type="number" name="nilai_total" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //ambil dari soalnya, lalu dipecah, diubah dari string ke integer
        $nilai_soal_input = $_POST['nilai_soal'];  
        $nilai_soal = explode(",", $nilai_soal_input);  
        
        
        for ($i = 0; $i < count($nilai_soal); $i++) {
            $nilai_soal[$i] = (int)$nilai_soal[$i];  
        }

        $nilai_total = (int)$_POST['nilai_total'];  

        // Fungsi untuk mencari kombinasi yang totalnya sama dengan T
        function cariKombinasi($arr, $target) {
            $jumlah_elemen = count($arr);
            for ($i = 0; $i < (1 << $jumlah_elemen); $i++) {  // Looping untuk cari kombinasi
                $subset = [];
                $total = 0;

                for ($j = 0; $j < $jumlah_elemen; $j++) {
                    if ($i & (1 << $j)) {
                        $subset[] = $arr[$j];  // Tambahkan elemen ke subset
                        $total += $arr[$j];    // Hitung total dari subset
                    }
                }

                if ($total == $target) {  // Jika total sesuai dengan target, tampilkan hasil
                    echo "<pre>Array\n(\n";
                    foreach ($subset as $kunci => $nilai) {
                        echo "    [$kunci] => $nilai\n";
                    }
                    echo ")\n</pre><br>";
                }
            }
        }

        // output soal
        echo "<h3>SOAL</h3><pre>Array\n(\n";
        for ($i = 0; $i < count($nilai_soal); $i++) {
            echo "    [pertanyaan " . ($i + 1) . "] => " . $nilai_soal[$i] . "\n";
        }
        echo ")\n</pre><br>";
        echo "Dengan Nilai total soal (T) = $nilai_total<br>";

        // output hasil
        echo "<h3>JAWABAN</h3>";
        cariKombinasi($nilai_soal, $nilai_total);
    }
    ?>
</body>
</html>
