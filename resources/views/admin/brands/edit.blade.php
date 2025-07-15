@extends('layouts.admin.app')
@section('title')
تعديل ماركه
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> الماركات </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('brands')
            <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}" title="الماركات">الماركات</a></li>
            @endcan
            @can('brands.edit')
            <li class="breadcrumb-item active"><a href="{{ route('admin.brands.edit', $brand) }}"
                    title="تعديل على ماركه">تعديل على ماركه -
                    {{ $brand->name }}</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{ route('admin.brands.update', $brand) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input name="id" value="{{ $brand->id }}" type="hidden">

                            <div class="form-group">
                                <label for="exampleInputEmail1">اسم الماركه </label>
                                <input class="form-control" id="exampleInputEmail1" name="name"
                                    value="{{ $brand->name }}" type="text" placeholder="اكتب اسم الماركه ">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">صورة الماركه</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    value="{{ old('image') }}" id="image" name="image">
                                <td><img src="{{ $brand->image_url }}" class="d-block" width="60" height="60" alt="">
                                </td>
                                @error('file')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="photo" class="form-label">صور الماراكات المجتمعه</label>

                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    value="{{ old('photo') }}" id="photo" name="photo[]" multiple accept="image/*">
                                @error('photo[]')
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
