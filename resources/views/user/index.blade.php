@extends('user.user_master')
@section('user')
   
<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{-- cards --}}
        <div class="row">
            
            <div class="col-xl-3 col-md-6">
                <div class="card card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Total Notes</p>
                            <h4 class="mb-2">{{ $note_count }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-primary rounded-3">
                                <i class="ri-sticky-note-line font-size-24"></i>  
                            </span>
                        </div>
                    </div>
                    <a href=" {{route('note.index') }}" class="btn btn-primary btn-sm waves-effect waves-light">More info<i class="ri-arrow-right-line align-middle ms-2"></i></a>                                           
                </div><!-- end cardbody -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Total Tags</p>
                            <h4 class="mb-2">{{ $tag_count }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-success rounded-3">
                                <i class="ri-price-tag-3-line font-size-24"></i>  
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('tag.index') }}" class="btn btn-success btn-sm waves-effect waves-light">More info<i class="ri-arrow-right-line align-middle ms-2"></i></a>                                           
                </div><!-- end cardbody -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Total Archives</p>
                            <h4 class="mb-2">{{ $archive_count }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-info rounded-3">
                                <i class="ri-sticky-note-line font-size-24"></i>  
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('note.archives') }}" class="btn btn-info btn-sm waves-effect waves-light">More info<i class="ri-arrow-right-line align-middle ms-2"></i></a>                                           
                </div><!-- end cardbody -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Total Trash</p>
                            <h4 class="mb-2">{{ $trash_count }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-danger rounded-3">
                                <i class="ri-delete-bin-line font-size-24"></i>  
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('note.trash') }}" class="btn btn-danger btn-sm waves-effect waves-light">More info<i class="ri-arrow-right-line align-middle ms-2"></i></a>                                           
                </div><!-- end cardbody -->
            </div><!-- end col -->

        </div><!-- end row -->



        
    </div>
    
</div>

@endsection
