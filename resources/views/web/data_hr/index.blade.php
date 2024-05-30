<!DOCTYPE html>
<html>
<head>
    <title>Laravel Excel Import</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <form action="{{ route('users.export.selected') }}" method="POST" id="export-form">
                @csrf
                <button type="submit" class="btn btn-info mt-4">Export Selected Users to Excel</button>
                <table class="table table-bordered mt-4">
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td><input type="checkbox" name="selected_users[]" value="{{ $user->id }}"></td>
                            <td>{{ $user->ho_va_ten }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#select-all').click(function(){
            $('input[name="selected_users[]"]').prop('checked', this.checked);
        });
    });
</script>

</body>
</html>
