@extends('front.layouts2.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <br>
            <h3 align="center">Product Add</h3>
            <br />
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
            @if( session()->has('success'))
            <div class="alert alert-success">
                <p>{{ session()->get('success') }}</p>
            </div>
            @endif

            <form method="post" action="{{route('product.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <input class="form-control" type="text" name="name" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="price" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="image" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="total" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" />
                </div>
            </form>
        </div>
    </div>

@endsection



<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <!-- Public Crop_Image -->
    {{--@include('_web._js.crop_image')--}}
    <!-- end -->
    <!-- Public SummerNote -->
    {{--@include('_web._js.summernote')--}}
    <!-- end -->
@endsection
<!-- ================== /inline-js ================== -->
