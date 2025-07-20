@extends('layouts.admin.app')
@section('title')
انشاء طلب انضمام جديد
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> طلبات الانضمام </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('join_requests')
            <li class="breadcrumb-item"><a href="{{ route('admin.join-requests.index') }}" title="طلبات الانضمام">طلبات
                    الانضمام</a></li>
            @endcan
            @can('join_requests.create')
            <li class="breadcrumb-item active"><a href="{{ route('admin.join-requests.create') }}"
                    title="انشاء طلب انضمام جديد">إانشاء طلب انضمام جديد</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        {{-- error --}}
        @foreach ($errors as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>

        @endforeach
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="container-fluid">
                        <form action="{{route('admin.join-requests.store')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم </label>
                                        <input class="form-control" id="exampleInputEmail1" name="name"
                                            value="{{old('name')}}" type="text" placeholder="اكتب الاسم ">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الايميل </label>
                                        <input class="form-control" id="exampleInputEmail1" name="email"
                                            value="{{old('email')}}" type="text" placeholder="اكتب الايميل ">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نبذه عني </label>
                                        <input class="form-control" id="exampleInputEmail1" name="about_me"
                                            value="{{old('about_me')}}" type="text" placeholder="اكتب نبذه عني ">
                                        @error('about_me')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">رقم الهاتف </label>
                                        <input class="form-control" id="exampleInputEmail1" name="phone"
                                            value="{{old('phone')}}" type="text" placeholder="اكتب رقم الهاتف ">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">رقم البطاقه </label>
                                        <input class="form-control" id="exampleInputEmail1" name="id_number"
                                            value="{{old('id_number')}}" type="number"
                                            placeholder="اكتب رقم البطاقه المكون من 14 رقم ">
                                        @error('id_number')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- dropdown job title --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_title">الوظيفه</label>
                                        <select class="form-control" name="job_title_id" id="job_title_id">
                                            <option value="">اختر الوظيفه</option>
                                            @foreach ($job_titles as $job_title)
                                            <option value="{{ $job_title->id }}">{{ $job_title->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- dropdown area --}}
                                    <div class="form-group">
                                        <label for="area">المنطقه</label>
                                        <select class="form-control" name="area_id" id="area_id">
                                            <option value="">اختر المنطقه</option>
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- image --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">الصوره</label>
                                        <input class="form-control @error('image') is-invalid @enderror" id="image"
                                            name="image" type="file">
                                        @error('image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">اللوجو</label>
                                        <input class="form-control @error('logo') is-invalid @enderror" id="logo"
                                            name="logo" type="file">
                                        @error('logo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- id_image_front --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_image_front">صورة البطاقه الاماميه</label>
                                        <input class="form-control @error('id_image_front') is-invalid @enderror"
                                            id="id_image_front" name="id_image_front" type="file">
                                        @error('id_image_front')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- id_image_back --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_image_back">صورة البطاقه الخلفيه</label>
                                        <input class="form-control @error('id_image_back') is-invalid @enderror"
                                            id="id_image_back" name="id_image_back" type="file">
                                        @error('id_image_back')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- graduation_certificate --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="graduation_certificate">شهادة التخرج</label>
                                        <input
                                            class="form-control @error('graduation_certificate') is-invalid @enderror"
                                            id="graduation_certificate" name="graduation_certificate" type="file">
                                        @error('graduation_certificate')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- professional_license --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="professional_license">شهادة مزاولة المهنه</label>
                                        <input class="form-control @error('professional_license') is-invalid @enderror"
                                            id="professional_license" name="professional_license" type="file">
                                        @error('professional_license')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- syndicate_card --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="syndicate_card">كارنية النقابه</label>
                                        <input class="form-control @error('syndicate_card') is-invalid @enderror"
                                            id="syndicate_card" name="syndicate_card" type="file">
                                        @error('syndicate_card')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم المنظمه </label>
                                        <input class="form-control" id="exampleInputEmail1" name="organization_name"
                                            value="{{old('organization_name')}}" type="text" placeholder="اسم المنظمه ">
                                        @error('organization_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عنوان المنظمه بالتفصيل</label>
                                        <input class="form-control" id="exampleInputEmail1" name="organization_address"
                                            value="{{old('organization_address')}}" type="text"
                                            placeholder="عنوان المنظمه بالتفصيل">
                                        @error('organization_address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الرقم الاول للمنظمه</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            name="organization_phone_first" value="{{old('organization_phone_first')}}"
                                            type="text" placeholder="الرقم الاول للمنظمه">
                                        @error('organization_phone_first')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الرقم الثاني للمنظمه</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            name="organization_phone_second"
                                            value="{{old('organization_phone_second')}}" type="text"
                                            placeholder="الرقم الثاني للمنظمه">
                                        @error('organization_phone_second')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الرقم الثالث للمنظمه</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            name="organization_phone_third" value="{{old('organization_phone_third')}}"
                                            type="text" placeholder="الرقم الثالث للمنظمه">
                                        @error('organization_phone_third')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عنوان المنظمه على خريطة جوجل</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            name="organization_location_url"
                                            value="{{old('organization_location_url')}}" type="text"
                                            placeholder="عنوان المنظمه على خريطة جوجل">
                                        @error('organization_location_url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo" class="form-label">صور للمنظمه</label>

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
