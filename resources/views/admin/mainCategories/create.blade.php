@extends('layouts.admin.app')
@section('title')
انشاء قسم رئيسي جديد
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> الاقسام الرئيسية </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('mainCategories')
            <li class="breadcrumb-item"><a href="{{ route('admin.mainCategories.index') }}"
                    title="الاقسام الرئيسية">الاقسام الرئيسية</a></li>
            @endcan
            @can('mainCategories.create')
            <li class="breadcrumb-item active"><a href="{{ route('admin.mainCategories.create') }}"
                    title="انشاء قسم رئيسي جديد">إانشاء قسم رئيسي جديد</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{route('admin.mainCategories.store')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم </label>
                                <input class="form-control" id="exampleInputEmail1" name="name" value="{{old('name')}}"
                                    type="text" placeholder="اكتب الاسم ">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">صورة القسم الرئيسي</label>
                                <input class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                    type="file">
                                @error('file')
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
