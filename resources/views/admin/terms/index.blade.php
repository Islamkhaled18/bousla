@extends('layouts.admin.app')
@section('title')
الشروط والحكام
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> الشروط والحكام </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"></a>
            </li>
            @can('terms')
            <li class="breadcrumb-item active"><a href="{{ route('admin.terms.index') }}" title="الشروط والاحكام">الشروط
                    والاحكام</a></li>
            @endcan
        </ul>
    </div>
    @can('terms.create')
    <div>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.terms.create') }}" title="انشاء شروط واحكام جديده">انشاء
            شروط واحكام جديده</a>
    </div>
    @endcan

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>/</th>
                                <th>محتوى الشروط والاحكام</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($terms as $term)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{!! $term->name !!}</td>

                                <td>
                                    <a class="btn btn-sm btn-dark"
                                        href="{{ route('admin.terms.edit', $term) }}"
                                        title="تعديل">تعديل</a>

                                    <form action="{{ route('admin.terms.destroy', $term) }}" title="حذف"
                                        method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="'submit" class="btn btn-danger delete btn-sm"><i
                                                class="fa fa-trash"></i>حذف</button>

                                    </form>

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
