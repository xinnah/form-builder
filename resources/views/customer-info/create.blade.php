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
                
                <form action="{{ route('customer-info.store') }}" method="POST" id="createFormForm">
                    @csrf 
                    
                    <div class="card-body">
                        @include('notify.index')
                        <div class="row">
                            @foreach(json_decode($form->form_builder_json) as $key => $info)
                            <div class="col-md-6">
                                <div class="form-group {{ isset($info->required) && ($info->required == true) ? 'required': '' }}">
                                    <label for="{{ $info->name }}" class="col-form-label">{{ $info->label }}</label>
                                    @if($info->type == 'text')
                                    <input id="{{ $info->name }}" type="{{ $info->subtype }}" class="{{ $info->className }}" name="{{ $info->name }}" value='{{ old("$info->name") }}' placeholder="{{ $info->placeholder }}" {{ isset($info->required) && ($info->required == true) ? 'required': '' }}>
                                    @elseif($info->type == 'textarea')
                                    <textarea rows="3" id="{{ $info->name }}" class="{{ $info->className }}" name="{{ $info->name }}" placeholder="{{ $info->placeholder }}" {{ isset($info->required) && ($info->required == true) ? 'required': '' }}>
                                        
                                    </textarea>
                                    @endif
                                    <input type="hidden" name="data[]" value="{{ json_encode($info) }}">

                                </div>
                            </div>
                            @endforeach
                        </div>

                        
                    </div>
                    <div class="card-footer" id="fb-editor-footer">
                        <button type="submit" class="btn btn-primary fb-save-btn">
                            <i class="fa fa-save"></i> Submit &amp; Save
                        </button>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
</div>
@endsection


