<!DOCTYPE html>
<html>
<head>
    <title>Simple Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>

    <!-- Form to add a new task -->
    <form method="POST" action="/tasks">
        @csrf
        <input type="text" name="title" placeholder="New task" required>
        <button>Add</button>
    </form>

    <!-- List of tasks -->
    <ul>
        @foreach($tasks as $task)
            <li>
                <span style="text-decoration: {{ $task->completed ? 'line-through' : 'none' }}">
                    {{ $task->title }}
                </span>

                <!-- Toggle complete -->
                <a href="/tasks/toggle/{{ $task->id }}">✔</a>

                <!-- Delete task -->
                <a href="/tasks/delete/{{ $task->id }}">✖</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
