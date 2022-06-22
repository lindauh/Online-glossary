<?php
// pripojenie na databazu
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require_once("config.php");

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = 'SELECT * FROM term';
$stmt = $conn->prepare($sql);
$stmt->execute();
$terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet">
    <title>Admin</title>
</head>

<body>
    <h1>Admin panel</h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($terms) != 0) {
                    foreach ($terms as $term) {
                        echo "<tr><td>{$term['id']}</td><td>{$term['name']}</td><td><a href='edit.php?id={$term['id']}'>Edit</a></td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <form action="upload.php" method="post" enctype="multipart/form-data" class="upload-csv">
            Select csv file to upload:
            <input type="file" name="csv" id="csv" >
            <input type="submit" value="Upload csv" name="submit" class="btn btn-dark">
        </form>
    </div>

    <div id="hrko" class="container"><hr></div>

    
    <div class="container">
        <h2>Upload new term</h2>

        <form action="insert.php" method="POST">
            <div class="mb-3">
                <label for="en_pojem" class="form-label">en_pojem:</label>
                <input type="text" name="en_pojem" id="en_pojem" class="form-control">
            </div>
            <div class="mb-3">
                <label for="en_vysvetlenie" class="form-label">en_vysvetlenie:</label>
                <input type="text" name="en_vysvetlenie" id="en_vysvetlenie" class="form-control">
            </div>
            <div class="mb-3">
                <label for="sk_pojem" class="form-label">sk_pojem:</label>
                <input type="text" name="sk_pojem" id="sk_pojem" class="form-control">
            </div>
            <div class="mb-3">
                <label for="sk_vysvetlenie" class="form-label">sk_vysvetlenie:</label>
                <input type="text" name="sk_vysvetlenie" id="sk_vysvetlenie" class="form-control">
            </div>
            <input type="submit" name="insert" class="btn btn-dark" value="Add new term">
        </form>
    </div>


</body>

</html>