@extends('layouts.admin.app')
@section('title')
تعديل مشرف
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
            @can('admins')
            <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}" title="المشرفين">المشرفين</a></li>
            @endcan
            @can('admins.edit')
            <li class="breadcrumb-item active"><a href="{{ route('admin.admins.edit', $admin) }}"
                    title="تعديل على مشرف">تعديل على مشرف -
                    {{ $admin->name }}</a></li>
            @can('admins.create')
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.admins.update', $admin) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" value="{{ $admin->id }}">

                            <div class="row g-3">
                                <div class="form-group col-md-6">
                                    <label>الاسم بالكامل</label>
                                    <input class="form-control" name="name" value="{{ $admin->name }}" type="text"
                                        placeholder="اكتب الاسم بالكامل">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>البريد الإلكتروني</label>
                                    <input class="form-control" name="email" value="{{ $admin->email }}" type="email"
                                        placeholder="اكتب البريد الإلكتروني">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="form-group col-md-6">
                                    <label>الرقم السري القديم</label>
                                    <input class="form-control" name="old_password" type="password">
                                    @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>الرقم السري الجديد</label>
                                    <input class="form-control" name="password" type="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="form-group col-md-6">
                                    <label>رقم الهاتف</label>
                                    <input class="form-control" name="phone" type="text" value="{{ $admin->phone }}"
                                        placeholder="اكتب رقم الهاتف">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-md-6"></div> {{-- فراغ لملء الصف --}}
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="form-group col-md-6">
                                    <label>اختر الدور الخاص به</label>
                                    <select name="role_id" class="select2 form-control">
                                        <option disabled selected>من فضلك اختر الدور</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if ($role->id == $admin->role_id) selected
                                            @endif>
                                            {{ $role->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('role_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>اختر حالة المشرف</label>
                                    <select name="suspend" class="select2 form-control">
                                        <option value="0" @if ($admin->suspend == 0) selected @endif>مفعل</option>
                                        <option value="1" @if ($admin->suspend == 1) selected @endif>معطل</option>
                                    </select>
                                    @error('suspend') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="tile-footer mt-4">
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
