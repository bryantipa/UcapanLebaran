<?php

include 'config.php';
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];

    //query untuk memasukkan data ke dalam tabel
    $query = "INSERT INTO pesan (nama, pesan) VALUES ('$nama', '$pesan')";

    //eksekusi query dan cek apakah data berhasil dimasukkan
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dimasukkan ke dalam database')</script>";
        header("refresh:0.1; url=index.php");
    } else {
        echo "<script>alert('Data gagal dimasukkan ke dalam database')</script>";
    }

    // redirect ke halaman lain setelah 5 detik

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="buka">
        <button>Buka Kartu</button>
        <audio id="mp3" class="mp3" src="mp3.mp3" loop></audio>
    </div>
    <!--  -->
    <div class="container text-center">
        <div class="gambar">
            <img src="img/img.png" alt="ketupat">
        </div>
        <div class='greeting-text text-center'>
            <h1>.: Selamat Hari Raya Idul Fitri :.</h1>
            <br>
            <h1>Mohon maaf lahir dan batin</h1>
        </div>
        <!-- <a href="#pesan" class="tulisan">Beri pesan</a> -->

    </div>
    <!-- bagian Form -->
    <!-- Scrollable modal -->
    <!-- Button trigger modal -->
    <button type="button " class="tulisan btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Beri pesan
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Berikan pesan Anda:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nama Anda" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">pesan
                                anda</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="pesan"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="submit" class="btn btn-success">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--  --><br> <br>
    <!-- button triger -->
    <button type="button pt-5" class="tulisan btn-success" data-bs-toggle="modal" data-bs-target="#lihatpesan">
        Lihat pesan
    </button>
    <!-- scroll modal -->
    <div class="modal fade" id="lihatpesan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pesan Selamat Lebaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    $sql = "SELECT * FROM pesan ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);


                    if (mysqli_num_rows($result) > 0) {
                        // Output data dari setiap baris
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <?= $row['nama'] ?>;
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <?= $row['pesan'] ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "0 results";
                    }

                    mysqli_close($conn);
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script>
        const button = document.querySelector("button");
        const buka = document.querySelector(".buka");
        const mp3 = document.querySelector(".mp3");

        button.addEventListener("click", function () {
            buka.classList.add("fade-in");
            mp3.play();
            setTimeout(function () {
                buka.style.display = "none"; // mengubah properti display ke none
            }, 10);
        });

    </script>
</body>

</html>