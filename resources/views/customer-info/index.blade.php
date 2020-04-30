@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Customer Info

                        <div class="btn-toolbar float-md-right" role="toolbar">
                            <div class="btn-group" role="group" aria-label="Third group">
                                <a href="{{ route('customer-info.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus-circle"></i> New Customer
                                </a>
                            </div>
                        </div>
                    </h5>
                </div>

                @include('notify.index')
                @if($getCustomerInfo->count())
                    <div class="table-responsive">
                        <table class="table table-bordered d-table table-striped pb-0 mb-0">
                            <thead>
                                <tr>
                                    <th class="five">#</th>
                                    <th>Data</th>
                                    
                                    <th class="twenty-five">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getCustomerInfo as $customerInfo)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @php
                                                $value = json_decode($customerInfo->value);
                                                echo $value[0]->label .' - '.$value[0]->value;
                                            @endphp 
                                        </td>
                                        <td>
                                           
                                            <a href="{{ route('customer-info.show', $customerInfo) }}" class="btn btn-success btn-sm" title="Preview form">
                                                <i class="fa fa-eye"></i> 
                                            </a> 
                                            <a href="{{ route('customer-info.edit', $customerInfo) }}" class="btn btn-primary btn-sm" title="Edit form">
                                                <i class="fa fa-pencil"></i> 
                                            </a> 
                                            

                                            <form action="{{ route('customer-info.destroy', $customerInfo) }}" method="POST" id="deleteFormForm_{{ $customerInfo->id }}" class="d-inline-block">
                                                @csrf 
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteFormForm_{{ $customerInfo->id }}" data-message="Delete form '{{ $customerInfo->name }}'?" title="Delete form '{{ $customerInfo->name }}'">
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
