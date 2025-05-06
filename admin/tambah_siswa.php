<?php
require '../koneksi.php';
$query = "SELECT * FROM kandidat";
$result = mysqli_query($conn, $query);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Anggota</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
      body {
          background-color: #121212; 
           background-image: url('../img/backgroundLogin4.png'); 
          color: white;
      }
      .col-md-2 {
          background-color: #1e1e1e;
          min-height: 100vh;
      }
      .text-turquoise-shadow {
          text-shadow: 2px 2px 8px silver; 
          font-weight: bold;
          font-size: 2rem;
      }
      .border-turquoise {
          border-right: 2px solid silver; 
          box-shadow: 6px 0 15px silver; 
      }
      .border-form {
          border-radius: 10px;
          border: 1px solid silver; 
      }

      .btn-outline-info {
          border-color: silver;
          color: silver; 
      }
      .btn-outline-info:hover {
          background-color: silver; 
          color: #121212; 
      }

      .form-custom
      {
        background-color:rgba(30, 30, 30, 0.89);
      }

      .form-control {
          background-color: #1e1e1e;
          color: white;
          border: 1px solid silver;
      }
      .form-control:focus {
          border-color: silver;
          box-shadow: 0 0 5px silver;
      }

      .col-md-10 {
          padding: 0 100px; 
      }
      .sidebar {
          height: 100vh;
          background-color:rgba(30, 30, 30, 0.55);
          border-right: 2px solid silver;
          box-shadow: 6px 0 15px silver;
      }
      .sidebar .nav-link {
          color: silver;
          margin-bottom: 15px;
          font-weight: 500;
          display: flex;
          align-items: center;
          width: 100%;
          padding-left: 1rem;
      }
      .sidebar .nav-link i {
          margin-right: 10px;
      }
      .sidebar .nav-link:hover {
          background-color: silver;
          color: #121212;
      }
      .card-custom {
          background-color: #1e1e1e;
          border: 1px solid silver;
          color: white;
      }
      .table th, .table td {
          vertical-align: middle;
      }
      .btn-warning {
          color: #121212;
          font-weight: 600;
      }
      .card-img-top {
          width: 100px;
          height: 100px;
          object-fit: cover;
          object-position: center;
          border-radius: 8px;
      }
      .btn-outline-yellow {
          border-color: silver;
          color: silver;
      }
      .btn-outline-yellow:hover {
          background-color: silver;
          color: #121212;
      }
  </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-flex flex-column py-5">
            <h4 class="text-light text-center mb-4">Menu</h4>
            <a href="#" class="nav-link"><i class="bi bi-speedometer2"></i>Dashboard</a>
            <a href="kandidat.php" class="nav-link"><i class="bi bi-person-lines-fill"></i>Kandidat</a>
            <a href="siswa.php" class="nav-link"><i class="bi bi-people-fill"></i>Siswa</a>
            <a href="hasil_vote.php" class="nav-link"><i class="bi bi-bar-chart-line-fill"></i>Hasil Voting</a>
        
            <div class="mt-auto">
        <a href="logout.php" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right"></i>
        </a>
        </div>
        </div>

        <!-- Main content -->
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-warning">Form Anggota</h2>
            </div>

            <!-- Form for Excel Upload -->
            <form action=""  method="post" class="mt-5 form-custom border-form p-4" enctype="multipart/form-data">
                <a href="../excel/template_input_siswa.xlsx" class="btn btn-outline-light mb-3">Download Template Excel</a>
                <div class="mb-3">
                    <label for="excel" class="form-label">Upload File Excel</label>
                    <input type="file" class="form-control" id="excel" name="excel" accept=".xlsx,.xls" required>
                </div>
                <button type="submit" name="import" class="btn btn-warning">Import Data</button>
            </form>

            <?php
                // Menggunakan autoload composer
                require '../excelReader/vendor/autoload.php';

                use PhpOffice\PhpSpreadsheet\IOFactory;

                // Proses upload file Excel
                if (isset($_POST['import'])) {
                    $file_excel = $_FILES['excel']['tmp_name'];

                    try {
                        // Load spreadsheet
                        $spreadsheet = IOFactory::load($file_excel);
                    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                        echo '<a href="/spreadsheet">back</a></br>';
                        die('Error loading file: ' . $e->getMessage());
                    }

                    // Ambil data dari sheet pertama (indeks 0)
                    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                    // Array untuk menyimpan data yang akan dimasukkan
                    $dataToInsert = [];

                    // Mulai dari baris kedua (indeks 2), menghindari baris header
                    foreach ($sheetData as $index => $row) {
                        if ($index === 1) { // Skip baris header
                            continue;
                        }

                        // Cek apakah ada data di kolom yang relevan
                        if (empty($row['A'])) {
                            continue; // Lewati baris jika kolom A kosong
                        }

                        // Ambil nilai kolom sesuai dengan kolom di Excel
                        $nisn = $conn->real_escape_string($row['A']);
                        $nama = $conn->real_escape_string(!empty($row['B']) ? $row['B'] : ''); // Jika kolom B kosong, set nilai default
                        $kelas = $conn->real_escape_string($row['C']);


                        // Query untuk memeriksa apakah data sudah ada di database
                        $checkQuery = "SELECT COUNT(*) as count FROM siswa WHERE nama = '$nama' AND nisn = '$nisn'";
                        $result = $conn->query($checkQuery);

                        if ($result) {
                            $row = $result->fetch_assoc();
                            $count = $row['count'];

                            if ($count == 0) {
                                // Jika data tidak ada di database, tambahkan ke array untuk dimasukkan
                                $dataToInsert[] = "('$nisn', '$nama', '$kelas', 0)";
                            } else {
                                // Jika data sudah ada, skip
                                echo "Data $nisn, $nama sudah ada di database. Dilewati.<br>";
                            }
                        } else {
                            echo "Error: " . $checkQuery . "<br>" . $conn->error;
                        }
                    }

                    // Jika ada data baru untuk dimasukkan, lakukan INSERT
                    if (!empty($dataToInsert)) {
                        $insertQuery = "INSERT INTO siswa (nisn,nama,kelas,status) VALUES " . implode(',', $dataToInsert);

                        if ($conn->query($insertQuery) !== TRUE) {
                            echo "Error: " . $insertQuery . "<br>" . $conn->error;
                        } else {
                            echo "Data baru berhasil diimpor ke database.";
                        }
                    } else {
                        echo "Tidak ada data baru untuk dimasukkan.";
                    }
                }

                // Tutup koneksi
                $conn->close();

                ?>

            <!-- Form for Adding Siswa -->
            <h2 class="text-turquoise-shadow mt-5">Form Siswa</h2>
            <form action="proses_tambah_siswa.php" method="POST" class="container mt-4 border-form p-4 form-custom">
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="form-control" id="kelas" name="kelas" required>
                        <option value=" X RPL">Kelas X RPL</option>
                        <option value=" X A FAR">Kelas X A FAR</option>
                        <option value=" X B FAR">Kelas X B FAR</option>
                        <option value=" X C FAR">Kelas X C FAR</option>
                        <option value=" X TKKR">Kelas X TKKR</option>
                        <option value=" X DKV">Kelas X DKV</option>
                        <option value=" XI RPL">Kelas XI RPL</option>
                        <option value=" XI A FAR">Kelas XI A FAR</option>
                        <option value=" XI B FAR">Kelas XI B FAR</option>
                        <option value=" XI TKKR">Kelas XI TKKR</option>
                        <option value=" XI DKV">Kelas XI DKV</option>
                        <option value=" XII RPL">Kelas XII RPL</option>
                        <option value=" XII A FAR">Kelas XII A FAR</option>
                        <option value=" XII B FAR">Kelas XII B FAR</option>
                        <option value=" XII C FAR">Kelas XII C FAR</option>
                        <option value=" XII TKKR">Kelas XII TKKR</option>
                        <option value=" XII DKV">Kelas XII DKV</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning">Tambah Siswa</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
