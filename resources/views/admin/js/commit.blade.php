<script>
    @if(Session::has('check_empty.message'))
        swal("{{trans('_web_alert.notice')}}", "{{Session::pull('check_empty.message')}}", "error");
    @if(Session::has('check_empty.url'))
        setTimeout(function () {
        location.href = "{{Session::pull('check_empty.url')}}";
    }, 1000)
    @endif
    @endif
    //
    $(".btn-locale").click(function () {
        var locale = $(this).data('locale');
        $.ajax({
            url: url_doSetLocale + "/" + locale,
            data: {"_token": "{{ csrf_token() }}"},
            type: "POST",
            async: false,
            success: function (rtndata) {
                if (rtndata.status) {
                    location.reload();
                } else {
                    swal("{{trans('_web_alert.logout.success')}}", rtndata.message, "error");
                }
            }
        });

    })
    //
    $(".logout").click(function () {
        swal({
            title: "{{trans('_web_alert.logout.title')}}",
            text: "{{trans('_web_alert.logout.note')}}",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "{{trans('_web_alert.logout.cancel')}}",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{trans('_web_alert.logout.ok')}}",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: url_doLogout,
                data: {"_token": "{{ csrf_token() }}"},
                type: "POST",
                async: false,
                success: function (rtndata) {
                    if (rtndata.status) {
                        swal("{{trans('_web_alert.logout.success')}}", rtndata.message, "success");
                        setTimeout(function () {
                            location.href = "{{ url('web/login')}}";
                        }, 1000);
                    } else {
                        swal("{{trans('_web_alert.logout.success')}}", rtndata.message, "error");
                    }
                }
            });
        });
    })

    $(".btn-modal").click(function () {
        var modal = $(this).data('modal');
        $('#' + modal).modal();
    })

    function copyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            swal("提示", "網址已複製", "success");
        } catch (err) {
            swal("提示", "複製失敗", "error");
        }
        document.body.removeChild(textArea);
    }

    //**************************************
    // 台灣身份證檢查簡短版 for Javascript
    //**************************************
    function checkTwID(id) {
        //建立字母分數陣列(A~Z)
        var city = new Array(
            1, 10, 19, 28, 37, 46, 55, 64, 39, 73, 82, 2, 11,
            20, 48, 29, 38, 47, 56, 65, 74, 83, 21, 3, 12, 30
        )
        id = id.toUpperCase();
        // 使用「正規表達式」檢驗格式
        if (id.search(/^[A-Z](1|2)\d{8}$/i) == -1) {
            //alert('基本格式錯誤');
            return false;
        } else {
            //將字串分割為陣列(IE必需這麼做才不會出錯)
            id = id.split('');
            //計算總分
            var total = city[id[0].charCodeAt(0) - 65];
            for (var i = 1; i <= 8; i++) {
                total += eval(id[i]) * (9 - i);
            }
            //補上檢查碼(最後一碼)
            total += eval(id[9]);
            //檢查比對碼(餘數應為0);
            return ((total % 10 == 0 ));
        }
    }

    //
    function get_category(data) {
        $.ajax({
                url: "{{url('api/category/getlist')}}",
                type: "GET",
                data: data,
                success: function (rtndata) {
                    if (rtndata.status) {
                        switch (data.type) {
                            case 1:
                                $(".category-1").removeAttr('disabled');
                                $(".category-1").html($('<option>', {value: 0, text: "--請選擇--"}));
                                $(".category-2").html($('<option>', {value: 0, text: "--請選擇--"}));
                                for (var key in rtndata.aaData) {
                                    var item = rtndata.aaData[key];
                                    $(".category-1").append($('<option>', {value: item.iId, text: item.vCategoryValue + " / " + item.vCategoryName}))
                                }
                                break;
                            case 2:
                                $(".category-2").removeAttr('disabled');
                                $(".category-2").html($('<option>', {value: 0, text: "--請選擇--"}));
                                for (var key in rtndata.aaData) {
                                    var item = rtndata.aaData[key];
                                    $(".category-2").append($('<option>', {value: item.iId, text: item.vCategoryValue + " / " + item.vCategoryName}))
                                }
                                break;
                        }
                    }
                }
            }
        );
    }


    function get_product_list(data) {
        $.ajax({
                url: "{{url('api/product/getlist')}}",
                type: "GET",
                data: data,
                success: function (rtndata) {
                    if (rtndata.status) {
                        switch (data.type) {
                            case 'product':
                                $(".iProductId").removeAttr('disabled');
                                $(".iProductId").html($('<option>', {value: 0, text: "--請選擇--"}));
                                for (var key in rtndata.aaData) {
                                    var item = rtndata.aaData[key];
                                    $(".iProductId").append($('<option>', {value: item.iId, text: item.vProductNum + " / " + item.vProductName}))
                                }
                                break;
                            case 'spec':
                                $(".iSpecId").removeAttr('disabled');
                                $(".iSpecId").html($('<option>', {value: 0, text: "--請選擇--"}));
                                for (var key in rtndata.aaData) {
                                    var item = rtndata.aaData[key];
                                    $(".iSpecId").append($('<option>', {value: item.iSubId, text: item.vSpecNum + " / " + item.vSpecTitle}))
                                }
                                break;
                        }
                    }
                }
            }
        );
    }

    function get_product_search(data) {
        $.ajax({
                url: "{{url('api/product/dosearch')}}",
                type: "GET",
                data: data,
                success: function (rtndata) {
                    if (rtndata.status) {
//                        $(".iProductId").html($('<option>', {value: 0, text: "--請選擇--"}));
                        for (var key in rtndata.aaData) {
                            var item = rtndata.aaData[key];
                            $(".iProductId").append($('<option>', {value: item.iId, text: item.vProductNum + " / " + item.vProductName + " / NT$ " + item.iProductPromoPrice}))
                        }
                    }else{
                        $(".iProductId").html($('<option>', {value: 0, text: "--無符合條件商品--"}));
                    }
                }
            }
        );
    }
</script>


<script>
    /*
     * Alert Type And Message example
     */
    $('.demo1').click(function () {
        swal("{{trans('_web.notice')}}", rtndata.message);
    });

    $('.demo2').click(function () {
        swal("{{trans('_web.notice')}}", rtndata.message, "success");
        swal("{{trans('_web.notice')}}", rtndata.message, "error");
    });

    $('.demo3').click(function () {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
    });

    $('.demo4').click(function () {
        swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
    });

    /*
     * Smart Notifications
     */
    $('#eg1').click(function (e) {

        $.bigBox({
            title: "Big Information box",
            content: "This message will dissapear in 6 seconds!",
            color: "#C46A69",
            //timeout: 6000,
            icon: "fa fa-warning shake animated",
            number: "1",
            timeout: 6000
        });

        e.preventDefault();

    })

    $('#eg2').click(function (e) {

        $.bigBox({
            title: "Big Information box",
            content: "Lorem ipsum dolor sit amet, test consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam",
            color: "#3276B1",
            //timeout: 8000,
            icon: "fa fa-bell swing animated",
            number: "2"
        });

        e.preventDefault();
    })

    $('#eg3').click(function (e) {

        $.bigBox({
            title: "Shield is up and running!",
            content: "Lorem ipsum dolor sit amet, test consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam",
            color: "#C79121",
            //timeout: 8000,
            icon: "fa fa-shield fadeInLeft animated",
            number: "3"
        });

        e.preventDefault();

    })

    $('#eg4').click(function (e) {

        $.bigBox({
            title: "Success Message Example",
            content: "Lorem ipsum dolor sit amet, test consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam",
            color: "#739E73",
            //timeout: 8000,
            icon: "fa fa-check",
            number: "4"
        }, function () {
            closedthis();
        });

        e.preventDefault();

    })


    $('#eg5').click(function () {

        $.smallBox({
            title: "Ding Dong!",
            content: "Someone's at the door...shall one get it sir? <p class='text-align-right'><a href='javascript:void(0);' class='btn btn-primary btn-sm'>Yes</a> <a href='javascript:void(0);' class='btn btn-danger btn-sm'>No</a></p>",
            color: "#296191",
            //timeout: 8000,
            icon: "fa fa-bell swing animated"
        });

    });


    $('#eg6').click(function () {

        $.smallBox({
            title: "Big Information box",
            content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam",
            color: "#5384AF",
            //timeout: 8000,
            icon: "fa fa-bell"
        });

    })

    $('#eg7').click(function () {

        $.smallBox({
            title: "James Simmons liked your comment",
            content: "<i class='fa fa-clock-o'></i> <i>2 seconds ago...</i>",
            color: "#296191",
            iconSmall: "fa fa-thumbs-up bounce animated",
            timeout: 4000
        });

    })
</script>
