@extends('back_end.layout.master')
@section('contents')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard/Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users
            </div>
            <div class="card-body">
                <table id="users-table" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Is Admin</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Is Admin</th>
                    </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('list-users')}}",
                method: "post",
                data: {
                    _token: "{{csrf_token()}}"
                }

            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'is_admin', name: 'is_admin'}
            ]
        });
    </script>
@endsection