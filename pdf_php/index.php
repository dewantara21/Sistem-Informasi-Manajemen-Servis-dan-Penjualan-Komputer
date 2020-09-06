<html>
<head>
    <title>Data Siswa</title>
</head>
<body>
<h1>Data Siswa</h1><hr>

<a href="print.php">Cetak Data</a><br><br>

<table border="1" cellpadding="8">
<tr>
    <th>NIS</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Telepon</th>
    <th>Alamat</th>
</tr>
 
<?php
// Load file koneksi.php
include "koneksi.php";
 
$query = "SELECT * FROM siswa"; // Tampilkan semua data gambar
$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
 
if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
    while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
        echo "<tr>";
        echo "<td>".$data['nis']."</td>";
        echo "<td>".$data['nama']."</td>";
        echo "<td>".$data['jenis_kelamin']."</td>";
        echo "<td>".$data['telp']."</td>";
        echo "<td>".$data['alamat']."</td>";
        echo "</tr>";
    }
}else{ // Jika data tidak ada
    echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>
</body>
</html>
