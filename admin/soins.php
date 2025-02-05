<?php
session_start();
$pagetitle = 'Soins';
include 'init.php';




$query = "SELECT COUNT(*) AS soins_prothese_count FROM soins WHERE description = 'prothése'";
$stmt = $con->prepare($query);
if ($stmt->execute()) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $soinsProtheseCount = $result['soins_prothese_count'];
} else {
    // Handle query execution failure
    echo "Error: Could not execute the query.";
}
//-----------------------------

$query = "
    SELECT 
        etat, 
        COUNT(*) AS soins_count 
    FROM soins 
    WHERE description = 'prothése' 
    GROUP BY etat
";

// Prepare the statement
$stmt = $con->prepare($query);

// Execute the query and check for errors
if ($stmt->execute()) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pcompletedCount = 0;
    $pnotCompletedCount = 0;


    foreach ($results as $row) {
        if ($row['etat'] == 1) {
            $pcompletedCount = $row['soins_count'];
        } elseif ($row['etat'] == 0) {
            $pnotCompletedCount = $row['soins_count'];
        }
    }
} else {

    echo "Error: Could not execute the query.";
}

//--------------total soins -----------------------------------------
// SQL query
$query = "SELECT COUNT(*) AS soins_blanchiment_count FROM soins WHERE description = 'blanchiment'";

// Prepare the statement
$stmt = $con->prepare($query);

// Execute the query and check for errors
if ($stmt->execute()) {
    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $soinsblanchimentCount = $result['soins_blanchiment_count'];

    // Display the count

} else {
    // Handle query execution failure
    echo "Error: Could not execute the query.";
}
$query = "
    SELECT 
        etat, 
        COUNT(*) AS soins_count 
    FROM soins 
    WHERE description = 'blanchiment' 
    GROUP BY etat
";

// Prepare the statement
$stmt = $con->prepare($query);

// Execute the query and check for errors
if ($stmt->execute()) {
    // Fetch all results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize counts
    $bcompletedCount = 0;
    $bnotCompletedCount = 0;

    // Process results
    foreach ($results as $row) {
        if ($row['etat'] == 1) {
            $bcompletedCount = $row['soins_count'];
        } elseif ($row['etat'] == 0) {
            $bnotCompletedCount = $row['soins_count'];
        }
    }
} else {
    // Handle query execution failure
    echo "Error: Could not execute the query.";
}
//--------------------------------------------------------------------------------------------------------
//--------------total soins -----------------------------------------
// SQL query
$query = "SELECT COUNT(*) AS soins_extraction_count FROM soins WHERE description = 'extraction dentaire'";

// Prepare the statement
$stmt = $con->prepare($query);

// Execute the query and check for errors
if ($stmt->execute()) {
    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $soinsextractionCount = $result['soins_extraction_count'];

    // Display the count

} else {
    // Handle query execution failure
    echo "Error: Could not execute the query.";
}


$query = "
    SELECT 
        etat, 
        COUNT(*) AS soins_count 
    FROM soins 
    WHERE description = 'extraction dentaire' 
    GROUP BY etat
";

// Prepare the statement
$stmt = $con->prepare($query);

// Execute the query and check for errors
if ($stmt->execute()) {
    // Fetch all results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize counts
    $ecompletedCount = 0;
    $enotCompletedCount = 0;

    // Process results
    foreach ($results as $row) {
        if ($row['etat'] == 1) {
            $ecompletedCount = $row['soins_count'];
        } elseif ($row['etat'] == 0) {
            $enotCompletedCount = $row['soins_count'];
        }
    }
} else {

    echo "Error: Could not execute the query.";
}
//--------------------------------------------------------------------------------------------------------



include  $temp . "footer.php";
?>
<h2 class="container mt-2">Soins
    <hr>
</h2>

<div class="container  prothese">
    <div class="overlay">
        <div>
            <h4>Prothese</h4>
            Totale traitement= <?php echo $soinsProtheseCount ?>
            <ul>
                <li><?php echo 'completed = ' . $pcompletedCount ?></li>
                <li><?php echo  'pas fini = ' . $pnotCompletedCount  ?></li>
            </ul>
        </div>
        <button class="  btn btn-primary " onclick="location.href='manage.php?soins=prothése&page=1';" style="width: 100px;"> Manage </button>
    </div>
</div>
<div class="container Blanchements">
    <div class="overlay">
        <div>
            <h4>Blanchements</h4>
            Totale traitement= <?php echo $soinsblanchimentCount ?>
            <ul>
                <li><?php echo 'completed = ' . $bcompletedCount ?></li>
                <li><?php echo  'pas fini = ' . $bnotCompletedCount  ?></li>
            </ul>
        </div>
        <button class="  btn btn-primary " onclick="location.href='manage.php?soins=blanchiment&page=1';" style="width: 100px;"> Manage </button>
    </div>
</div>
<div class="container Extraction-Dentaire">
    <div class="overlay">
        <div>
            <h4>Extraction dentaire</h4>
            Totale traitement= <?php echo $soinsextractionCount ?>
            <ul>
                <li><?php echo 'completed = ' . $ecompletedCount ?></li>
                <li><?php echo  'pas fini = ' . $enotCompletedCount  ?></li>
            </ul>
        </div>
        <button class="  btn btn-primary " onclick="location.href='manage.php?soins=extraction dentaire&page=1';" style="width: 100px;"> Manage </button>
    </div>
</div>