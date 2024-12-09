<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <?php
    include "koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nik = htmlspecialchars($_POST["nik"]);
        $nama = htmlspecialchars($_POST["nama"]);
        $alamat = htmlspecialchars($_POST["alamat"]);
        $keterangan = htmlspecialchars($_POST["keterangan"]);
        $nohp = htmlspecialchars($_POST["nohp"]);
        $rt = htmlspecialchars($_POST["rt"]);

        $sql = "INSERT INTO anggota (nik, nama, alamat, keterangan, nohp, rt) 
                VALUES ('$nik', '$nama', '$alamat', '$keterangan', '$nohp', '$rt')";

        if (mysqli_query($kon, $sql)) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($kon);
        }
    }
    ?>

    <h2>Tambahkan Anggota</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama Anggota:</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Anggota" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat" required></textarea>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukkan Keterangan" required>
        </div>
        <div class="form-group">
            <label for="nohp">No. Hp:</label>
            <input type="text" name="nohp" id="nohp" class="form-control" placeholder="Masukkan No. Hp" required>
        </div>
        <div class="form-group">
            <label for="rt">Rt:</label>
            <input type="text" name="rt" id="rt" class="form-control" placeholder="Masukkan Rt" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
