<?php include 'config.php'; ?>

<?php
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute(['id' => $id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Student not found!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name=:name, email=:email, course=:course WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name'=>$name, 'email'=>$email, 'course'=>$course, 'id'=>$id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    <form method="POST">
        Name: <input type="text" name="name" value="<?= $student['name'] ?>" required><br><br>
        Email: <input type="email" name="email" value="<?= $student['email'] ?>" required><br><br>
        Course: <input type="text" name="course" value="<?= $student['course'] ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
    <br>
    <a href="index.php">⬅ Back</a>
</body>
</html>
