@extends('layouts.admin.app')
@section('title')
انشاء منطقة جديده
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> المناطق </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('areas')
            <li class="breadcrumb-item"><a href="{{ route('admin.areas.index') }}" title="المناطق">المناطق</a></li>
            @endcan
            @can('areas.create')
            <li class="breadcrumb-item active"><a href="{{ route('admin.areas.create') }}"
                    title="انشاء منطقة جديده">إانشاء منطقة جديده</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{route('admin.areas.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">المنطقه </label>
                                <input class="form-control" id="exampleInputEmail1" name="name" value="{{old('name')}}"
                                    type="text" placeholder="اكتب الاسم ">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">المدينه </label>
                                <select class="form-control" id="exampleInputEmail1" name="city_id">
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
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
