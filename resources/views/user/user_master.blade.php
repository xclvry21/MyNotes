<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>{{ $title }} | Upcube - user & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose user & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('dashboard_body') }}/assets/images/favicon.ico">
        
        <!-- jquery.vectormap css -->
        <link href="{{ asset('dashboard_body') }}/assets/libs/user-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{ asset('dashboard_body') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('dashboard_body') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  

        <!-- Bootstrap Css -->
        <link href="{{ asset('dashboard_body') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('dashboard_body') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('dashboard_body') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{ asset('dashboard_body') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_body') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_body') }}/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" >

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

        {{-- Select2 (multi select dropdown) --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        {{-- summernote --}}
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        
    </head>

    <body data-topbar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <!-- ========== Header Start ========== -->
                @include('user.body.header')
            <!-- ========== Header End ========== -->

            <!-- ========== Left Sidebar Start ========== -->
                @include('user.body.sidebar')
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                @yield('user')
                <!-- End Page-content -->
               
                <!-- ========== Footer Start ========== -->
                @include('user.body.footer')
                <!-- ========== Footer End ========== -->
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('dashboard_body') }}/assets/libs/jquery/jquery.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/node-waves/waves.min.js"></script>

        <!-- Chart JS -->
        <script src="{{ asset('dashboard_body') }}/assets/libs/chart.js/Chart.bundle.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/js/pages/chartjs.init.js"></script> 
        
        <!-- jquery.vectormap map -->
        <script src="{{ asset('dashboard_body') }}/assets/libs/user-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/user-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <script src="{{ asset('dashboard_body') }}/assets/js/pages/dashboard.init.js"></script>

    
        {{-- Toastr --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
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

        {{-- summernote --}}
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    placeholder: 'Hello, welcome to MyNotes',
                    tabsize: 2,
                    height: 300,
                    toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'fontname', 'fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['hr']],
                    ['table', ['table']],
                    ],
                });
            });
        </script>

        <!-- init js -->
        <script src="{{ asset('dashboard_body') }}/assets/js/pages/form-editor.init.js"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/jszip/jszip.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

        <!-- Responsive examples -->
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('dashboard_body') }}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('dashboard_body') }}/assets/js/pages/datatables.init.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="{{ asset('dashboard_body') }}/assets/js/code.js"></script>

        <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>

        <!-- materialdesign icon js-->
        <script src="{{ asset('dashboard_body') }}/assets/js/pages/materialdesign.init.js"></script>
        
        {{-- select2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });
            $(document).ready(function () {
                $('#select2-modal').select2({
                    dropdownParent: $('#my-modal'),
                });
            });
        </script>

        {{-- edit-tag modal --}}
        <script type='text/javascript'>
            $(document).ready(function () {
                $('body').on('click', '#tag-edit', function () {
                   var userURL = $(this).data('url');
                   var base_url = window.location.origin;
                   $('#modal-edit-tag').modal('show');
                   $.get(userURL, function (data) {
                       $('#modal-edit-tag').modal('show');   
                       $('#tag_id').val(data.id);                    
                       $('#tag_title').val(data.title);   
                   })
                });                  
             });
        </script>

        <script>
            $(document).ready(function() {
                $('#datatable-notes').DataTable();
                $('#datatable-archives').DataTable();
                $('#datatable-trash').DataTable();
            });
        </script>

    
         <!-- App js -->
         <script src="{{ asset('dashboard_body') }}/assets/js/app.js"></script>

    </body>

</html>