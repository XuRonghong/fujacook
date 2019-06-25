
<!--slide banner-->
<section class="carousel-section">
    <div class="carousel-container">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $i=1; ?>
                @forelse(data_get($data['arr'], 'aaData', []) as $key => $var)
                <div class="carousel-item <?php if ($i==1){ ?> active <?php } ?>">
                    <div class="w100-bg type{{$i}}">
{{--                        <img src="{{asset('/web0617/img/slide01.jpg')}}" alt="...">--}}
                        <img src="{{asset( array_first($var->image) )}}" alt="">
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

