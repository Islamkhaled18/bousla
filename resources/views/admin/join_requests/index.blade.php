@extends('layouts.admin.app')
@section('title')
طلبات الانضمام
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
            <li class="breadcrumb-item active"><a href="{{ route('admin.join-requests.index') }}"
                    title="طلبات الانضمام">طلبات الانضمام</a></li>
            @endcan
        </ul>
    </div>
    @can('join_requests.create')
    <div>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.join-requests.create') }}"
            title="انشاء طلب الانضمام">انشاء طلب الانضمام</a>
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
                                    @can('join_requests.approval')
                                    <select class="form-control status-dropdown" data-id="{{ $join_request->id }}" style="width: 120px;">
                                        <option value="pending" {{ ($join_request->status ?? 'pending') == 'pending' ? 'selected' : '' }}>
                                            في الانتظار
                                        </option>
                                        <option value="approved" {{ ($join_request->status ?? '') == 'approved' ? 'selected' : '' }}>
                                            مقبول
                                        </option>
                                        <option value="rejected" {{ ($join_request->status ?? '') == 'rejected' ? 'selected' : '' }}>
                                            مرفوض
                                        </option>
                                    </select>
                                    @else
                                    <span class="badge badge-{{
                                        ($join_request->status ?? 'pending') == 'approved' ? 'success' :
                                        (($join_request->status ?? 'pending') == 'rejected' ? 'danger' : 'warning')
                                    }}">
                                        {{
                                            ($join_request->status ?? 'pending') == 'approved' ? 'مقبول' :
                                            (($join_request->status ?? 'pending') == 'rejected' ? 'مرفوض' : 'في الانتظار')
                                        }}
                                    </span>
                                    @endcan
                                </td>

                                <td>
                                    @can('join_requests.edit')
                                    <a class="btn btn-sm btn-dark"
                                        href="{{ route('admin.join-requests.edit', $join_request) }}"
                                        title="تعديل">تعديل</a>
                                    @endcan
                                    @can('join_requests')
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('admin.join-requests.show', $join_request) }}"
                                        title="مراجعه">مراجعه</a>
                                    @endcan
                                    @can('join_requests.destroy')
                                    <form action="{{ route('admin.join-requests.destroy', $join_request) }}" title="حذف"
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

    $('.status-dropdown').on('change', function() {
    const id = $(this).data('id');
    const status = $(this).val();
    const dropdown = $(this);

    $.ajax({
        url: `/admin/join-requests/${id}/update-status`,
        type: 'POST',
        data: {
            status: status,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {

                {{--  toastr.success(response.message);  --}}

                // Reload page if status is approved or rejected
                if (status === 'approved' || status === 'rejected') {
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {

                    const row = dropdown.closest('tr');
                    row.removeClass('table-warning table-success table-danger');
                    row.addClass('table-warning');
                }
            } else {
                console.log(response);
            }
        },
        error: function(xhr) {
            toastr.error('حدث خطأ أثناء تحديث الحالة');

            dropdown.val(dropdown.data('previous-value'));
        }
    });

    dropdown.data('previous-value', status);
});

// Store initial values
$('.status-dropdown').each(function() {
    $(this).data('previous-value', $(this).val());
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
