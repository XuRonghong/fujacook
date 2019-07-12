$(function () {
    //nav開閉
    $('.g-nav-btn').on('click', function () {
        $("body").toggleClass("js__open-nav");
        $(this).removeClass("on");
    });
    $('.g-nav-bg').on('click', function () {
        $("body").toggleClass("js__open-nav");
    });


    //scrollmagic addclass
    var nsmc = "";
    var mql = window.matchMedia('screen and (max-width: 768px)');

    function checkBreakPoint(mql) {
        //sp
        if (mql.matches) {
            if (nsmc) {
                nsmc = nsmc.destroy();
            }
            nsmc = new ScrollMagic.Controller();

            new ScrollMagic.Scene({
                    triggerElement: "#l-contents",
                    triggerHook: "onLeave",
                    offset: -40
                })
                .setClassToggle(".g-nav-btn-wrap", "js__nav-btn")
                .addTo(nsmc);

            //pc
        } else {
            if (nsmc) {
                nsmc = smc.destroy();
            }
            nsmc = new ScrollMagic.Controller();

            new ScrollMagic.Scene({
                    triggerElement: "#l-contents",
                    triggerHook: "onCenter"
                })
                .setClassToggle(".g-nav-btn-wrap", "js__nav-btn")
                .addTo(nsmc);

        }
    }
    mql.addListener(checkBreakPoint);
    checkBreakPoint(mql);



    //nav mouse on addclass
    $(".g-nav-btn").on("mouseenter", function () {
        $this = $(this);
        if ($this.hasClass("on") || $("body").hasClass("js__open-nav")) {
            return;
        }
        $this.addClass("on");
        setTimeout(function () {
            $this.removeClass("on");
        }, 1000);
    });

    //scroll magic trigger
    var smc = new ScrollMagic.Controller();

    $("[data-anime='on']").each(function (n, e) {
        //htmlのデータ属性で設定します。
        var trigger_hook = $(e).data('animeTrigger') ? $(e).data('animeTrigger') : 'onEnter';
        var offset = $(e).data('animeTriggerOffset') ? $(e).data('animeTriggerOffset') : 200;

        new ScrollMagic.Scene({
                triggerElement: e,
                //      reverse: false,
                triggerHook: trigger_hook,
                offset: offset
            })
            .setClassToggle(e, "anime-start")
            .addTo(smc);

    });

    //scroll magic parallax
    $(".parallax-anime").each(function (n, e) {
        var _this = this;

        new ScrollMagic.Scene({
                triggerElement: this,
                duration: "200%",
                triggerHook: 'onEnter'
            })
            .on("progress", function (event) {

                var pos = Math.round(event.progress * 100) / 100;

                setTimeout(function () {
                    TweenMax.to(_this, 1, {
                        ease: Power3.easeOut,
                        "transform": "translate3d(0, " + -90 * pos + "px, 0)"
                    });
                    TweenMax.to($(_this).children("img"), 1, {
                        ease: Power3.easeOut,
                        "transform": "translate3d(0, " + 60 * pos + "px, 100px)"
                    });
                }, 100);
            })
            .addTo(smc);
    });
});
