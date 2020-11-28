@extends('layouts.app')
@section('title') Employ List @endsection
@section('page_title') Employ List  @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <a href="{{route('create_employ')}}" class="btn btn-success mb-3">Add new employ</a>
                @if(count($employees))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employ)
                            <tr>
                                <td>
                                    <a href="{{route('show_employ',['employ' => $employ->slug])
                                    }}">{{$employ->first_name}} {{$employ->last_name}}</a>
                                </td>
                                <td>{{$employ->email}}</td>
                                <td>{{$employ->phone}}</td>
                                <td>
                                    <a class="btn btn-info mr-1"
                                       href="{{route('edit_employ',['employ' => $employ->slug])}}">Edit</a>
                                    <button class="btn btn-warning delete-btn"
                                            data-toggle="modal" data-target="#confirm-delete"
                                            data-title="{{$employ->full_name}}"
                                            onclick="deleteModal(this)"
                                            data-href="{{route('destroy_employ',['employ' =>$employ->slug])}}">Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                @endif

            </div>
        </div>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Delete Employ
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <span class="employ-name"></span>?
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post">
                            @method('delete')
                            @csrf
                            <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-ok">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function deleteModal (el) {
            document.querySelector('#confirm-delete form').setAttribute('action',el.getAttribute('data-href'));
            document.querySelector('#confirm-delete .employ-name').innerHTML = el.getAttribute('data-title');
        }
    </script>
@endpush
