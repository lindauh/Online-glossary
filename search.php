<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require_once("config.php");

header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['search'])) {

    try {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT 
                          t1.term AS searchTerm,
                          t1.description AS searchDescription,
                          t2.term AS translatedTerm,
                          t2.description AS translatedDescription
                          FROM glossary t1
                          JOIN glossary t2
                            ON t1.term_id = t2.term_id
                          JOIN language
                            ON t1.language_id = language.id
                          WHERE 
                            language.name = :language AND
                            t1.term LIKE :search AND
                            t1.id <> t2.id");


        $search = "%" . $_GET['search'] . "%";
        $stmt->bindParam(":search", $search);
        $stmt->bindParam(":language", $_GET['language_code']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($result);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

