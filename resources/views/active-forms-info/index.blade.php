@extends('formbuilder::layout')
@push('styles')
    <style>
        .card-columns .card {
            margin: .75rem;
        }
    </style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Active Forms Info
                    </h5>
                </div>

                @include('notify.index')
                @if(count($forms) > 0)
                    <div class="card-columns d-flex justify-content-center card-group">
                    @foreach($forms as $form)
                        <div class="col">
                            <div class="card text-center">
                              <div class="card-body">
                                <h5 class="card-title">{{ $form->name }}</h5>
                                <a href='{{ url("/forms/$form->id/customer-info/")}}' class="btn btn-primary">Customer Info</a>
                              </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @else
                    <div class="card-body">
                        <h4 class="text-danger text-center">
                            No Active Forms Found!
                        </h4>
                    </div>  
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
