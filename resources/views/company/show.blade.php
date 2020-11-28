@extends('layouts.app')
@section('title') {{$company->name}} @endsection
@section('page_title') Specific Company @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$company->name}}</div>
                    <div class="card-body row">
                        <div class="col-6">

                            <img src="{{$company->getMedia('images')->first()->getUrl('thumb')}}">
                        </div>
                        <div class="col-6">
                            <ul class="list-group">
                                <li class="list-item">Company Name: {{$company->name}}</li>
                                <li class="list-item">Email: {{$company->email}}</li>
                                <li class="list-item">Website: <a href="{{$company->website}}"
                                                                  target="_blank">{{$company->website}}</a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="m-3 text-center w-100">Employees</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($company->employees as $employ)
                                <tr>
                                    <td>{{$employ->full_name}}</td>
                                    <td>
                                        <img src="{{$employ->getMedia('images')->first()->getUrl('thumb')}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
