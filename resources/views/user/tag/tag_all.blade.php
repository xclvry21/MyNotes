@extends('user.user_master')
@section('user')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{$title}}</h4>
                        
                        <table id="datatable" class="table dt-responsive nowrap w-100">
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
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$tag->title}}</td>
                                        <td>          
                                            <a href="javascript:void(0)" id="tag-edit" data-url="{{ route('tag.edit', $tag->id) }}" class="btn btn-primary sm waves-effect waves-light"><i class="far fa-edit" ></i></a>

                                            <a href="{{ route('tag.destroy', $tag->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <i class="fas fa-trash" ></i></a>
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

        {{-- DATA MODAL (TAG) --}}
        <div class="col-sm-6 col-md-4 col-xl-3">
            <form action="{{ route('tag.update') }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal fade bs-example-modal-center" tabindex="-1" id="tagShowModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tag Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="tag_id" name="tag_id">
                                <input class="form-control" type="text" id="tag_title" value="" name="tag_title">
                                <span class="text-danger"></span>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary waves-effect waves-light" value="Save Changes" id="tag-update">
                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </form>
        </div>

    </div>
    
</div>

@endsection
