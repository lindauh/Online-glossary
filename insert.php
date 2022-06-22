<?php
// pripojenie na databazu
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require_once("config.php");

$languageIdEn = 1;
$languageIdSk = 2;
$vytiahnutyEnPojem = $_POST['en_pojem'];


try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// nachadza sa ten termin uz v tabulke term?
$sql = 'SELECT id, name FROM term WHERE name=?';
$stmt = $conn->prepare($sql);
$stmt->execute([$vytiahnutyEnPojem]);
$terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ak sa ten EN pojem este nenachadza v tab term
if (!(count($terms) > 0)) {
    $sql = "INSERT INTO term (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$vytiahnutyEnPojem]);

    $sql = 'SELECT id FROM term WHERE name=?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$vytiahnutyEnPojem]);
    $id = $stmt->fetch(PDO::FETCH_ASSOC);               // term_id

    $sql = "INSERT INTO glossary (term, description, language_id, term_id) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['en_pojem'], $_POST['en_vysvetlenie'], 1, $id['id']]);

    $sql = "INSERT INTO glossary (term, description, language_id, term_id) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['sk_pojem'], $_POST['sk_vysvetlenie'], 2, $id['id']]);
}


$newURL = "admin.php";                                                         // presmerovanie na /admin.php po insertnuti
header('Location: ' . $newURL);

