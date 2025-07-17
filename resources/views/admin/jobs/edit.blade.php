@extends('layouts.admin.app')
@section('title')
تعديل وظيفه
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> الوظائف </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('jobs')
            <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}"
                    title="الوظائف">الوظائف</a></li>
            @endcan
            @can('jobs.edit')
            <li class="breadcrumb-item active"><a href="{{ route('admin.jobs.edit', $job) }}"
                    title="تعديل على وظيفه">تعديل على وظيفه -
                    {{ $job->name }}</a></li>
            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="tile-body">
                    <div class="col-lg-6">
                        <form action="{{ route('admin.jobs.update', $job) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input name="id" value="{{ $job->id }}" type="hidden">

                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم</label>
                                <input class="form-control" id="exampleInputEmail1" name="name"
                                    value="{{ $job->name }}" type="text" placeholder="اكتب الاسم">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
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
