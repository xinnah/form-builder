@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ $pageTitle ?? '' }}

                        <a href="{{ route('customer-info.index') }}" class="btn btn-sm btn-primary float-md-right">
                            <i class="fa fa-arrow-left"></i> Back To Customer Info
                        </a>
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach(json_decode($customerInfo->value) as $key => $info)
                        <div class="col-md-4">
                            <div class="card rounded-0">
                                <ul class="list-group list-group-flush">
                                    
                                    <li class="list-group-item">
                                        <strong>{{ $info->label }}: </strong> <span class="float-right">{{ $info->value }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


