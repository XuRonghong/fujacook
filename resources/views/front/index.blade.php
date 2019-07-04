@extends('front.layouts.master')

@section('style')
	<style type="text/css">

	</style>
@endsection

@section('content')

        <!--鍋子介紹A-->
        <section class="fuja-introduceA">
            <div class="container">
                <div class="row">
                    <?php $i=1; ?>
                    @foreach(data_get($data['arr'], 'image.section1', []) as $key => $var)
                        @if($i%2)
                        <div class="fuja-introduce-left">
                            <img src="{{array_first($var->image)}}" alt="">
                        </div>
                        @else
                        <div class="fuja-introduce-right">
                            <img src="{{array_first($var->image)}}" alt="">
                        </div>
                        @endif
                            <?php $i++; ?>
                    @endforeach
                </div>
            </div>
        </section>
        <!--鍋子介紹B-->
        <section class="fuja-introduceB">
            @foreach(data_get($data['arr'], 'image.section2', []) as $key => $var)
                <img src="{{array_first($var->image)}}" alt="">
{{--                <img src="{{asset('/web0617/img/introduce03.jpg')}}" alt="">--}}
            @endforeach
        </section>
        <!--鍋子介紹C-->
        <section class="fuja-introduceC"></section>
        <!--鍋子介紹D-->
        <section class="fuja-introduceD">
            @foreach(data_get($data['arr'], 'image.section3', []) as $key => $var)
                <img src="{{array_first($var->image)}}" alt="">
                {{--            <img src="{{asset('/web0617/img/introduce05.jpg')}}" alt="">--}}
            @endforeach
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
