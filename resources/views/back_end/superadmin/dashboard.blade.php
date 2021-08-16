@extends('back_end.layout.master')
@section('contents')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sub-domains</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard/Assign-sub-domains</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users
            </div>
            <div class="card-body">

                <form action="{{route('assign.domain')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="sub-domain">Enter Sub-domain</label>
                            <input class="form-control" type="text" placeholder="don't use spaces, underscores in your domain" name="domain" id="sub-domain">
                            <small class="text-danger" id="error" style="display: none;" >Sub-domain name cannot contain "space" or "_"</small>

                        </div>
                        <div class="col-md-6">
                            <label for="user">Select User</label>
                            <select class="form-control" name="user_id" id="user">
                                <option>Select User</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2" >
                            <button class="btn btn-primary btn-lg" id="save" type="submit">Save</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        $(function(){
            $('#sub-domain').keyup(function () {
                let value = $(this).val();
                if(value.includes(" ") || value.includes('_')){
                    $('#error').show('1000');
                    $('#save').prop('disabled', true);
                    return 0;
                }
                $('#error').hide('1000')
                $('#save').prop('disabled',false);

            });
        });
    </script>
@endsection