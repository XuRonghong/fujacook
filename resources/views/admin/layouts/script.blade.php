
<script>
    // none, bounce, rotateplane, stretch, orbit,
    // roundBounce, win8, win8_linear or ios
    function run_waitMe(selector='body', effect='roundBounce'){
        $(selector).waitMe({
            //none, rotateplane, stretch, orbit, roundBounce, win8,
            //win8_linear, ios, facebook, rotation, timer, pulse,
            //progressBar, bouncePulse or img
            effect: effect,
            //place text under the effect (string).
            text: 'Please waiting...',
            //background for container (string).
            bg: 'rgba(255,255,255,0.7)',
            //color for background animation and text (string).
            color: '#000',
            //max size
            maxSize: '',
            //wait time im ms to close
            waitTime: -1,
            //url to image
            source: '',
            //or 'horizontal'
            textPos: 'vertical',
            //font size
            fontSize: '',
            // callback
            onClose: function() {}
        })
    }


    function ajax(url='', data={}, method='POST')
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: url,
            method: method,
            // type: "POST",
            dataType:"json",
            contentType: false,
            processData: false,
            cache: false,
            data: data,
            resetForm: true,
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message, "{{trans('_web_alert.notice')}}")
                    setTimeout(function () {
                        location.href = data.redirectUrl
                    }, 500)
                } else {
                    toastr.error(data.message, "{{trans('_web_alert.notice')}}")
                }
            }
        })
    }


    function doDelete(url, data, table) {
        Swal.fire({
            title: "{{trans('_web_alert.del.title')}}",
            text: "{{trans('_web_alert.del.note')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{trans('_web_alert.ok')}}",
            cancelButtonText: "{{trans('_web_alert.cancel')}}",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            Swal.fire(
                                "{{trans('_web_alert.notice')}}",
                                rtndata.message,
                                'success'
                            )
                            setTimeout(function () {
                                table.api().ajax.reload(null, false)
                            }, 100)
                        } else {
                            Swal.fire(
                                "{{trans('_web_alert.notice')}}",
                                rtndata.message,
                                'error'
                            )
                        }
                    },
                    error: function (err) {
                        console.log(err.responseJSON)
                        toastr.error(JSON.stringify(err.responseJSON), "{{trans('_web_alert.notice')}}")
                    }
                })
            }
        })
    }

    function doDelete_2016(id, data)
    {
        swal({
            title: "{{trans('_web_alert.del.title')}}",
            text: "{{trans('_web_alert.del.note')}}",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "{{trans('_web_alert.ok')}}",
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "{{trans('_web_alert.cancel')}}",
            closeOnConfirm: true,
        }, function () {
            $.ajax({
                url: '{{data_get($data,'route_url.destroy')}}'+'/'+id,
                data: data,
                type: "POST",
                //async: false,
                success: function (rtndata) {
                    if (rtndata.status) {
                        toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                        setTimeout(function () {
                            table.api().ajax.reload(null, false)
                        }, 100)
                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error")
                    }
                },
                error: function (err) {
                    console.log(err.responseJSON)
                    toastr.error(JSON.stringify(err.responseJSON), "{{trans('_web_alert.notice')}}")
                }
            })
        })
    }
</script>
