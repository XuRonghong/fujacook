@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    @foreach ($errors->all() as $error)

                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $error }}</strong>
                        </div>

                    @endforeach


                    You are logged in! <a href="#" onclick="history.back()">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
