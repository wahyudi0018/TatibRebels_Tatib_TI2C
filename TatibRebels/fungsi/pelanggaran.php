<?php
include 'config/koneksi.php';

class Pelanggaran {
    public function __construct() {

    }

    public function tampilTingkatPelanggaran() {
        global $koneksi;
        
        $query = "SELECT tingkat, deskripsi FROM tingkat_pelanggaran ORDER BY id DESC";
        $result = $koneksi -> query($query);

        if ($result -> num_rows > 0){
            while ($row = $result -> fetch_assoc()){
                echo 
                '<div class="tingkat-pelanggaran-item">' .
                    '<h3>Tingkat ' . $row["tingkat"] . '</h3>' . 
                    '<div>' . $row["deskripsi"] . "</div>" .
                '</div>';
            }
        }
    }

    public function tampilDeskripsiPelanggaran() {
        global $koneksi;

        $query = "
            SELECT p.id, p.deskripsi, t.tingkat 
            FROM pelanggaran AS p LEFT JOIN 
            tingkat_pelanggaran AS t 
            ON p.id_tingkat = t.id WHERE tanda = 'simpan'
        ";
        
        $result = $koneksi -> query($query);

        if ($result->num_rows > 0) {
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                $row["no_urut"] = $counter;
                $counter++;

                echo 
                '<div class="klasifikasi-item">' .
                    '<div class="kolom-no">' . $row["no_urut"] . '</div>' . 
                    '<div class="kolom-pelanggaran">' . $row["deskripsi"] . '</div>' . 
                    '<div class="kolom-tingkat">' . $row["tingkat"] . '</div>' .
                '</div>';
            }
        }
    }

    public function tampilAkumulasiPelanggaran(){
        global $koneksi;

        $query = "SELECT tingkat FROM tingkat_pelanggaran";
        $result = $koneksi -> query($query);

        if ($result -> num_rows > 0){
            $tingkatPrev = null; 

            while ($row = $result -> fetch_assoc()){              
                $tingkat = $row['tingkat'];

                if ($tingkatPrev !== null){
                    echo 
                    '<li class="poin-akumulasi">' .
                        'Apabila pelanggaran tingkat ' . $tingkatPrev . ' dilakukan 3 (tiga) kali maka
                        klasifikasi pelanggaran tersebut ditingkatkan menjadi pelanggaran
                        tingkat ' . $tingkat . '.' .
                    '</li>';
                }

                $tingkatPrev = $tingkat;
            }
        }   
    }

    public function tampilSanksiPelanggaran(){
        global $koneksi;

        $query = "
            SELECT t.tingkat, s.deskripsi
            FROM tingkat_pelanggaran AS t
            INNER JOIN sanksi AS s ON t.id = s.id
        ";

        $result = $koneksi -> query($query);

        if ($result -> num_rows > 0){
            while ($row = $result -> fetch_assoc()){              
                echo
                '<div class="sanksi-item">' .
                    '<div class="sanksi-tingkat">Sanksi atas pelanggaran Tingkat ' . $row['tingkat'] . '</div>' .
                    '<div class="detail-sanksi">' . $row["deskripsi"] . "</div>" .
                '</div>';
            }
        }
    }
}
?>