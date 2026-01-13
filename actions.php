<?php
include 'db_conn.php';
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    $title = $_POST["title"];
    $note = $_POST["note"];
    switch ($action) {
        case 'save':
            $stmt = $conn->prepare("INSERT INTO notes (title, note) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $note);
            $stmt->execute();
            $stmt->close();
            break;
        case 'delete':
            if ($title) {
                $stmt = $conn->prepare("DELETE FROM notes WHERE title = ?");
                $stmt->bind_param("s", $title);
                $stmt->execute();
                $stmt->close();
            }
            break;
    }
    header("Location: index.php");
    exit;
}
?>