@extends('layouts.admin.app')
@section('title')
العملاء
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> العملاء </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('clients')
            <li class="breadcrumb-item active"><a href="{{ route('admin.clients.index') }}" title="العملاء">العملاء</a>
            </li>
            @endcan
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الايميل</th>
                                <th>موقعه على خريطة جوجل</th>
                                <th>الصوره</th>
                                <th>اللوجو</th>
                                <th>الحالة</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($join_requests as $join_request)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $join_request->name }}</td>
                                <td>{{ $join_request->email }}</td>
                                <td>
                                    <a href="{{ $join_request->organization_location_url }}" target="_blank">
                                        عرض الموقع
                                    </a>
                                </td>
                                <td><img src="{{ $join_request->image_url }}" title="{{ $join_request->name }}"
                                        alt="{{ $join_request->name }}" width="60" height="60">
                                </td>
                                <td><img src="{{ $join_request->logo_url }}" title="{{ $join_request->name }}"
                                        alt="{{ $join_request->name }}" width="60" height="60">
                                </td>
                                <td>
                                    @can('clients.edit')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            id="status_{{ $join_request->id }}" data-id="{{ $join_request->id }}" {{
                                            $join_request->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_{{ $join_request->id }}">
                                            <span class="status-text">{{ $join_request->is_active ? 'نشط' : 'غير نشط'
                                                }}</span>
                                        </label>
                                    </div>
                                    @else
                                    <span class="badge {{ $join_request->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $join_request->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                    @endcan
                                </td>
                                <td>
                                    @can('clients.edit')
                                    <a class="btn btn-sm btn-dark"
                                        href="{{ route('admin.clients.edit', $join_request) }}" title="تعديل">تعديل</a>
                                    @endcan
                                    @can('clients')
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('admin.clients.show', $join_request) }}"
                                        title="مراجعه">مراجعه</a>
                                    @endcan
                                    @can('clients.destroy')
                                    <form action="{{ route('admin.clients.destroy', $join_request) }}" title="حذف"
                                        method="post" style="display: inline-block">
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
            url: '{{ route("admin.clients.toggleStatus", ":id") }}'.replace(':id', categoryId),
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
