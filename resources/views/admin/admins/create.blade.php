@extends('layouts.admin.app')
@section('title')
انشاء مشرف
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> المشرفين </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}" title="المشرفين">المشرفين</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.admins.create') }}" title="انشاء مشرف">إانشاء
                    مشرف</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="form-group col-md-6">
                                    <label>الاسم بالكامل</label>
                                    <input class="form-control" name="name" value="{{ old('name') }}" type="text"
                                        placeholder="اكتب الاسم بالكامل">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>البريد الإلكتروني</label>
                                    <input class="form-control" name="email" value="{{ old('email') }}" type="email"
                                        placeholder="اكتب البريد الإلكتروني">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="form-group col-md-6">
                                    <label>كلمة المرور</label>
                                    <input class="form-control" name="password" type="password"
                                        placeholder="كلمة المرور">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>رقم الهاتف</label>
                                    <input class="form-control" name="phone" value="{{ old('phone') }}" type="text"
                                        placeholder="رقم الهاتف">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="form-group col-md-6">
                                    <label>اختار الدور الخاص به</label>
                                    <select name="role_id" class="select2 form-control">
                                        <option disabled selected>من فضلك أختر الدور</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>حالة المشرف</label>
                                    <select name="suspend" class="select2 form-control">
                                        <option value="0">مفعل</option>
                                        <option value="1">معطل</option>
                                    </select>
                                    @error('suspend') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="tile-footer mt-4">
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
