<?php

session_start();

if(isset($_SESSION['Username'])){
    $pagetitle="Membres";
    include 'init.php';
    include  $temp . "footer.php";


}

?>
 <div class="mt-4 container">
    <h3>Membres</h3>
   <?php $query = "SELECT * FROM users";
$stmt = $con->prepare($query);

// Execute the query
if ($stmt->execute()) {
    // Fetch all users
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through the results and display user information
    echo "<table class='table'>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Nom d'utilisateur </th>
            <th>Numéro</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>";

// Loop through the results and display user information in the table
foreach ($users as $user) {
echo "<tr>
        <td>" . htmlspecialchars($user['UserId']) . "</td>
        <td>" . htmlspecialchars($user['Username']) . "</td>
        <td>" . htmlspecialchars($user['Numero']) . "</td>
        <td>" . htmlspecialchars($user['Email']) . "</td>
      </tr>";
}

// Close the table
echo "</tbody></table>";
} else {
// Handle query execution failure
echo "Error: Could not execute the query.";
} ?>
 </div>    
 
