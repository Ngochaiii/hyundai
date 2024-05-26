<!DOCTYPE html>
<html>
<head>
    <title>Laravel Excel Import</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Laravel Excel Import</h2>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="file" class="form-control">
                </div>
                <button class="btn btn-success">Import Users</button>
            </form>
            <table class="table table-bordered mt-4">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->ho_va_ten }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</body>
</html>
