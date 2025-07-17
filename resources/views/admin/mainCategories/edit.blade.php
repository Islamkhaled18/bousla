@extends('layouts.admin.app')
@section('title')
تعديل قسم رئيسي
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> الاقسم الرئيسيه </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('mainCategories')
            <li class="breadcrumb-item"><a href="{{ route('admin.mainCategories.index') }}"
                    title="الاقسام الرئيسيه">الاقسام الرئيسيه</a></li>
            @endcan
            @can('mainCategories.edit')
            <li class="breadcrumb-item active"><a href="{{ route('admin.mainCategories.edit', $mainCategory) }}"
                    title="تعديل على قسم رئيسي">تعديل على قسم رئيسي -
                    {{ $mainCategory->name }}</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{ route('admin.mainCategories.update', $mainCategory) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input name="id" value="{{ $mainCategory->id }}" type="hidden">

                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم</label>
                                <input class="form-control" id="exampleInputEmail1" name="name"
                                    value="{{ $mainCategory->name }}" type="text" placeholder="اكتب الاسم">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">صورة الماركه</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    value="{{ old('image') }}" id="image" name="image">
                                <td><img src="{{ $mainCategory->image_url }}" class="d-block" width="60" height="60" alt="">
                                </td>
                                @error('file')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit">تعديل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
