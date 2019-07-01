@extends('front.layouts.master')

@section('style')
	<style type="text/css">

	</style>
@endsection

@section('content')

        <!--鍋子介紹A-->
{{--        <section class="fuja-introduceA">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    @foreach(data_get($data['arr'], 'introduce') as $var)--}}
{{--                        {!! $var->detail !!}--}}
{{--                    @endforeach--}}
{{--                    <div class="fuja-introduce-left">--}}
{{--                        <img src="{{asset('/web0617/img/introduce01.jpg')}}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="fuja-introduce-right">--}}
{{--                        <img src="{{asset('/web0617/img/introduce02.jpg')}}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        @foreach(data_get($data['arr'], 'introduce') as $var)
            {!! $var->detail !!}
        @endforeach
        <!--鍋子介紹B-->
{{--        <section class="fuja-introduceB">--}}
{{--            <img src="{{asset('/web0617/img/introduce03.jpg')}}" alt="">--}}
{{--        </section>--}}
        <!--鍋子介紹C-->
        <section class="fuja-introduceC"></section>
        <!--鍋子介紹D-->
        <section class="fuja-introduceD">
            <img src="{{asset('/web0617/img/introduce05.jpg')}}" alt="">
        </section>
        <!--鍋子介紹E-->
        <section class="fuja-introduceE">
            <div class="E-block">
                <div class="E-img-l"></div>
                <a href="#" class="E-btn"><img src="{{asset('/web0617/img/E-btn-left.png')}}" alt="即食鍋"></a>
            </div>
            <div class="E-block">
                <div class="E-img-r"></div>
                <a href="#" class="E-btn"><img src="{{asset('/web0617/img/E-btn-right.png')}}" alt="即時餐"></a>
            </div>
        </section>
        <section class="contactUS">
            <div class="contactUS-btn">
                <img src="{{asset('/web0617/img/contactUS-btn.png')}}" alt="">
            </div>
        </section>
@endsection

@section('inline-js')
	<script>

	</script>
@endsection
