var SS = SS || {};

SS.Tab = function (options) {

    if (!(this instanceof SS.Tab)) {
        return new SS.Tab(options);
    }

    /////////////// settings ///////////////
    this._settings = $.extend({
        button: '', //tab button
        content_margin: 40,
        fade_speed: 1000,
        scroll_speed: 500,
        hash: true,
    }, options);
    ////////////////////////////////////////

    var _this = this;
    this._settings.button.on("click", function () {
        if ($(this).hasClass("tab-active")) {
            return;
        }
        _this.open($(this).attr("data-tab-target"), $(this).index());

        return false;
    });

    if (this._settings.hash) {
        var hash = location.hash;
        if (!hash) {
            return;
        }
        var $target = $("#" + hash.substr(1));

        if (!$target.get(0)) {
            return;
        }

        _this.open($target.parent().attr("data-tab-contents-name"), $target.index(), true);
    }
}

SS.Tab.prototype = {
    open: function (target, num, reload_all) {

        var $target_contents = $("[data-tab-contents-name=" + target + "]");
        var $target_parents = $target_contents.parents("[data-tab-contents-name]");
        if ($target_parents.length > 0 && reload_all) {

            var div_num = $target_contents.parent("div").index();
            var _this = this;
            $($target_parents.get().reverse()).each(function (n, e) {
                var target = $(this).attr("data-tab-contents-name");
                _this._open(target, div_num);
                console.log(target);
                console.log(div_num);
                div_num = $(this).parent("div").index();
            });

            this._open(target, num);

        } else {
            this._open(target, num);
        }

    },
    _button_toggleClass: function ($tab_parent, num) {
        $tab_parent.find("li").removeClass("tab-active");
        $tab_parent.find("li:eq(" + num + ")").addClass("tab-active");
    },
    _open: function (target, num) {
        var $tab_parent = $("[data-tab-target=" + target + "]").closest("ul");
        this._button_toggleClass($tab_parent, num);

        var $tab_content = $("[data-tab-contents-name=" + target + "]");
        $tab_content.children().removeClass("tab-content-active");
        $tab_content.children().hide();
        $tab_content.children().eq(num).addClass("tab-content-active");
        $tab_content.children().eq(num).fadeIn(this._settings.fade_speed, function () {});

        var position = $tab_content.offset().top - this._settings.content_margin;
        $("html, body").animate({
            scrollTop: position
        }, this._settings.scroll_speed, "swing");
    }
};
