<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title modalTitle">{{data_get($data,'Title')}}</h4>
            <div class="d-flex align-items-center">
                {!! data_get($data,'breadcrumb') !!}
{{--                <nav aria-label="breadcrumb">--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                        <li class="breadcrumb-item active" aria-current="page">Library</li>--}}
{{--                    </ol>--}}
{{--                </nav>--}}
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="m-r-10 m-t-10">
                    <a id="btn-back" class="btn create-btn text-white no-block d-flex align-items-center btn-back" href="{{data_get($data, 'backUrl', '#')}}">
                        <i class="fa fa-reply"></i>
                        <span class="hide-menu m-l-5" title="返回上一頁">Back</span>
                    </a>
{{--                    <div class="lastmonth"></div>--}}
                </div>
                <div class="p-15 m-t-10">
                    <a id="create_record" class="btn btn-default create-btn text-white no-block d-flex align-items-center" href="{{$data['route_url']['create']}}">
                        <i class="fa fa-plus-square"></i>
                        <span class="hide-menu m-l-5" title="Create New">Create</span>
                    </a>
                </div>
                <div class="">
{{--                    <small>LAST MONTH</small>--}}
{{--                    <h4 class="text-info m-b-0 font-medium">$58,256</h4>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
