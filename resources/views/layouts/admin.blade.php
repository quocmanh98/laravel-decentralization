<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <title>ADMIN</title>
</head>

<body>
    @php
        $module_active = session('module_active');
    @endphp
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="{{ route('admin.dashboard') }}">ADMIN</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.post.add') }}">Thêm bài viết</a>
                        <a class="dropdown-item" href="{{ route('admin.product.add') }}">Thêm sản phẩm</a>
                        <a class="dropdown-item" href="{{ route('admin.order.list') }}">Danh sách đơn hàng</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Tài khoản</a>
                        <a class="dropdown-item" href="{{ route('demo.logout') }}">Thoát</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    <li class="nav-link {{ $module_active == 'dashboard' ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Dashboard
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('admin.page.list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-file"></i>
                            </div>
                            Trang
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('admin.page.add') }}">Thêm mới</a></li>
                            <li><a href="{{ route('admin.page.list') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('admin.post.list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-newspaper"></i>
                            </div>
                            Bài viết
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ route('admin.post.add') }}">Thêm mới</a></li>
                            <li><a href="{{ route('admin.post.list') }}">Danh sách</a></li>
                            <li><a href="{{ route('admin.category.post') }}">Danh mục</a></li>
                        </ul>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('admin.product.list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            Sản phẩm
                        </a>
                        <i class="arrow fas fa-angle-down"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ route('admin.product.add') }}">Thêm mới</a></li>
                            <li><a href="{{ route('admin.product.list') }}">Danh sách</a></li>
                            <li><a href="{{ route('admin.category.product') }}">Danh mục</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'order' ? 'active' : '' }}">
                        <a href="{{ route('admin.order.list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            Bán hàng
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ route('admin.order.list') }}">Đơn hàng</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'user' ? 'active' : '' }}">
                        <a href="{{ route('admin.user.list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-user"></i>
                            </div>
                            Thành viên
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('admin.user.add') }}">Thêm mới</a></li>
                            <li><a href="{{ route('admin.user.list') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'permission' ? 'active' : '' }}">
                        <a href="{{ route('permission.list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fab fa-slideshare"></i>
                            </div>
                            Quyền
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('permission.list') }}">Danh sách</a></li>
                            <li><a href="{{ route('groupPermission.list') }}">Nhóm quyền</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'role' ? 'active' : '' }}">
                        <a href="{{ route('role.list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            Vai trò
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('role.add') }}">Thêm mới</a></li>
                            <li><a href="{{ route('role.list') }}">Nhóm quyền</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ url('/') }}/public/admin/js/app.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
        @endif
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $(".check_parent_group").click(function() {
                //Gán checked của .check_child dựa vào checked của cha là .check_parent dựa vào phương thức prop()
                //Nếu .check_parent checked --> true prop('checked', true) ngước lại là false
                var v = $(this).val();
                $(this)
                    .parents(".card")
                    .find("input.check_child_" + v + "")
                    .prop("checked", $(this).prop("checked"));
            });
        });

        $(".checkall").click(function() {
            $(this)
                .parents()
                .find("input[type=checkbox]")
                .prop("checked", $(this).prop("checked"));
        });
    </script>
</body>

</html>
