@extends('layouts.admin.app')
@section('title')
تعديل اوامر وصلاحيات جديده
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> الاوامر والصلاحيات </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('roles')
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}" title="الاوامر والصلاحيات">الاوامر
                    والصلاحيات</a></li>
            @endcan
            @can('roles.edit')
            <li class="breadcrumb-item active"><a href="{{ route('admin.roles.edit', $role) }}"
                    title="تعديل على اوامر وصلاحيات">تعديل على محافظه او سعر
                    الشحن -
                    {{ $role->name }}</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{ route('admin.roles.update', $role) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input name="id" value="{{ $role->id }}" type="hidden">

                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم</label>
                                <input class="form-control" id="exampleInputEmail1" name="name"
                                    value="{{ $role->name }}" type="text">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h3>الصلاحيات</h3>
                                @foreach (config('permissions') as $code => $label)
                                <div class="form-check">

                                    <input class="form-check-input" name="permissions[]" type="checkbox"
                                        value="{{ $code }}" <?php if (in_array($code,
                                        $role->permissions->pluck('permission')->toArray())) {
                                    echo 'checked="checked"';
                                    } ?>>
                                    <label class="form-check-label">
                                        {{ $label }}
                                    </label>
                                </div>
                                @endforeach
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
