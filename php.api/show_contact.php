<?php
include 'condb.php';

try {
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE contact_id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo json_encode(["success" => false, "message" => "ไม่พบข้อมูลติดต่อ"]);
            exit;
        }
        echo json_encode(["success" => true, "data" => $row, "message" => "ดึงข้อมูลติดต่อเรียบร้อย"]);
        exit;
    }

    $stmt = $conn->query("SELECT * FROM contacts ORDER BY contact_id DESC");
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $datas,
        "message" => "ดึงข้อมูลติดต่อเรียบร้อย"
    ]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
