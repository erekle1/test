@extends('layouts.app')
@section('title') Company List @endsection
@section('page_title') Company List  @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <a href="{{route('create_company')}}" class="btn btn-success mb-3">Add new company</a>
                @if(count($companies))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Number of employees</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>
                                    <a href="{{route('show_company',['company' => $company->slug])
                                    }}">{{$company->name}}</a>
                                </td>
                                <td>{{$company->number_of_employees}}</td>
                                <td>
                                    <a class="btn btn-info mr-1"
                                       href="{{route('edit_company',['company' => $company->slug])}}">Edit</a>
                                    <button class="btn btn-warning delete-btn"
                                            data-toggle="modal" data-target="#confirm-delete"
                                            data-title="{{$company->name}}"
                                            onclick="deleteModal(this)"
                                            data-href="{{route('destroy_company',['company' =>$company->slug])}}">Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $companies->links() }}
                @endif

            </div>
        </div>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Delete Company
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <span class="company-name"></span>?
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
            document.querySelector('#confirm-delete .company-name').innerHTML = el.getAttribute('data-title');
        }
    </script>
@endpush
