<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST["searchTerm"];

    try {
        require_once "dbs.conn.php";

        $firstFilter = "%{$searchTerm}";
        $secondFilter = "%{$searchTerm}%";

        $query = "SELECT * FROM (SELECT userId, CONCAT(firstName, ' ', lastName) AS fullName 
        FROM users) x
        WHERE fullName LIKE :firstFilter OR fullName LIKE :secondFilter
        LIMIT 5";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":firstFilter", $firstFilter);
        $stmt->bindParam(":secondFilter", $secondFilter);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

        echo (json_encode($results));

    } catch (PDOException $e) {
        die("Query Failed" . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}