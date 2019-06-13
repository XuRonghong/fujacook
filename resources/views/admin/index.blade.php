
@extends('admin.layouts.master')

@section('style')
    <style>
    </style>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Table -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Projects of the Month</h4>
                                    <h5 class="card-subtitle">Overview of Latest Month</h5>
                                </div>
                                <div class="ml-auto d-flex no-block align-items-center">
                                    <div class="dl">
                                        <select class="custom-select">
                                            <option value="0" selected>Monthly</option>
                                            <option value="1">Daily</option>
                                            <option value="2">Weekly</option>
                                            <option value="3">Yearly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap v-middle">
                                    <thead>
                                    <tr class="border-0">
                                        <th class="border-0">Team Lead</th>
                                        <th class="border-0">Project</th>
                                        <th class="border-0">Team</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0">Weeks</th>
                                        <th class="border-0">Budget</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="m-r-10"><img src="../../assets/images/users/d1.jpg" alt="user" class="rounded-circle" width="45" /></div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Hanna Gover</h5><span>hgover@gmail.com</span></div>
                                            </div>
                                        </td>
                                        <td>Elite Admin</td>
                                        <td>
                                            <div class="popover-icon">
                                                <a class="btn-circle btn btn-info" href="javascript:void(0)">SS</a>
                                                <a class="btn-circle btn btn-cyan text-white popover-item" href="javascript:void(0)">DS</a>
                                                <a class="btn-circle btn p-0 popover-item" href="javascript:void(0)"><img src="../../assets/images/users/1.jpg" class="rounded-circle" width="39" alt="" /></a>
                                                <a class="btn-circle btn btn-outline-secondary" href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
                                        <td>35</td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="m-r-10"><img src="../../assets/images/users/d2.jpg" alt="user" class="rounded-circle" width="45" /></div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Daniel Kristeen</h5><span>Kristeen@gmail.com</span></div>
                                            </div>
                                        </td>
                                        <td>Elite Admin</td>
                                        <td>
                                            <div class="popover-icon">
                                                <a class="btn-circle btn btn-info" href="javascript:void(0)">SS</a>
                                                <a class="btn-circle btn btn-primary text-white popover-item" href="javascript:void(0)">DS</a>
                                                <a class="btn-circle btn btn-outline-secondary" href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top" title="Active"></i></td>
                                        <td>35</td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="m-r-10"><img src="../../assets/images/users/d3.jpg" alt="user" class="rounded-circle" width="45" /></div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Julian Josephs</h5><span>Josephs@gmail.com</span></div>
                                            </div>
                                        </td>
                                        <td>Elite Admin</td>
                                        <td>
                                            <div class="popover-icon">
                                                <a class="btn-circle btn btn-info" href="javascript:void(0)">SS</a>
                                                <a class="btn-circle btn btn-cyan text-white popover-item" href="javascript:void(0)">DS</a>
                                                <a class="btn-circle btn btn-orange text-white popover-item" href="javascript:void(0)">RP</a>
                                                <a class="btn-circle btn btn-outline-secondary" href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top" title="Active"></i></td>
                                        <td>35</td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="m-r-10"><img src="../../assets/images/users/2.jpg" alt="user" class="rounded-circle" width="45" /></div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Jan Petrovic</h5><span>hgover@gmail.com</span></div>
                                            </div>
                                        </td>
                                        <td>Elite Admin</td>
                                        <td>
                                            <div class="popover-icon">
                                                <a class="btn-circle btn btn-orange text-white" href="javascript:void(0)">RP</a>
                                                <a class="btn-circle btn btn-outline-secondary" href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
                                        <td>35</td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Table -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection


@section('inline-js')
    <script>
    </script>
@endsection
<!-- ================== /inline-js ================== -->