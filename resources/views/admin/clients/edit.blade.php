@extends('layouts.admin.app')
@section('title')
تعديل عميل
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> تعديل عميل </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('clients')
            <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}" title="العملاء">العملاء</a></li>
            @endcan
            @can('clients.edit')
            <li class="breadcrumb-item active"><a href="{{ route('admin.clients.edit', $client->id) }}"
                    title="تعديل عميل">تعديل عميل</a></li>
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
                        <form action="{{route('admin.clients.update', $client->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم </label>
                                        <input class="form-control" id="exampleInputEmail1" name="name"
                                            value="{{old('name', $client->name)}}" type="text"
                                            placeholder="اكتب الاسم ">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الايميل </label>
                                        <input class="form-control" id="exampleInputEmail1" name="email"
                                            value="{{old('email', $client->email)}}" type="text"
                                            placeholder="اكتب الايميل ">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نبذه عني </label>
                                        <input class="form-control" id="exampleInputEmail1" name="about_me"
                                            value="{{old('about_me', $client->about_me)}}" type="text"
                                            placeholder="اكتب نبذه عني ">
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
                                            value="{{old('phone', $client->phone)}}" type="text"
                                            placeholder="اكتب رقم الهاتف ">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">رقم البطاقه </label>
                                        <input class="form-control" id="exampleInputEmail1" name="id_number"
                                            value="{{old('id_number', $client->id_number)}}" type="number"
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
                                            <option value="{{ $job_title->id }}" {{ old('job_title_id', $client->
                                                job_title_id) == $job_title->id ? 'selected' : '' }}>
                                                {{ $job_title->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('job_title_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- dropdown area --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">المنطقه</label>
                                        <select class="form-control" name="area_id" id="area_id">
                                            <option value="">اختر المنطقه</option>
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" {{ old('area_id', $client->area_id) ==
                                                $area->id ? 'selected' : '' }}>
                                                {{ $area->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                        @if($client->image)
                                        <div class="mb-2">
                                            @if(isImageFile($client->image))
                                            <img src="{{ asset('images/' . $client->image) }}"
                                                alt="Current ID Back" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($client->image) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($client->image,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <a href="{{ asset('images/' . $client->image) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض الملف
                                            </a>
                                        </div>
                                        @endif
                                        <input class="form-control @error('image') is-invalid @enderror" id="image"
                                            name="image" type="file">
                                        <small class="text-muted">اترك فارغاً للاحتفاظ بالملف الحالي</small>
                                        @error('image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                 {{-- logo --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="logo">اللوجو</label>
                                        @if($client->logo)
                                        <div class="mb-2">
                                            @if(isImageFile($client->logo))
                                            <img src="{{ asset('images/' . $client->logo) }}"
                                                alt="Current ID Front" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($client->logo) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($client->logo,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <a href="{{ asset('images/' . $client->logo) }}"
                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض الملف
                                            </a>
                                        </div>
                                        @endif
                                        <input class="form-control @error('logo') is-invalid @enderror"
                                            id="logo" name="logo" type="file">
                                        <small class="text-muted">اترك فارغاً للاحتفاظ بالملف الحالي</small>
                                        @error('logo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                                {{-- id_image_front --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_image_front">صورة البطاقه الاماميه</label>
                                        @if($client->id_image_front)
                                        <div class="mb-2">
                                            @if(isImageFile($client->id_image_front))
                                            <img src="{{ asset('images/' . $client->id_image_front) }}"
                                                alt="Current ID Front" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($client->id_image_front) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($client->id_image_front,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <a href="{{ asset('images/' . $client->id_image_front) }}"
                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض الملف
                                            </a>
                                        </div>
                                        @endif
                                        <input class="form-control @error('id_image_front') is-invalid @enderror"
                                            id="id_image_front" name="id_image_front" type="file">
                                        <small class="text-muted">اترك فارغاً للاحتفاظ بالملف الحالي</small>
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
                                        @if($client->id_image_back)
                                        <div class="mb-2">
                                            @if(isImageFile($client->id_image_back))
                                            <img src="{{ asset('images/' . $client->id_image_back) }}"
                                                alt="Current ID Back" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($client->id_image_back) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($client->id_image_back,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <a href="{{ asset('images/' . $client->id_image_back) }}"
                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> عرض الملف
                                            </a>
                                        </div>
                                        @endif
                                        <input class="form-control @error('id_image_back') is-invalid @enderror"
                                            id="id_image_back" name="id_image_back" type="file">
                                        <small class="text-muted">اترك فارغاً للاحتفاظ بالملف الحالي</small>
                                        @error('id_image_back')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- graduation_certificate --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="graduation_certificate">شهادة التخرج</label>
                                        @if($client->graduation_certificate)
                                        <div class="mb-2">
                                            @if(isImageFile($client->graduation_certificate))
                                            <img src="{{ asset('images/' . $client->graduation_certificate) }}"
                                                alt="Current Certificate" class="img-thumbnail" width="120"
                                                height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($client->graduation_certificate) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{
                                                    pathinfo($client->graduation_certificate, PATHINFO_EXTENSION)
                                                    }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <div class="btn-group" role="group">
                                                @if(\Illuminate\Support\Str::endsWith(strtolower($client->graduation_certificate),
                                                '.pdf'))
                                                <a href="{{ route('admin.admin.join-requests.download-graduation-certificate', $client->id) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-download"></i> تحميل
                                                </a>
                                                @else
                                                <a href="{{ asset('images/' . $client->graduation_certificate) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-eye"></i> عرض الملف
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        <input
                                            class="form-control @error('graduation_certificate') is-invalid @enderror"
                                            id="graduation_certificate" name="graduation_certificate" type="file">
                                        <small class="text-muted">اترك فارغاً للاحتفاظ بالملف الحالي</small>
                                        @error('graduation_certificate')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- professional_license --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="professional_license">شهادة مزاولة المهنه</label>
                                        @if($client->professional_license)
                                        <div class="mb-2">
                                            @if(isImageFile($client->professional_license))
                                            <img src="{{ asset('images/' . $client->professional_license) }}"
                                                alt="Current License" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($client->professional_license) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{
                                                    pathinfo($client->professional_license, PATHINFO_EXTENSION)
                                                    }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <div class="btn-group" role="group">
                                                @if(\Illuminate\Support\Str::endsWith(strtolower($client->professional_license),
                                                '.pdf'))
                                                <a href="{{ route('admin.admin.join-requests.download-professional-license', $client->id) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-download"></i> تحميل
                                                </a>
                                                @else
                                                <a href="{{ asset('images/' . $client->professional_license) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-eye"></i> عرض الملف
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        <input class="form-control @error('professional_license') is-invalid @enderror"
                                            id="professional_license" name="professional_license" type="file">
                                        <small class="text-muted">اترك فارغاً للاحتفاظ بالملف الحالي</small>
                                        @error('professional_license')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- syndicate_card --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="syndicate_card">كارنية النقابه</label>
                                        @if($client->syndicate_card)
                                        <div class="mb-2">
                                            @if(isImageFile($client->syndicate_card))
                                            <img src="{{ asset('images/' . $client->syndicate_card) }}"
                                                alt="Current Card" class="img-thumbnail" width="120" height="120">
                                            @else
                                            <div class="file-display p-3 border rounded text-center"
                                                style="width: 120px; height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                <i
                                                    class="fa {{ getFileIcon($client->syndicate_card) }} fa-3x text-muted mb-2"></i>
                                                <small class="text-muted">{{ pathinfo($client->syndicate_card,
                                                    PATHINFO_EXTENSION) }}</small>
                                            </div>
                                            @endif
                                            <p class="text-muted">الملف الحالي</p>
                                            <div class="btn-group" role="group">
                                                @if(\Illuminate\Support\Str::endsWith(strtolower($client->syndicate_card),
                                                '.pdf'))
                                                <a href="{{ route('admin.admin.join-requests.download-syndicate-card', $client->id) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-download"></i> تحميل
                                                </a>
                                                @else
                                                <a href="{{ asset('images/' . $client->syndicate_card) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-eye"></i> عرض الملف
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        <input class="form-control @error('syndicate_card') is-invalid @enderror"
                                            id="syndicate_card" name="syndicate_card" type="file">
                                        <small class="text-muted">اترك فارغاً للاحتفاظ بالملف الحالي</small>
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
                                            value="{{old('organization_name', $client->organization_name)}}"
                                            type="text" placeholder="اسم المنظمه ">
                                        @error('organization_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عنوان المنظمه بالتفصيل</label>
                                        <input class="form-control" id="exampleInputEmail1" name="organization_address"
                                            value="{{old('organization_address', $client->organization_address)}}"
                                            type="text" placeholder="عنوان المنظمه بالتفصيل">
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
                                            name="organization_phone_first"
                                            value="{{old('organization_phone_first', $client->organization_phone_first)}}"
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
                                            value="{{old('organization_phone_second', $client->organization_phone_second)}}"
                                            type="text" placeholder="الرقم الثاني للمنظمه">
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
                                            name="organization_phone_third"
                                            value="{{old('organization_phone_third', $client->organization_phone_third)}}"
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
                                            value="{{old('organization_location_url', $client->organization_location_url)}}"
                                            type="text" placeholder="عنوان المنظمه على خريطة جوجل">
                                        @error('organization_location_url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Current Organization Photos Display --}}
                            @if($client->images && $client->images->count() > 0)
                            <div class="form-group">
                                <label>الصور الحالية للمنظمه</label>
                                <div class="row">
                                    @foreach($client->images as $image)
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

                            {{-- Add New Organization Photos --}}
                            <div class="form-group">
                                <label for="photo" class="form-label">إضافة صور جديدة للمنظمه</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                                    name="photo[]" multiple accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.txt">

                                @error('photo[]')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit">تحديث</button>
                                <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
