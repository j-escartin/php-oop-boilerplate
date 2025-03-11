
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="/edit" method="POST">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $student['name'] ?>" required>
        <br>
        <label>Age:</label>
        <input type="number" name="age" value="<?= $student['age'] ?>" required>
        <br>
        <label>Year Level:</label>
        <input type="text" name="year_level" value="<?= $student['year_level'] ?>" required>
        <br>
        <button type="submit">Save</button>
    </form>
</body>
</html>