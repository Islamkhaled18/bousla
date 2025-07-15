@extends('layouts.admin.app')
@section('title')
الاقسام الرئيسية
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> الاقسام الرئيسية </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('mainCategories')
            <li class="breadcrumb-item active"><a href="{{ route('admin.mainCategories.index') }}"
                    title="الاقسام الرئيسية">الاقسام الرئيسية</a></li>
            @endcan
        </ul>
    </div>
    @can('mainCategories.create')
    <div>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.mainCategories.create') }}"
            title="انشاء قسم رئيسي">انشاء قسم
            رئيسي</a>
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
                                <th>الاسم</th>
                                <th>الصوره</th>
                                <th>الحالة</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mainCategories as $mainCategory)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mainCategory->name }}</td>
                                <td><img src="{{ $mainCategory->image_url }}" title="{{ $mainCategory->name }}"
                                        alt="{{ $mainCategory->name }}" width="60" height="60">
                                </td>
                                <td>
                                    @can('mainCategories.edit')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            id="status_{{ $mainCategory->id }}" data-id="{{ $mainCategory->id }}" {{
                                            $mainCategory->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_{{ $mainCategory->id }}">
                                            <span class="status-text">{{ $mainCategory->is_active ? 'نشط' : 'غير نشط'
                                                }}</span>
                                        </label>
                                    </div>
                                    @else
                                    <span class="badge {{ $mainCategory->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $mainCategory->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                    @endcan
                                </td>
                                <td>
                                    @can('mainCategories.edit')
                                    <a class="btn btn-sm btn-dark"
                                        href="{{ route('admin.mainCategories.edit', $mainCategory) }}"
                                        title="تعديل">تعديل</a>
                                    @endcan
                                    @can('mainCategories.destroy')
                                    <form action="{{ route('admin.mainCategories.destroy', $mainCategory) }}"
                                        title="حذف" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="'submit" class="btn btn-danger delete btn-sm"><i
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
            url: '{{ route("admin.mainCategories.toggleStatus", ":id") }}'.replace(':id', categoryId),
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
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>

@endpush
