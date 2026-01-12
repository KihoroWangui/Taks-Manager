<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container mt-5">

    <h1 class="mb-4 text-center">Task Manager</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3 text-end">
        <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#taskForm">
            <i class="bi bi-plus-lg"></i> Add New Task
        </button>
    </div>

    <div class="collapse mb-4" id="taskForm">
        <div class="card card-body shadow-sm">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter task title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter task description"></textarea>
                </div>
                <button class="btn btn-success"><i class="bi bi-save"></i> Save Task</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr class="{{ $task->is_completed ? 'table-success' : '' }}">
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->is_completed ? 'Done' : 'Pending' }}</td>
                            <td class="text-center">
                               
                                @if(!$task->is_completed)
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-success" title="Mark as Complete">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                @endif

                                
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No tasks found. Add a new task above!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
