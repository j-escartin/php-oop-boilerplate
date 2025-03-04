<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
</head>
<body>
    <h1>Create Student</h1>
    <form action="/create" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Age:</label>
        <input type="number" name="age" required>
        <br>
        <label>Year Level:</label>
        <input type="text" name="year_level" required>
        <br>
        <button type="submit">Save</button>
    </form>
</body>
</html>