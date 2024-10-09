<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$database = new Database();
$db = $database->getConnection();

switch($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            getCourse($db, $_GET['id']);
        } else {
            getCourses($db);
        }
        break;
    case 'POST':
        addCourse($db);
        break;
    case 'PUT':
        if (isset($_GET['id'])) {
            updateCourse($db, $_GET['id']);
        }
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            deleteCourse($db, $_GET['id']);
        }
        break;
    default:
        echo json_encode(["message" => "Méthode non autorisée"]);
}

function getCourses($db) {
    $query = "SELECT * FROM courses";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($courses);
}

function getCourse($db, $id) {
    $query = "SELECT * FROM courses WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();

    $course = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($course) {
        echo json_encode($course);
    } else {
        echo json_encode(["message" => "Cours non trouvé"]);
    }
}

function addCourse($db) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!empty($data['title']) && !empty($data['description']) && !empty($data['level'])) {
        $query = "INSERT INTO courses (title, description, level) VALUES (:title, :description, :level)";
        $stmt = $db->prepare($query);
        
        // Validation des données
        $stmt->bindParam(':title', htmlspecialchars(strip_tags($data['title'])));
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($data['description'])));
        $stmt->bindParam(':level', htmlspecialchars(strip_tags($data['level'])));
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "Cours ajouté avec succès"]);
        } else {
            echo json_encode(["message" => "Impossible d'ajouter le cours"]);
        }
    } else {
        echo json_encode(["message" => "Données incomplètes"]);
    }
}

function updateCourse($db, $id) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!empty($data['title']) && !empty($data['description']) && !empty($data['level'])) {
        $query = "UPDATE courses SET title = :title, description = :description, level = :level WHERE id = :id";
        $stmt = $db->prepare($query);

        // Validation des données
        $stmt->bindParam(':title', htmlspecialchars(strip_tags($data['title'])));
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($data['description'])));
        $stmt->bindParam(':level', htmlspecialchars(strip_tags($data['level'])));
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Cours mis à jour avec succès"]);
        } else {
            echo json_encode(["message" => "Impossible de mettre à jour le cours"]);
        }
    } else {
        echo json_encode(["message" => "Données incomplètes"]);
    }
}

function deleteCourse($db, $id) {
    $query = "DELETE FROM courses WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Cours supprimé avec succès"]);
    } else {
        echo json_encode(["message" => "Impossible de supprimer le cours"]);
    }
}
?>
