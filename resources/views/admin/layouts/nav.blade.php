
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
{{--                <li class="nav-small-cap">--}}
{{--                    <i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu"></span>--}}
{{--                </li>--}}
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">帳號管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{data_get($data, 'nav.news')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 會員管理 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{data_get($data, 'nav.store')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 後台帳號管理 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="index10.html" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 個人資料 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-tune-vertical"></i><span class="hide-menu">全站管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="sidebar-type-minisidebar.html" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i><span class="hide-menu"> 全站通知管理 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="sidebar-type-horizontalsidebar.html" class="sidebar-link">
                                <i class="mdi mdi-view-module"></i><span class="hide-menu"> 全站標籤管理 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{data_get($data, 'nav.news')}}" aria-expanded="false">
                        <i class="mdi mdi-content-paste"></i><span class="hide-menu">最新消息</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">供應商管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{data_get($data, 'nav.store')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 供應商 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-content-copy"></i><span class="hide-menu">訂單管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="page-layout-boxed-layout.html" class="sidebar-link">
                                <i class="mdi mdi-view-carousel"></i><span class="hide-menu"> 總覽 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">評價管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="inbox-email.html" class="sidebar-link">
                                <i class="mdi mdi-email"></i><span class="hide-menu"> 總覽 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-tune-vertical"></i><span class="hide-menu">輪播管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="sidebar-type-minisidebar.html" class="sidebar-link">
                                <i class="mdi mdi-view-quilt"></i><span class="hide-menu"> 首頁輪播 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="sidebar-type-horizontalsidebar.html" class="sidebar-link">
                                <i class="mdi mdi-view-module"></i><span class="hide-menu"> 廣告輪播 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">商品管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{data_get($data, 'nav.news')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 品項管理 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{data_get($data, 'nav.store')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 商品分類 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="index10.html" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 商品上架管理 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="index10.html" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 規格列表 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">文章管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="inbox-email.html" class="sidebar-link">
                                <i class="mdi mdi-email"></i><span class="hide-menu"> 文章管理 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="inbox-email.html" class="sidebar-link">
                                <i class="mdi mdi-email"></i><span class="hide-menu"> 文章分類 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">COUPONS管理 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="inbox-email.html" class="sidebar-link">
                                <i class="mdi mdi-email"></i><span class="hide-menu"> 總覽 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-content-copy"></i><span class="hide-menu">前台網站設定 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="page-layout-boxed-layout.html" class="sidebar-link">
                                <i class="mdi mdi-view-carousel"></i><span class="hide-menu"> 搜尋關鍵字 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">系統參數設定 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{data_get($data, 'nav.news')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> 權限設定 </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{data_get($data, 'nav.store')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i><span class="hide-menu"> meta參數設定 </span>
                            </a>
                        </li>
                    </ul>
                </li>
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">--}}
{{--                        <i class="mdi mdi-content-paste"></i><span class="hide-menu">Documentation</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Xtreme admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
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
