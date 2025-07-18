@extends('layouts.admin.app')
@section('title')
انشاء ماركه جديده
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
            @can('brands.create')
            <li class="breadcrumb-item active"><a href="{{ route('admin.brands.create') }}"
                    title="انشاء ماركه جديده">إانشاء
                    ماركه جديده</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{route('admin.brands.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">اسم الماركه</label>
                                <input class="form-control" id="exampleInputEmail1" name="name" value="{{old('name')}}"
                                    type="text" placeholder="اكتب الماركه">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">صورة الماركه</label>
                                <input class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                    type="file">
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
