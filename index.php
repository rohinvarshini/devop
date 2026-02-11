<?php
session_start();

// Initialize tasks array if not exists
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Add task
if (isset($_POST['add'])) {
    $subject = $_POST['subject'];
    $assignment = $_POST['assignment'];
    $due = $_POST['due'];
    $priority = $_POST['priority'];

    $_SESSION['tasks'][] = [
        'subject' => $subject,
        'assignment' => $assignment,
        'due' => $due,
        'priority' => $priority
    ];
}

// Delete task
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($_SESSION['tasks'][$index]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homework Planner</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        input, select {
            padding: 8px;
            margin: 5px;
        }
        button {
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        a {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📚 Simple Homework Planner</h2>

    <form method="POST">
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="text" name="assignment" placeholder="Assignment" required>
        <input type="date" name="due" required>
        <select name="priority">
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
        </select>
        <button type="submit" name="add">Add Task</button>
    </form>

    <table>
        <tr>
            <th>Subject</th>
            <th>Assignment</th>
            <th>Due Date</th>
            <th>Priority</th>
            <th>Action</th>
        </tr>

        <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
        <tr>
            <td><?php echo $task['subject']; ?></td>
            <td><?php echo $task['assignment']; ?></td>
            <td><?php echo $task['due']; ?></td>
            <td><?php echo $task['priority']; ?></td>
            <td><a href="?delete=<?php echo $index; ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>

</body>
</html>
