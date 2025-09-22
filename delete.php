<?php include 'config.php'; ?>

<?php
$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: index.php");
exit;
?>
