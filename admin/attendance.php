<?php 
include('../includes/config.php'); // Include your database configuration

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attendance'])) {
    $attendance_date = date('Y-m-d', strtotime($_POST['attendance_date']));
    $class_id = $_POST['class_id'];

    // Loop through each student to save attendance
    foreach ($_POST['attendance'] as $student_id => $status) {
        // Check if the attendance already exists for the date
        $check_sql = "SELECT * FROM attendance WHERE student_id = $student_id AND attendance_date = '$attendance_date'";
        $check_query = mysqli_query($db_conn, $check_sql);

        if (mysqli_num_rows($check_query) > 0) {
            // Update existing attendance record
            $update_sql = "UPDATE attendance SET status = '$status' WHERE student_id = $student_id AND attendance_date = '$attendance_date'";
            mysqli_query($db_conn, $update_sql);
        } else {
            // Insert new attendance record
            $insert_sql = "INSERT INTO attendance (student_id, attendance_date, status) VALUES ($student_id, '$attendance_date', '$status')";
            mysqli_query($db_conn, $insert_sql);
        }
    }

    echo "<div class='alert alert-success'>Attendance recorded successfully!</div>";
}

// Fetch classes
$classes_sql = "SELECT * FROM classes";
$classes_query = mysqli_query($db_conn, $classes_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add Attendance</h1>
        
        <form action="" method="POST" class="mb-4">
            <div class="form-group">
                <label for="class_id">Select Class:</label>
                <select name="class_id" id="class_id" class="form-control" required>
                    <option value="">--Select Class--</option>
                    <?php while ($class = mysqli_fetch_assoc($classes_query)): ?>
                        <option value="<?php echo $class['id']; ?>"><?php echo htmlspecialchars($class['class_name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="attendance_date">Attendance Date:</label>
                <input type="date" name="attendance_date" id="attendance_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">View Students</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['class_id'])): ?>
            <?php
            // Fetch students of the selected class
            $class_id = $_POST['class_id'];
            $students_sql = "SELECT * FROM students WHERE class_id = $class_id";
            $students_query = mysqli_query($db_conn, $students_sql);
            ?>
            <form action="" method="POST">
                <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                <input type="hidden" name="attendance_date" value="<?php echo $_POST['attendance_date']; ?>">
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($student = mysqli_fetch_assoc($students_query)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['name']); ?></td>
                                <td>
                                    <select name="attendance[<?php echo $student['id']; ?>]" class="form-control">
                                        <option value="Present">Present</option>
                                        <option value="Absent">Absent</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Submit Attendance</button>
            </form>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
