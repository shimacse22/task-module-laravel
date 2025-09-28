<!DOCTYPE html>
<html>
<head>
    <title>Task Repeater</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Task Repeater Example</h2>

    <form id="taskForm">
        <div id="taskRepeater">
            <div class="task-row">
                <input type="text" name="tasks[0][title]" placeholder="Task Title">
                <input type="text" name="tasks[0][description]" placeholder="Description">
                <button type="button" class="removeTask">Remove</button>
            </div>
        </div>
        <button type="button" id="addTask">+ Add Task</button>
        <br><br>
        <button type="submit">Save Tasks</button>
    </form>

    <div id="result"></div>

<script>
$(document).ready(function() {
    let taskIndex = 1;

    // Setup CSRF token for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add new task row
    $('#addTask').click(function() {
        $('#taskRepeater').append(`
            <div class="task-row">
                <input type="text" name="tasks[${taskIndex}][title]" placeholder="Task Title" required>
                <input type="text" name="tasks[${taskIndex}][description]" placeholder="Description">
                <button type="button" class="removeTask">Remove</button>
            </div>
        `);
        taskIndex++;
    });

    // Remove a row
    $(document).on('click', '.removeTask', function() {
        $(this).closest('.task-row').remove();
    });

    // Submit via AJAX
    $('#taskForm').submit(function(e) {
        e.preventDefault();
        $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

        $.ajax({
            url: "/api/tasks", // relative URL works in Laravel 12
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#result').html("<p style='color:green;'>Tasks saved successfully!</p>");
                // Optionally clear the form
                $('#taskRepeater').html('');
                taskIndex = 0;
            },
            error: function(xhr) {
                let err = xhr.responseJSON?.message || xhr.responseText;
                $('#result').html("<p style='color:red;'>Error: " + err + "</p>");
            }
        });
    });
});
</script>
</body>
</html>
