<?php
include 'condb.php';

try {
    $stmt = $conn->query("SELECT * FROM contacts ORDER BY contact_id DESC");
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $datas,
        "message" => "ดึงข้อมูลติดต่อเรียบร้อย"
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
