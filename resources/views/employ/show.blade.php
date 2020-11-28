@extends('layouts.app')
@section('title') {{$employ->name}} @endsection
@section('page_title') Specific Employ @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$employ->name}}</div>
                    <div class="card-body row">
                        <div class="col-6">

                            <img src="{{$employ->getMedia('images')->first()->getUrl('thumb')}}">
                        </div>
                        <div class="col-6">
                            <ul class="list-group">
                                <li class="list-item">First Name: {{$employ->first_name}}</li>
                                <li class="list-item">Last Name: {{$employ->last_name}}</li>
                                <li class="list-item">Email: {{$employ->email}}</li>
                                <li class="list-item">Phone: {{$employ->phone}}</li>
                                <li class="list-item">Company: {{$employ->company->name}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
