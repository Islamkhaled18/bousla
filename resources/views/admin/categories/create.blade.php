@extends('layouts.admin.app')
@section('title')
انشاء قسم جديد
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> الاقسام </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('categories')
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}" title="الاقسام">الاقسام</a></li>
            @endcan
            @can('categories.create')
            <li class="breadcrumb-item active"><a href="{{ route('admin.categories.create') }}"
                    title="انشاء قسم جديد">إانشاء قسم جديد</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{ route('admin.categories.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="exampleInputEmail1"> اسم القسم</label>
                                <input class="form-control" id="exampleInputEmail1" name="name"
                                    value="{{ old('name') }}" type="text" placeholder="اسم القسم">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row" style="display:none" id="cats_list">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="projectinput1">
                                            القسم التابع
                                        </label>
                                        <select name="parent_id" class="select2 form-group">
                                            <optgroup label="اختر القسم">
                                                @if ($categories && $categories->count() > 0)
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                                @endforeach
                                                @endif

                                            </optgroup>
                                        </select>
                                        @error('parent_id')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="image">صورة القسم</label>
                                <input class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                    type="file">
                                @error('file')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mt-1">
                                    <input type="radio" name="type" value="1" class="switchery" data-color="success" />
                                    <label class="card-title ml-1">القسم الرئيسي</label>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-1">
                                    <input type="radio" name="type" value="2" class="switchery" data-color="success" />
                                    <label class="card-title ml-1">القسم التابع</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="projectinput1">
                                            القسم الرئيسي
                                        </label>
                                        <select name="main_category_id" class="select2 form-group">
                                            <optgroup label="اختر القسم الرئيسي">
                                                @if ($mainCategories && $mainCategories->count() > 0)
                                                @foreach ($mainCategories as $mainCategory)
                                                <option value="{{ $mainCategory->id }}">
                                                    {{ $mainCategory->name }}</option>
                                                @endforeach
                                                @endif

                                            </optgroup>
                                        </select>
                                        @error('main_category_id')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
    $('input:radio[name="type"]').change(
    function() {
        if (this.checked && this.value == '2') { // قسم تابع
            $('#cats_list').css('display', 'block');
            $('select[name="parent_id"]').prop('disabled', false);
        } else {
            $('#cats_list').css('display', 'none');

            $('select[name="parent_id"]').val('').prop('disabled', true).trigger('change');
        }
    });


$(document).ready(function() {
    var selectedType = $('input:radio[name="type"]:checked').val();
    if (selectedType == '1') {
        $('#cats_list').css('display', 'none');
        $('select[name="parent_id"]').val('').prop('disabled', true).trigger('change');
    } else if (selectedType == '2') {
        $('#cats_list').css('display', 'block');
        $('select[name="parent_id"]').prop('disabled', false);
    }
});

</script>
@endpush
