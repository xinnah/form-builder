@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ $pageTitle ?? '' }}

                        <a href='{{ url("forms/$formId/customer-info") }}' class="btn btn-sm btn-primary float-md-right">
                            <i class="fa fa-arrow-left"></i> Back To Customer Info
                        </a>
                    </h5>
                </div>
                
                <form action='{{ url("forms/$formId/customer-info/$customerInfo->id") }}' method="POST" id="createFormForm">
                    @csrf
                    
                    <div class="card-body">
                        @include('notify.index')
                        <div class="row">
                            @foreach(json_decode($customerInfo->value) as $key => $info)
                            <div class="col-md-6">
                                <div class="form-group {{ isset($info->required) && ($info->required == true) ? 'required': '' }}">
                                    <label for="{{ isset($info->name) ? $info->name : '' }}" class="col-form-label">{{ isset($info->label) ? $info->label : '' }}</label>
                                    @if($info->type == 'text' || $info->type == 'date')
                                    <input id="{{ isset($info->name) ? $info->name : '' }}" type="{{ isset($info->type) ? $info->type : '' }}" class="{{ isset($info->className) ? $info->className : '' }}" name="{{ isset($info->name) ? $info->name : '' }}" value="{{ $info->value }}" placeholder="{{ isset($info->placeholder) ? $info->placeholder: '' }}" {{ isset($info->required) && ($info->required == true) ? 'required': '' }}>
                                    @elseif($info->type == 'textarea')
                                    <textarea rows="3" id="{{ isset($info->name) ? $info->name : '' }}" class="{{ isset($info->className) ? $info->className : '' }}" name="{{ isset($info->name) ? $info->name : '' }}" placeholder="{{ isset($info->placeholder) ? $info->placeholder : '' }}" {{ isset($info->required) && ($info->required == true) ? 'required': '' }}>@php echo $info->value; @endphp
                                        
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
                            <i class="fa fa-save"></i> Submit &amp; Update
                        </button>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
</div>
@endsection


