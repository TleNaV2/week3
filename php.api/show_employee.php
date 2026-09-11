<?php
include 'condb.php';

try {
    $stmt = $conn->query("SELECT * FROM employee");
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $datas,
        "message" => "ดึงข้อมูลพนักงานเรียบร้อย"
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>
