@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Forms

                        <div class="btn-toolbar float-md-right" role="toolbar">
                            <div class="btn-group" role="group" aria-label="Third group">
                                <a href="{{ route('formbuilder::forms.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus-circle"></i> Create a New Form
                                </a>

                                <!-- <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-th-list"></i> My Submissions
                                </a> -->
                            </div>
                        </div>
                    </h5>
                </div>

                @if($forms->count())
                    <div class="table-responsive">
                        <table class="table table-bordered d-table table-striped pb-0 mb-0">
                            <thead>
                                <tr>
                                    <th class="five">#</th>
                                    <th>Name</th>
                                    <th class="ten">Visibility</th>
                                    <th class="fifteen">Allows Edit?</th>
                                    <th class="ten">Status</th>
                                    <th class="twenty-five">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($forms as $form)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $form->name }}</td>
                                        <td>{{ $form->visibility }}</td>
                                        <td>{{ $form->allowsEdit() ? 'YES' : 'NO' }}</td>
                                        <td>
                                            <form action="{{ url('forms-staus-update') }}" method="POST" id="statusFormForm_{{ $form->id }}" class="d-inline-block">
                                                @csrf 
                                                <input type="hidden" value="{{ $form->id }}" name="id">
                                                
                                                <button type="submit" class="btn {{ ($form->status == 1) ? 'btn-danger' : 'btn-success' }} btn-sm confirm-form" data-form="statusFormForm_{{ $form->id }}" data-message="Status Change form '{{ $form->name }}'?" title="This Form {{ $form->name }} is now {{ ($form->status == 1) ? 'Active' : 'Inactive' }}">
                                                    {{ ($form->status == 1) ? 'Inactive' : 'Active' }}
                                                </button>
                                            </form>
                                            
                                        </td>
                                        <td>
                                            <a href='{{ url("forms/$form->id/customer-info") }}' class="btn btn-success btn-sm" title="View Customer Info List for form '{{ $form->name }}'">
                                                <i class="fa fa-th-list"></i> Customer Info
                                            </a>
                                            <a href="{{ route('formbuilder::forms.show', $form) }}" class="btn btn-primary btn-sm" title="Preview form '{{ $form->name }}'">
                                                <i class="fa fa-eye"></i> 
                                            </a> 
                                            <a href="{{ route('formbuilder::forms.edit', $form) }}" class="btn btn-primary btn-sm" title="Edit form">
                                                <i class="fa fa-pencil"></i> 
                                            </a> 
                                            <button class="btn btn-primary btn-sm clipboard" data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}" data-message="" data-original="" title="Copy form URL to clipboard">
                                                <i class="fa fa-clipboard"></i> 
                                            </button> 

                                            <form action="{{ route('formbuilder::forms.destroy', $form) }}" method="POST" id="deleteFormForm_{{ $form->id }}" class="d-inline-block">
                                                @csrf 
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteFormForm_{{ $form->id }}" data-message="Delete form '{{ $form->name }}'?" title="Delete form '{{ $form->name }}'">
                                                    <i class="fa fa-trash-o"></i> 
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($forms->hasPages())
                        <div class="card-footer mb-0 pb-0">
                            <div>{{ $forms->links() }}</div>
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
