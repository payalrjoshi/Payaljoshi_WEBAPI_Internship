<?php
$host = "localhost";
$user = "root";         
$password = "";             
$database_name = "internship";   

$conn = new mysqli($host, $user, $password, $database_name);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'all';

if ($mode == 'all') 
{
    $sql = "SELECT studentname, email, contact, mode FROM student";
} 
else 
{
    $sql = "SELECT studentname, email, contact, mode FROM student WHERE mode = '$mode'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    echo "<table border='1'>";
    echo "<tr>
            <th>Student Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Mode</th>
          </tr>";
    
    while($row = $result->fetch_assoc()) 
    {
        echo "<tr>
                <td>" . $row["studentname"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["contact"] . "</td>
                <td>" . $row["mode"] . "</td>
              </tr>";
    }
    
    echo "</table>";
} 
else 
{
    echo "No records found.";
}

$conn->close();
?>