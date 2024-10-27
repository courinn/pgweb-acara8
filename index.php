<?php
// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acara8";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Jika ada request untuk menghapus baris
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql_delete = "DELETE FROM penduduk WHERE id = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT * FROM penduduk";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<form method='POST' action=''>";
    echo "<table border='1px'><tr>
    <th>id</th>
    <th>kecamatan</th>
    <th>longitude</th>
    <th>latitude</th>
    <th>luas</th>
    <th>jumlah_penduduk</th>
    <th>Action</th></tr>";
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["id"]."</td>
        <td>".$row["kecamatan"]."</td>
        <td>".$row["longitude"]."</td>
        <td>".$row["latitude"]."</td>
        <td>".$row["luas"]."</td>
        <td align='right'>".$row["jumlah_penduduk"]."</td>
        <td><button type='submit' name='delete_id' value='".$row["id"]."'>Hapus</button></td>
        </tr>";
    }
    echo "</table>";
    echo "</form>";
} else {
    echo "0 results";
}

$conn->close();
?>
