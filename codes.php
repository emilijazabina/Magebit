<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Emails (email)
VALUES ($_POST["email"])";




//this function dynamically outputs a basic HTML table from mysql result
function createTable($result) {
    $table = '<table><tr>';
    for ($x=0;$x<mysql_num_fields($result);$x++) $table .= '<th>'.mysql_field_name($result,$x).'</th>';
    $table .= '</tr>';
    while ($rows = mysql_fetch_assoc($result)) {
    $table .= '<tr>';
    foreach ($rows as $row) $table .= '<td>'.$row.'</td>';
    $table .= '</tr>';
    }
    $table .= '<table>';
    return $table; 
}

//creates buttons to filter emails
$sql = "SELECT email FROM Emails group by emails";  
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $your_url ="html_for_php.html";
        echo "". $row["theme_name"].  "<br>";
        echo '<a href="'.$your_url.'"><input type="button" name="' .  $row["email"]. '" value="'. $row["email"].'"></a>';
    }
} else {
    echo "no results";
}

function outTable(){
    $sql = "SELECT id, firstname, lastname FROM MyGuests ORDER BY lastname";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Email: " . $row["email"]. "date" . $row["reg_date"]. "<br>";
  }
} else {
  echo "0 results";
}
}
function specificOutput(){
    $result = mysqli_query($con,"SELECT `note` FROM `glogin_users` WHERE email = '".$email."'");
    createTable($result);
}

//search for emails
function emailSearch(){
    $term = mysql_real_escape_string($_REQUEST['term']);    

$sql = "SELECT * FROM email WHERE email LIKE '%".$term."%'";
$result = mysql_query($sql);
    createTable($result);

} 

}
//sorting by date
function sortByDateAsc(){

    $$sql = "SELECT * FROM email order by reg_date asc";
    $result = mysql_query($sql);
    createTable($result);
}
function sortByDateDesc(){

    $$sql = "SELECT * FROM email order by reg_date desc";
    $result = mysql_query($sql);
    createTable($result);
}

function deleteEmail(){
    $sql =  "DELETE FROM email
    WHERE id = $terms "
    $result = mysql_query($sql);
    createTable($result);
}








$conn->close();

?>
