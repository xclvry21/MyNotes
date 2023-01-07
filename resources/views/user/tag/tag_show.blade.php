@extends('user.user_master')
@section('user')

<div class="page-content">
    <div class="container-fluid">

         <!-- start page title -->
         <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{$title}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-3">
            <div class="col-12">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl">
                    Create New Note <i class="ri-file-add-line align-middle ms-2"></i> 
                </button>
            </div>           
        </div>
        

        {{-- NOTES --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Notes</h4>
                        
                        <table id="datatable-notes" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($note_tag as $note)
                                    <tr>
                                        @if ($note)
                                            <td>{{$i++}}</td>
                                            <td>{{$note->title}}</td>
                                            <td>          
                                                <a href="{{ route('note.edit', $note->id) }}" id="show" class="btn btn-primary sm waves-effect waves-light"><i class="far fa-edit" ></i></a>

                                                <a href="{{ route('note.archive', $note->id) }}" class="btn btn-secondary sm" title="Archive" id="archive"> <i class="mdi mdi-archive-arrow-down-outline"></i></a>

                                                <a href="{{ route('note.delete', $note->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <i class="fas fa-trash" ></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

        {{-- ARCHIVES --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Archives</h4>
                        
                        <table id="datatable-archives" class="table dt-responsive nowrap w-100">
                            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($note_archive as $note)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$note->title}}</td>
                                        <td>          
                                            <a href="{{ route('note.edit', $note->id) }}" title="Edit" id="show" class="btn btn-primary sm waves-effect waves-light"><i class="far fa-edit" ></i></a>

                                            <a href="{{ route('note.unarchive', $note->id) }}" class="btn btn-success sm" title="Unarchive" id="unarchive"> <i class="ri-inbox-unarchive-line"></i></a>

                                            <a href="{{ route('note.delete', $note->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <i class="fas fa-trash" ></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

        {{-- TRASH --}}
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Trash</h4>
                        
                        <table id="datatable-trash" class="table dt-responsive nowrap w-100">
                           
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($note_trash as $note)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$note->title}}</td>
                                        <td>          

                                            <a href="{{ route('note.show', $note->id) }}" class="btn btn-primary sm" title="Show"> <i class="fas fa-eye" ></i></a>
                                            
                                            <a href="{{ route('note.restore', $note->id) }}" class="btn btn-success sm" title="Restore" id="swal-restore"> <i class="fas fa-trash-restore" ></i></a>

                                            <a href="{{ route('note.destroy', $note->id) }}" class="btn btn-danger sm" title="Delete Forever" id="delete"> <i class="mdi mdi-delete-forever "></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

        {{-- CREATE NOTE MODAL --}}
        <div class="col-sm-6 col-md-4 col-xl-3">
            <!--  Modal content for the above example -->
            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="my-modal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">Create new note</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('note.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="example-text-input" value="{{ old('title') }}" name="title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-10">
                                        <select class="form-select js-example-basic-multiple" aria-label="Default select example" name="tag_ids[]" multiple="multiple" id="select-2">
                                            @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ $tag->id == $tag_id ? 'selected' : '' }}>{{ $tag->title }}</option>
                                        @endforeach
                                        </select>   
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <textarea id="elm1" name="body">{{ old('body') }}</textarea>
                                </div>
                                <!-- end row -->
                            </div>
                        
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary waves-effect waves-light" value="Save" id="#">
                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>


    </div>
</div>



@endsection
