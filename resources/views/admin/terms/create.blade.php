@extends('layouts.admin.app')
@section('title')
انشاء شروط احكام جديده
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>انشاء شروط احكام جديده </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('terms')
            <li class="breadcrumb-item"><a href="{{ route('admin.terms.index') }}" title="الشروط والاحكام ">الشروط والاحكام
                </a></li>
            @endcan
            @can('terms.create')
            <li class="breadcrumb-item active"><a href="{{ route('admin.terms.create') }}"
                    title="  انشاء شروط احكام جديده">إانشاء شروط احكام جديده</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{route('admin.terms.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">محتوى الشروط </label>
                                <textarea class="form-control" id="editor_two" name="name"></textarea>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
@push('scripts')
<script>
    ClassicEditor
		.create( document.querySelector( '#editor_two' ) )
		.catch( error => {
			console.error( error );
		} );
</script>
@endpush
