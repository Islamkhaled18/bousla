@extends('layouts.admin.app')
@section('title')
صور الاعلانات
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> صور الاعلانات </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('ads')
            <li class="breadcrumb-item active"><a href="{{ route('admin.ads.index') }}" title="صور الاعلانات">صور
                    الاعلانات</a></li>
            @endcan
        </ul>
    </div>
    @can('ads.create')
    <div>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.ads.create') }}" title="انشاء صورة اعلان جديده">انشاء
            صورة
            اعلان جديده</a>
    </div>
    @endcan

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الاعلان</th>
                                <th>صورة الاعلان</th>
                                <th>الماركه</th>
                                <th>الحاله</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ads as $ad)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ad->name }}</td>
                                <td><img src="{{ $ad->image_url }}" title="{{ $ad->name }}" alt="{{ $ad->name }}"
                                        width="60" height="60">
                                </td>
                                <th>{{ $ad->brand->name ?? '--' }}</th>

                                <td>
                                    @can('ads.edit')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            id="status_{{ $ad->id }}" data-id="{{ $ad->id }}" {{ $ad->is_active ?
                                        'checked' : '' }}>
                                        <label class="form-check-label" for="status_{{ $ad->id }}">
                                            <span class="status-text">{{ $ad->is_active ? 'نشط' : 'غير نشط'
                                                }}</span>
                                        </label>
                                    </div>
                                    @else
                                    <span class="badge {{ $ad->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $ad->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                    @endcan
                                </td>

                                <td>
                                    @can('ads.edit')
                                    <a class="btn btn-sm btn-dark" title="تعديل"
                                        href="{{ route('admin.ads.edit', $ad) }}">تعديل</a>
                                    @endcan
                                    @can('ads.edit')
                                    <form action="{{ route('admin.ads.destroy', $ad) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="'submit" title="حذف" class="btn btn-danger delete btn-sm"><i
                                                class="fa fa-trash"></i>حذف</button>

                                    </form>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#sampleTable').DataTable();

     $('.status-toggle').change(function() {
        let checkbox = $(this);
        let categoryId = checkbox.data('id');
        let isActive = checkbox.is(':checked') ? 1 : 0;

        checkbox.prop('disabled', true);

        $.ajax({
            url: '{{ route("admin.ads.toggleStatus", ":id") }}'.replace(':id', categoryId),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                is_active: isActive
            },
            success: function(response) {
                if (response.success) {

                    location.reload();
                } else {

                    checkbox.prop('checked', !isActive);
                    checkbox.prop('disabled', false);
                }
            },
            error: function(xhr) {

                checkbox.prop('checked', !isActive);
                checkbox.prop('disabled', false);
            }
        });
    });

</script>
<!-- Google analytics script-->
<script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o)
                , m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }

</script>
@endpush
