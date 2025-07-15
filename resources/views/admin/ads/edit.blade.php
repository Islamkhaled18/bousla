@extends('layouts.admin.app')
@section('title')
تعديل صورة اعلان
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> تعديل صورة اعلان </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('ads')
            <li class="breadcrumb-item"><a href="{{ route('admin.ads.index') }}" title="صور الاعلانات">صور الاعلانات</a>
            </li>
            @endcan
            @can('ads.edit')
            <li class="breadcrumb-item active"><a href="{{ route('admin.ads.edit', $ad) }}"
                    title="تعديل على صورة اعلان">تعديل على صورة اعلان -
                    {{ $ad->name }}</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{ route('admin.ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input name="id" value="{{ $ad->id }}" type="hidden">

                            <div class="form-group">
                                <label for="exampleInputEmail1">اسم الاعلان </label>
                                <input class="form-control" id="exampleInputEmail1" name="name" value="{{ $ad->name }}"
                                    type="text" placeholder="اكتب اسم الاعلان ">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">صورة الاعلان</label>
                                <td><img src="{{ $ad->image_url }}" class="d-block" width="60" height="60"
                                        alt="{{ $ad->name }}"></td>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    value="{{ old('image') }}" id="image" name="image">
                                @error('file')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="brand_id">الماركه</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">اختر الماركه</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $brand->id == $ad->brand_id ? 'selected' : ''
                                        }}>
                                        {{ $brand->name }}
                                    </option>
                                    @endforeach
                                </select>
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
