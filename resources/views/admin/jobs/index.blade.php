@extends('layouts.admin.app')
@section('title')
الوظائف
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>الوظائف </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('jobs')
            <li class="breadcrumb-item active"><a href="{{ route('admin.jobs.index') }}"
                    title="الوظائف">الوظائف</a></li>
            @endcan
        </ul>
    </div>
    @can('jobs.create')
    <div>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.jobs.create') }}"
            title="انشاء وظيفه جديده">انشاء وظيفه جديده</a>
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
                                <th>الوظيفه</th>
                                <th>الحالة</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $job->name }}</td>
                                <td>
                                    @can('jobs.edit')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            id="status_{{ $job->id }}" data-id="{{ $job->id }}" {{
                                            $job->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_{{ $job->id }}">
                                            <span class="status-text">{{ $job->is_active ? 'نشط' : 'غير نشط'
                                                }}</span>
                                        </label>
                                    </div>
                                    @else
                                    <span class="badge {{ $job->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $job->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                    @endcan
                                </td>
                                <td>
                                    @can('jobs.edit')
                                    <a class="btn btn-sm btn-dark"
                                        href="{{ route('admin.jobs.edit', $job) }}"
                                        title="تعديل">تعديل</a>
                                    @endcan
                                    @can('jobs.destroy')
                                    <form action="{{ route('admin.jobs.destroy', $job) }}"
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
            url: '{{ route("admin.jobs.toggleStatus", ":id") }}'.replace(':id', categoryId),
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
