<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cofigruha</title>
    <!-- Favicons -->
    <link href="{{ asset('admin/img/anapat.png')}}" rel="icon">
    <link href="{{ asset('admin/img/anapat.png')}}" rel="apple-touch-icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,400&display=swap"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
    <link id="pagestyle" href="{{ asset('admin/css/material-dashboard.css?v=3.0.0')}}" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/css/nucleo-icons.css')}}" rel="stylesheet"/>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    {{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
    {{-- Summernote CDN --}}

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" integrity ="anonymous"  referrerpolicy="no-referrer">

    {{-- Select2 Style CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>

    @yield('styles')

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar  bg-gradient-info sidebar-dark  -->
    <ul class="navbar-nav sidebar accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
            <img width="207" height="97" src="{{ asset('admin/img/anapat.png')}}"
                 class="attachment-medium size-medium" alt="" loading="lazy" srcset=""
                 sizes="(max-width: 207px) 100vw, 207px">
        </a>

        <!-- Divider -->
        @can('isAdmin')
            <nav class="navbar navbar-expand navbar-light bg-white topbar  static-top ">

                <!-- Sidebar Toggle (Topbar) -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center d-md-none"
                   href="{{ route('admin.dashboard') }}">
                    <img width="207" height="97" src="{{ asset('admin/img/anapat.png')}}"
                         class="attachment-medium size-medium" alt="" loading="lazy" srcset=""
                         sizes="(max-width: 207px) 100vw, 207px">
                </a>
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="d-flex nav-setting">

                {{--@can('isAdmin')--}}
                    {{--<!-- Nav Item - Pages Collapse Menu -->--}}
                        {{--<li class="nav-item d-md-block d-none {{ in_array(Route::currentRouteName(),[--}}
            {{--'admin.post',--}}
            {{--'admin.category',--}}
            {{--'admin.tag',--}}
            {{--'admin.post.trash',--}}
        {{--])? 'active' : ''}}">--}}
                            {{--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"--}}
                               {{--aria-expanded="true" aria-controls="collapseTwo">--}}
                                {{--<i class="fas fa-fw fa-table"></i>--}}
                                {{--<span>{{__('message.Blog')}}</span>--}}
                            {{--</a>--}}
                            {{--<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"--}}
                                 {{--data-parent="#accordionSidebar">--}}
                                {{--<div class=" py-2 collapse-inner rounded">--}}
                                    {{--<a class="collapse-item" href="{{ route('admin.post') }}">{{__('message.Blog')}}</a>--}}
                                    {{--<a class="collapse-item"--}}
                                       {{--href="{{ route('admin.category') }}">{{__('message.Categories')}}</a>--}}
                                    {{--<a class="collapse-item" href="{{ route('admin.tag') }}">{{__('message.Tags')}}</a>--}}
                                    {{--<a class="collapse-item"--}}
                                       {{--href="{{ route('admin.post.trash') }}">{{__('message.Trash')}}</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                {{--@endcan--}}
                @can('isAdmin')
                    <!-- Nav Item - Utilities Collapse Menu -->
                        <li class="nav-item d-md-block d-none {{ in_array(Route::currentRouteName(),[
            'admin.about',
            'admin.banner',
            'admin.general',
        ])? 'active' : ''}}">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse"
                               data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                                <i class="fas fa-fw fa-wrench"></i>
                                <span>{{__('message.Settings')}}</span>
                            </a>
                            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                                 data-parent="#accordionSidebar">
                                <div class=" py-2 collapse-inner rounded">
                                <!--<a class="collapse-item" href="{{ route('admin.about') }}">{{__('message.About')}}</a>-->
                                    <a class="collapse-item"
                                       href="{{ route('admin.partner') }}">{{__('message.partner')}}</a>
                                    <a class="collapse-item"
                                       href="{{ route('admin.banner') }}">{{__('message.banners')}}</a>
                                    <a class="collapse-item"
                                       href="{{ route('admin.faq') }}">{{__('message.TIPOS DE PEMPAs')}}</a>
                                    <a class="collapse-item"
                                       href="{{ route('admin.link') }}">{{__('message.about home')}}</a>
                                    <a class="collapse-item"
                                       href="{{ route('admin.general') }}">{{__('message.General Settings')}}</a>
                                </div>
                            </div>
                        </li>
                    @endcan
                    <li class="nav-item nav-logout dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <span class="mr-2 d-none d-lg-inline text-gray-800 small">{{ auth::user()->name }}</span>

                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown" style="margin-left: -70px" ;>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{__('message.Logout')}}
                            </a>
                        </div>
                    </li>
                </div>
                <!-- Topbar Navbar -->

            </nav>
    @endcan
    <!-- Nav Item - Dashboard -->
        <div class="d-flex item-side" id="show-list">
            <li class="nav-item {{ in_array(Route::currentRouteName(),[
            'admin.dashboard',
        ])? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i> <span> {{__('message.Dashboard')}}</span></a>
            </li>
            @can('isAdminOrResponsable')
                <li class="nav-item {{ in_array(Route::currentRouteName(),[
            'admin.users.index',
        ])? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{__('message.users')}}</span></a>
                </li>

                <li class="nav-item {{ in_array(Route::currentRouteName(),[
            'admin.entidades_formadoreas',
        ])? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('admin.entidades_formadoreas') }}">
                        <i class="fas fa-fw fa-building"></i>
                        <span>{{__('message.Entidades Formadoras')}}</span></a>
                </li>
            @endcan
            <li class="nav-item {{ in_array(Route::currentRouteName(),[
            'admin.formadores',
        ])? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.formadores') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>{{__('message.Formadores')}}</span></a>
            </li>

            @can('isAdmin')
            <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ in_array(Route::currentRouteName(),[
            'admin.cursos',
            'admin.pcategory',
        ])? 'active' : ''}}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                       aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-book-open"></i>
                        <span>{{__('message.Cursos')}}</span>
                    </a>

                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                         data-parent="#accordionSidebar">
                        <div class=" py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.cursos') }}">{{__('message.Cursos')}}</a>
                            <a class="collapse-item"
                               href="{{ route('admin.inactiveCursos') }}">{{__('message.Inactivo Cursos')}}</a>
                        </div>
                    </div>
                </li>
            @endcan
            @can('isResponsableOrFormador')
            <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ in_array(Route::currentRouteName(),[
            'admin.cursos',
            'admin.pcategory',
        ])? 'active' : ''}}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                       aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-book-open"></i>
                        <span>{{__('message.Cursos')}}</span>
                    </a>

                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                         data-parent="#accordionSidebar">
                        <div class=" py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.cursos') }}">{{__('message.Cursos')}}</a>
                            <a class="collapse-item"
                               href="{{ route('admin.inactiveCursos') }}">{{__('message.Inactivo Cursos')}}</a>
                        </div>
                    </div>
                </li>
            @endcan
        <!-- Nav Item - Pages Collapse Menu -->


            <li class="nav-item {{ in_array(Route::currentRouteName(),[
            'admin.operadores',
        ])? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.operadores') }}">
                    <i class="fa-solid fa-helmet-safety"></i>
                    <span>{{__('message.Operadores')}}</span></a>
            </li>
            @can('isAdminOrResponsable')
                <li class="nav-item {{ in_array(Route::currentRouteName(),[
            'admin.examen',
        ])? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('admin.examen') }}">
                        <i class="fas fa-fw fa-book-reader"></i>
                        <span>{{__('message.Examen')}}</span></a>
                </li>

            @endcan
            @can('isAdmin')
                <li class="nav-item {{ in_array(Route::currentRouteName(),[
      'admin.carnet',
  ])? 'active' : ''}}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                       aria-expanded="true" aria-controls="collapsePages1">
                        <i class="fas fa-fw fa-id-card"></i>
                        <span>{{__('message.carnet')}}</span>
                    </a>

                    <div id="collapsePages1" class="collapse" aria-labelledby="headingPages"
                         data-parent="#accordionSidebar">
                        <div class=" py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.carnet') }}">
                                <span>{{__('message.carnet')}}</span></a>

                            <a class="collapse-item"
                               href="{{ route('admin.inactiveCarnet') }}">{{__('message.Inactivo Carnet')}}</a>
                        </div>
                    </div>
                </li>
            @endcan

            @can('isAdmin')
                <li class="nav-item {{ in_array(Route::currentRouteName(),[
      'admin.certificado',
  ])? 'active' : ''}}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                       aria-expanded="true" aria-controls="collapsePages2">
                        <i class="fas fa-fw fa-graduation-cap"></i>
                        <span>{{__('message.certificado')}}</span>
                    </a>

                    <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                         data-parent="#accordionSidebar">
                        <div class=" py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.certificado') }}">
                                <span>{{__('message.Certificados')}}</span></a>

                            <a class="collapse-item"
                               href="{{ route('admin.inactiveCertificado') }}">{{__('message.Certificados Inactivos')}}</a>
                        </div>
                    </div>
                </li>
            @endcan
            <li class="nav-item ">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>{{__('message.Salir')}}</span></a>
            </li>


            {{--    <li class="nav-item {{ in_array(Route::currentRouteName(),[--}}
            {{--            'admin.horario',--}}
            {{--        ])? 'active' : ''}}">--}}
            {{--      <a class="nav-link" href="{{ route('admin.horario') }}">--}}
            {{--        <i class="fas fa-fw fa-table"></i>--}}
            {{--        <span>Horario</span></a>--}}
            {{--    </li>--}}



            {{--    <li class="nav-item {{ in_array(Route::currentRouteName(),[--}}
            {{--            'admin.asistent',--}}
            {{--        ])? 'active' : ''}}">--}}
            {{--      <a class="nav-link" href="{{ route('admin.asistent') }}">--}}
            {{--        <i class="fas fa-fw fa-table"></i>--}}
            {{--        <span>Asistent</span></a>--}}
            {{--    </li>--}}


            {{--<li class="nav-item {{ in_array(Route::currentRouteName(),[--}}
            {{--'admin.page',--}}
            {{--])? 'active' : ''}}">--}}
            {{--<a class="nav-link" href="{{ route('admin.page') }}">--}}
            {{--<i class="fas fa-fw fa-table"></i>--}}
            {{--<span>Pages</span></a>--}}
            {{--</li>--}}

            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="{{ route('admin.partner') }}">--}}
            {{--<i class="fas fa-fw fa-table"></i>--}}
            {{--<span>Partners</span></a>--}}
            {{--</li>--}}

            {{--<li class="nav-item {{ in_array(Route::currentRouteName(),[--}}
            {{--'admin.service',--}}
            {{--])? 'active' : ''}}">--}}
            {{--<a class="nav-link" href="{{ route('admin.service') }}">--}}
            {{--<i class="fas fa-fw fa-table"></i>--}}
            {{--<span>Services</span></a>--}}
            {{--</li>--}}

            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="{{ route('admin.team') }}">--}}
            {{--<i class="fas fa-fw fa-table"></i>--}}
            {{--<span>Team</span></a>--}}
            {{--</li>--}}

            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="{{ route('admin.testi') }}">--}}
            {{--<i class="fas fa-fw fa-table"></i>--}}
            {{--<span>Testimonials</span></a>--}}
            {{--</li>--}}

        </div>

        <!-- Divider -->

    </ul>
    <div class="showw" id="showw"><i class="fas fa-fw fa-arrow-right"></i></div>

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->

            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Cofigruha </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('message.Ready to Leave?')}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div
                class="modal-body">{{__('message.Select "Logout" below if you are ready to end your current session.')}}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('message.Cancel')}}</button>

                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                    {{ __('message.Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>

{{-- Select2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Elija algunas etiquetas"
        });
    });

    $("#showw").click(function () {
        $("#showw").toggleClass("show-button");
        $("#show-list").toggleClass("show-list");
    });


</script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('admin/js/summernote-image-title.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Poppins'],
            fontNamesIgnoreCheck: ['Poppins'],
            imageTitle: {
                specificAltField: true,
            },
            lang: 'en-US',
            popover: {
                image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']],
                    ['custom', ['imageTitle']],
                ],
            },
        });
    });
</script>

@stack('scripts')

</body>

</html>
