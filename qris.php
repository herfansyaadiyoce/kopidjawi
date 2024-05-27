<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRIS Payment - Warung Kopidjawi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .input-group {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-text {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body id="page-top">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#00235B" id="mainNav">
        <div class="container">
            <a class="navbar-brand mb-0 h1 d-flex align-items-center" href="index.php">
                <img src="img/cofee.svg" alt="Cup Hot" width="30" height="30" style="margin-right: 8px; filter: invert(100%);">
                <span style="color: white; display: flex; align-items: center;"> WARUNG <strong style="margin-left: 6px;">KOPIDJAWI</strong></span>
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true" style="color: white;"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="konten">
        <div class="container"><br><br>
            <h1 class="judul-keranjang text-center">QRIS Payment</h1><br>
            <div class="text-center">
                <img src="img/qrisasal.jpg" alt="QRIS" class="img-fluid" style="max-width: 300px;">
            </div>
            <br>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form id="uploadForm" action="proses_upload.php" method="post" enctype="multipart/form-data">
                        <p class="form-text text-danger">Upload bukti pembayaran dengan QRIS di sini</p>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control form-control-sm" id="bukti" name="bukti" required>
                            <label class="input-group-text" for="bukti">Browse</label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <br><a href="bayar.php" class="btn btn-success">Kembali</a>
                <a href="masuk.php" id="selesaiBtn" class="btn btn-danger btn-fluid disabled" onclick="return checkFile()">Selesai</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.getElementById('bukti').addEventListener('change', function() {
            var selesaiBtn = document.getElementById('selesaiBtn');
            if (this.files.length > 0) {
                selesaiBtn.classList.remove('disabled');
                selesaiBtn.onclick = null; // Remove the onclick handler
            } else {
                selesaiBtn.classList.add('disabled');
                selesaiBtn.onclick = function() {
                    return false;
                }; // Prevent default action
            }
        });

        function checkFile() {
            var fileInput = document.getElementById('bukti');
            if (fileInput.files.length === 0) {
                alert('Harap upload bukti pembayaran terlebih dahulu.');
                return false;
            }
            return true;
        }
    </script>
</body>

</html>