@extends('front.layouts.master')

@section('style')
	<style type="text/css">

	</style>
@endsection

@section('content')
    <!--slide banner-->
    <section class="carousel-section">
        <div class="carousel-container">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $i=1; ?>
                    @forelse(data_get($data, 'slider', []) as $key => $var)
                        <div class="carousel-item <?php if ($i==1){ ?> active <?php } ?>">
                            <div class="w100-bg type{{$i}}">
                                <img src="{{data_get($var, 'image', array_first($var->images))}}" alt="{{data_get($var, 'summary')}}">
                            </div>
                        </div>
                        <?php $i++; ?>
                    @empty
                        <div class="carousel-item">
                            <div class="w100-bg type1">
                                <img src="/web0617/img/slide01.jpg'" alt="...">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="w100-bg type2">
                                <img src="/web0617/img/slide02.jpg'" alt="...">
                            </div>
                        </div>
                    @endforelse
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="scroll-btn">SCROLL</div>
    </section>

        <!--鍋子介紹A-->
        <section class="fuja-introduceA">
            <div class="container">
                <div class="row">
                    <?php $i=1; ?>
                    @foreach(data_get($data, 'introduce.t01', []) as $key => $var)
                        @if($i%2)
                        <div class="fuja-introduce-left">
                            <img src="{{data_get($var, 'image', array_first($var->images))}}" alt="{{data_get($var, 'summary')}}">
                        </div>
                        @else
                        <div class="fuja-introduce-right">
                            <img src="{{data_get($var, 'image', array_first($var->images))}}" alt="{{data_get($var, 'summary')}}">
                        </div>
                        @endif
                            <?php $i++; ?>
                    @endforeach
                </div>
            </div>
        </section>

        <?php $i=1; $a=array('A','B','C','D'); ?>
        @forelse(data_get($data, 'image.section1', []) as $key => $var)
            <section class="fuja-introduce{{ $a[$i++] }}">
                @if($i!=2+1)
                <img src="{{data_get($var, 'image', array_first($var->images))}}" alt="{{data_get($var, 'summary')}}">
                @endif
            </section>
        @empty
            <!--鍋子介紹B-->
            <section class="fuja-introduceB">
                <img src="{{asset('web0617/img/introduce03.jpg')}}" alt="">
            </section>
            <!--鍋子介紹C-->
            <section class="fuja-introduceC"></section>
            <!--鍋子介紹D-->
            <section class="fuja-introduceD">
                <img src="{{asset('web0617/img/introduce05.jpg')}}" alt="">
            </section>
        @endforelse


        <!--鍋子介紹E-->
            <section class="fuja-introduceE">
                @forelse(data_get($data, 'image.section3', []) as $key => $var)
                    <div class="E-block">
{{--                        <img src="{{data_get($var, 'image', array_first($var->images))}}" alt="{{data_get($var, 'title')}}">--}}
                        <div class="{{data_get($var, 'style')}}"></div>
                        <a href="{{data_get($var, 'url')}}" class="E-btn">
                            <div class="text-area">
                                <div class="heading_bold number">
                                    <span class="oswald">{{data_get($var, 'title')}}</span>
                                </div>
                                <p>{{data_get($var, 'summary')}}</p>
                                <i class="pc-only icon icon-btn_arrow_r"></i>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="E-block">
                        <div class="E-img-l"></div>
                        <a href="#" class="E-btn"><img src="{{asset('/web0617/img/E-btn-left.png')}}" alt="即食鍋"></a>
                    </div>
                    <div class="E-block">
                        <div class="E-img-r"></div>
                        <a href="#" class="E-btn"><img src="{{asset('/web0617/img/E-btn-right.png')}}" alt="即時餐"></a>
                    </div>
                @endforelse
            </section>
@endsection

@section('inline-js')
	<script>

	</script>
@endsection
