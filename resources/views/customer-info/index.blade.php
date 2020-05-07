@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Customer Info - {{ isset($form->name) ? $form->name : '' }}

                        <div class="btn-toolbar float-md-right" role="toolbar">
                            <div class="btn-group" role="group" aria-label="Third group">
                                <a href='{{ url("forms/$form->id/customer-info/create") }}' class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus-circle"></i> New Customer
                                </a>
                            </div>
                        </div>
                    </h5>
                </div>

                @include('notify.index')
                @if($getCustomerInfo->count() && $form != '')
                    <div class="table-responsive">
                        <table class="table table-bordered d-table table-striped pb-0 mb-0">
                            <thead>
                                <tr>
                                    <th class="five">#</th>
                                    @foreach(json_decode($form->form_builder_json) as $key => $info)
                                    @if(isset($info->required) && ($info->required == true))
                                    <th>{{ $info->label }}</th>
                                    @endif
                                    @endforeach
                                    <th class="twenty-five">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getCustomerInfo as $customerInfo)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @foreach(json_decode($customerInfo->value) as $key => $cField)
                                        @if(isset($cField->required) && ($cField->required == true))
                                        <td>{{ $cField->value }}</td>
                                        @endif
                                        @endforeach
                                        <td>
                                           
                                            <a href='{{ url("/forms/$form->id/customer-info/$customerInfo->id") }}' class="btn btn-success btn-sm" title="Preview form">
                                                <i class="fa fa-eye"></i> 
                                            </a> 
                                            <a href='{{ url("/forms/$form->id/customer-info/$customerInfo->id/edit") }}' class="btn btn-primary btn-sm" title="Edit form">
                                                <i class="fa fa-pencil"></i> 
                                            </a> 
                                            
                                            
                                            <form action='{{ url("forms/$form->id/customer-info/$customerInfo->id/delete") }}' method="POST" id="deleteFormForm_{{ $customerInfo->id }}" class="d-inline-block">
                                                @csrf 
                                            
                                                <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteFormForm_{{ $customerInfo->id }}" data-message="Delete form '{{ $customerInfo->id }}'?" title="Delete form '{{ $customerInfo->id }}'">
                                                    <i class="fa fa-trash-o"></i> 
                                                </button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($getCustomerInfo->hasPages())
                        <div class="card-footer mb-0 pb-0">
                            <div>{{ $getCustomerInfo->links() }}</div>
                        </div>
                    @endif
                @else
                    <div class="card-body">
                        <h4 class="text-danger text-center">
                            No Data Found!
                        </h4>
                    </div>  
                @endif
                    
                
            </div>
        </div>
    </div>
</div>
@endsection
