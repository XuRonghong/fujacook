
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <br>
            @foreach ($data['menu'] as $key => $var)
                <li class="sidebar-item">
                    <a href="@if($var->link!='') {{ url($var->link) }} @else javascript:void(0) @endif"
                       class="sidebar-link has-arrow waves-effect waves-dark"
                       aria-expanded="false">
                        <i class="mdi mdi-view-module"></i>
                        <span class="hide-menu">{{trans('menu.'. $var->name. '.title')}}</span>
                    </a>
                    @if($var->sub_menu)
                        <ul id="sidebarnav2" class="collapse  second-level">
                            @foreach ($var->second as $key2 => $var2)
                                <li class="sidebar-item">
                                    <a href="@if($var2->link!='') {{ url($var2->link, '') }} @else javascript:void(0) @endif"
                                       class="@if($var2->link!='') sidebar-link @else sidebar-link has-arrow waves-effect waves-dark @endif"
                                       aria-expanded="false">
                                        <i class="mdi"></i>
                                        <span class="hide-menu">{{ trans('menu.'. $var2->name. '.title' )}}</span>
                                    </a>
                                    @if($var2->sub_menu)
                                        <ul aria-expanded="false" class="collapse  second-level">
                                            @foreach ($var2->third as $key3 => $var3)
                                                <li class="sidebar-item" style="margin-left: 20px">
                                                    <a href="@if($var3->link!='') {{ url($var3->link) }} @else javascript:void(0) @endif"
                                                       class="sidebar-link">
                                                        <i class="mdi"></i>
                                                        <span class="hide-menu">{{trans('menu.'. $var3->name. '.title')}}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            </ul>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
{{--                All Rights Reserved by Xtreme admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.--}}
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
