@extends('front.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <br>
            <h3 align="center">Product Edit</h3>
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

            <form method="post" action="{{route('product.update', $id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH" />
                <div class="form-group">
                    <input class="form-control" type="text" name="name" value="{{$product->name}}"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="price" value="{{$product->price}}" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="image" value="{{$product->image}}" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="total" value="{{$product->total}}" />
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
