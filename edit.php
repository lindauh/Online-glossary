<?php
// pripojenie na databazu
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require_once("config.php");

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST['edit']) && isset($_GET['id']) && (!empty($_GET['id']))) {
    $sql = "UPDATE glossary SET term=?, description=? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['en_pojem'], $_POST['en_vysvetlenie'], $_POST['termENid']]);

    $sql = "UPDATE glossary SET term=?, description=? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['sk_pojem'], $_POST['sk_vysvetlenie'], $_POST['termSKid']]);

    $sql = "UPDATE term SET name=? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['en_pojem'], $_GET['id']]);
}

if (isset($_POST['delete']) && isset($_GET['id']) && (!empty($_GET['id']))) {
    $sql = "DELETE FROM term WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([htmlspecialchars($_GET['id'])]);

    $newURL = "admin.php";                                                         // presmerovanie na /admin.php po deletnuti
    header('Location: ' . $newURL);
}

if (isset($_GET['id']) && (!empty($_GET['id']))) {
    $sql = "SELECT * FROM glossary WHERE language_id = 1 AND term_id = ?;";        // language_id 1 je EN
    $stmt = $conn->prepare($sql);
    $stmt->execute([htmlspecialchars($_GET['id'])]);
    $termEN = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM glossary WHERE language_id = 2 AND term_id = ?;";        // language_id 1 je EN
    $stmt = $conn->prepare($sql);
    $stmt->execute([htmlspecialchars($_GET['id'])]);
    $termSK = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "<p>Nespravne id</>";
}
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
    <title>Edit</title>
</head>

<body>
    <h1>Edit php</h1>
    <?php
    /*
    echo "<pre>";
    var_dump($termEN);
    var_dump($termSK);
    echo "</pre>"*/
    ?>

    <div class="container">
        <form <?php echo "action='edit.php?id=" . htmlspecialchars($_GET['id']) . "'"; ?> method="POST">

            <input type="hidden" id="termENid" name="termENid" value="<?php echo $termEN['id']; ?>">
            <input type="hidden" id="termSKid" name="termSKid" value="<?php echo $termSK['id']; ?>">

            <div class="mb-3">
                <label for="en_pojem" class="form-label">en_pojem:</label>
                <input type="text" name="en_pojem" id="en_pojem" class="form-control" value="<?php echo $termEN['term']; ?>">
            </div>
            <div class="mb-3">
                <label for="en_vysvetlenie" class="form-label">en_vysvetlenie:</label>
                <input type="text" name="en_vysvetlenie" id="en_vysvetlenie" class="form-control" value="<?php echo $termEN['description']; ?>">
            </div>
            <div class="mb-3">
                <label for="sk_pojem" class="form-label">sk_pojem:</label>
                <input type="text" name="sk_pojem" id="sk_pojem" class="form-control" value="<?php echo $termSK['term']; ?>">
            </div>
            <div class="mb-3">
                <label for="sk_vysvetlenie" class="form-label">sk_vysvetlenie:</label>
                <input type="text" name="sk_vysvetlenie" id="sk_vysvetlenie" class="form-control" value="<?php echo $termSK['description']; ?>">
            </div>

            <div class="mb-3">
                <input type="submit" name="edit" class="btn btn-dark" value="Edit">

                <!-- Spustacie tlacidlo modalneho okna = Delete button -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>

                <!-- Modalne okno pri vymazavani -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure deleting this evidence?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="button"  class="btn btn-secondary" value="Back" onclick="window.location.href='https://site185.webte.fei.stuba.sk/cv3/admin.php';">
            </div>
        </form>
    </div>

</body>

</html>