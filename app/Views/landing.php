<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>
    <h1>Student Records</h1>
    <a href="/create"><button>Create Student</button></a>
    <?php if(!empty($students)):?>
        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Year Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($students as $student):?>
                    <tr>
                        <td><?= htmlspecialchars($student['name'])?></td>
                        <td><?= htmlspecialchars($student['age'])?></td>
                        <td><?= htmlspecialchars($student['year_level'])?></td>
                        <td>
                            <a href="/edit?id=<?= $student['id'] ?>"><button>Edit</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No students records found.</p>
    <?php endif; ?>
</body>
</html>