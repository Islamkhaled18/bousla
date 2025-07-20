@extends('layouts.admin.app')
@section('title')
طلب انضمام
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
            @can('join_requests')
            <li class="breadcrumb-item active"><a href="{{ route('admin.join-requests.show', $join_request->id) }}"
                    title="طلب انضمام">طلب انضمام</a></li>
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
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم </label>
                                        <input class="form-control" id="exampleInputEmail1" name="name"
                                            value="{{old('name', $join_request->name)}}" type="text"
                                            placeholder="اكتب الاسم " disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الايميل </label>
                                        <input class="form-control" id="exampleInputEmail1" name="email"
                                            value="{{old('email', $join_request->email)}}" type="text"
                                            placeholder="اكتب الايميل " disabled>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نبذه عني </label>
                                        <input class="form-control" id="exampleInputEmail1" name="about_me"
                                            value="{{old('about_me', $join_request->about_me)}}" type="text"
                                            placeholder="اكتب نبذه عني " disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">رقم الهاتف </label>
                                        <input class="form-control" id="exampleInputEmail1" name="phone"
                                            value="{{old('phone', $join_request->phone)}}" type="text"
                                            placeholder="اكتب رقم الهاتف " disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">رقم البطاقه </label>
                                        <input class="form-control" id="exampleInputEmail1" name="id_number"
                                            value="{{old('id_number', $join_request->id_number)}}" type="number"
                                            placeholder="اكتب رقم البطاقه المكون من 14 رقم " disabled>
                                    </div>
                                </div>
                            </div>

                            {{-- dropdown job title --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_title">الوظيفه</label>
                                        <select class="form-control" name="job_title_id" id="job_title_id" disabled>
                                            <option value="">اختر الوظيفه</option>
                                            @foreach ($job_titles as $job_title)
                                            <option value="{{ $job_title->id }}" {{ old('job_title_id', $join_request->
                                                job_title_id) == $job_title->id ? 'selected' : '' }}>
                                                {{ $job_title->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- dropdown area --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">المنطقه</label>
                                        <select class="form-control" name="area_id" id="area_id" disabled>
                                            <option value="">اختر المنطقه</option>
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" {{ old('area_id', $join_request->area_id) ==
                                                $area->id ? 'selected' : '' }}>
                                                {{ $area->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @php
                            function isImageFile($filename) {
                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
                            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                            return in_array($extension, $imageExtensions);
                            }

                            function getFileIcon($filename) {
                            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                            $icons = [
                            'pdf' => 'fa-file-pdf-o',
                            'doc' => 'fa-file-word-o',
                            'docx' => 'fa-file-word-o',
                            'xls' => 'fa-file-excel-o',
                            'xlsx' => 'fa-file-excel-o',
                            'ppt' => 'fa-file-powerpoint-o',
                            'pptx' => 'fa-file-powerpoint-o',
                            'txt' => 'fa-file-text-o',
                            'zip' => 'fa-file-zip-o',
                            'rar' => 'fa-file-zip-o',
                            'mp4' => 'fa-file-video-o',
                            'mp3' => 'fa-file-audio-o',
                            'wav' => 'fa-file-audio-o',
                            ];

                            return isset($icons[$extension]) ? $icons[$extension] : 'fa-file-o';
                            }
                            @endphp

                            {{-- image --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_image_back">الصوره</label>
                                        @if($join_request->image)
                                        <div class="mb-2">
                                            @if(isImageFile($join_request->image))
                                            <img src="{{ asset('images/' . $join_request->image) }}"
                                                alt="Current ID Back" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($join_request->image) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($join_request->image,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <a href="{{ asset('images/' . $join_request->image) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض الملف
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- logo --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="logo">اللوجو</label>
                                        @if($join_request->logo)
                                        <div class="mb-2">
                                            @if(isImageFile($join_request->logo))
                                            <img src="{{ asset('images/' . $join_request->logo) }}"
                                                alt="Current ID Front" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($join_request->logo) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($join_request->logo,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <a href="{{ asset('images/' . $join_request->logo) }}"
                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض الملف
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- id_image_front --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_image_front">صورة البطاقه الاماميه</label>
                                        @if($join_request->id_image_front)
                                        <div class="mb-2">
                                            @if(isImageFile($join_request->id_image_front))
                                            <img src="{{ asset('images/' . $join_request->id_image_front) }}"
                                                alt="Current ID Front" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($join_request->id_image_front) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($join_request->id_image_front,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <a href="{{ asset('images/' . $join_request->id_image_front) }}"
                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض الملف
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- id_image_back --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_image_back">صورة البطاقه الخلفيه</label>
                                        @if($join_request->id_image_back)
                                        <div class="mb-2">
                                            @if(isImageFile($join_request->id_image_back))
                                            <img src="{{ asset('images/' . $join_request->id_image_back) }}"
                                                alt="Current ID Back" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($join_request->id_image_back) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($join_request->id_image_back,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <a href="{{ asset('images/' . $join_request->id_image_back) }}"
                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض الملف
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- graduation_certificate --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="graduation_certificate">شهادة التخرج</label>
                                        @if($join_request->graduation_certificate)
                                        <div class="mb-2">
                                            @if(isImageFile($join_request->graduation_certificate))
                                            <img src="{{ asset('images/' . $join_request->graduation_certificate) }}"
                                                alt="Current Certificate" class="img-thumbnail" width="120"
                                                height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($join_request->graduation_certificate) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{
                                                    pathinfo($join_request->graduation_certificate, PATHINFO_EXTENSION)
                                                    }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <div class="btn-group" role="group">
                                                @if(\Illuminate\Support\Str::endsWith(strtolower($join_request->graduation_certificate),
                                                '.pdf'))
                                                <a href="{{ route('admin.admin.join-requests.download-graduation-certificate', $join_request->id) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-download"></i> تحميل
                                                </a>
                                                @else
                                                <a href="{{ asset('images/' . $join_request->graduation_certificate) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-eye"></i> عرض الملف
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- professional_license --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="professional_license">شهادة مزاولة المهنه</label>
                                        @if($join_request->professional_license)
                                        <div class="mb-2">
                                            @if(isImageFile($join_request->professional_license))
                                            <img src="{{ asset('images/' . $join_request->professional_license) }}"
                                                alt="Current License" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($join_request->professional_license) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{
                                                    pathinfo($join_request->professional_license, PATHINFO_EXTENSION)
                                                    }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <div class="btn-group" role="group">
                                                @if(\Illuminate\Support\Str::endsWith(strtolower($join_request->professional_license),
                                                '.pdf'))
                                                <a href="{{ route('admin.admin.join-requests.download-professional-license', $join_request->id) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-download"></i> تحميل
                                                </a>
                                                @else
                                                <a href="{{ asset('images/' . $join_request->professional_license) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-eye"></i> عرض الملف
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- syndicate_card --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="syndicate_card">كارنية النقابه</label>
                                        @if($join_request->syndicate_card)
                                        <div class="mb-2">
                                            @if(isImageFile($join_request->syndicate_card))
                                            <img src="{{ asset('images/' . $join_request->syndicate_card) }}"
                                                alt="Current Card" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($join_request->syndicate_card) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($join_request->syndicate_card,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <div class="btn-group" role="group">
                                                @if(\Illuminate\Support\Str::endsWith(strtolower($join_request->syndicate_card),
                                                '.pdf'))
                                                <a href="{{ route('admin.admin.join-requests.download-syndicate-card', $join_request->id) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-download"></i> تحميل
                                                </a>
                                                @else
                                                <a href="{{ asset('images/' . $join_request->syndicate_card) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-eye"></i> عرض الملف
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم المنظمه </label>
                                        <input class="form-control" id="exampleInputEmail1" name="organization_name"
                                            value="{{old('organization_name', $join_request->organization_name)}}"
                                            type="text" placeholder="اسم المنظمه " disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عنوان المنظمه بالتفصيل</label>
                                        <input class="form-control" id="exampleInputEmail1" name="organization_address"
                                            value="{{old('organization_address', $join_request->organization_address)}}"
                                            type="text" placeholder="عنوان المنظمه بالتفصيل" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الرقم الاول للمنظمه</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            name="organization_phone_first"
                                            value="{{old('organization_phone_first', $join_request->organization_phone_first)}}"
                                            type="text" placeholder="الرقم الاول للمنظمه" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الرقم الثاني للمنظمه</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            name="organization_phone_second"
                                            value="{{old('organization_phone_second', $join_request->organization_phone_second)}}"
                                            type="text" placeholder="الرقم الثاني للمنظمه" disabled>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الرقم الثالث للمنظمه</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            name="organization_phone_third"
                                            value="{{old('organization_phone_third', $join_request->organization_phone_third)}}"
                                            type="text" placeholder="الرقم الثالث للمنظمه" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عنوان المنظمه على خريطة جوجل</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            name="organization_location_url"
                                            value="{{old('organization_location_url', $join_request->organization_location_url)}}"
                                            type="text" placeholder="عنوان المنظمه على خريطة جوجل" disabled>

                                    </div>
                                </div>
                            </div>

                            {{-- Current Organization Photos Display --}}
                            @if($join_request->images && $join_request->images->count() > 0)
                            <div class="form-group">
                                <label>الصور الحالية للمنظمه</label>
                                <div class="row">
                                    @foreach($join_request->images as $image)
                                    <div class="col-md-3 mb-3">
                                        @if(isImageFile($image->photo))
                                        <img src="{{ asset($image->photo) }}" alt="Organization Photo"
                                            class="img-thumbnail" width="120" height="120">
                                        @else
                                        <div class="file-display p-3 border rounded text-center"
                                            style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                            <i class="fa {{ getFileIcon($image->photo) }} fa-3x text-muted mb-2"></i>
                                            <small class="text-muted">{{ pathinfo($image->photo, PATHINFO_EXTENSION)
                                                }}</small>
                                        </div>
                                        @endif
                                        <div class="mt-2 text-center">
                                            <a href="{{ asset($image->photo) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
