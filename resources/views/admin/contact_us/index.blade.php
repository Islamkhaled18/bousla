@extends('layouts.admin.app')
@section('title')
تواصل معنا
@endsection
@section('content')
<main class="app sidebar-mini rtl">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> تواصل معنا </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.dashboard') }}"
                    title="الرئيسية"></a></li>
            @can('contact_us')
            <li class="breadcrumb-item active"><a href="{{ route('admin.contact_us.index') }}" title="تواصل معنا">تواصل
                    معنا</a>
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
                                <th>البريد الالكتروني</th>
                                <th>الهاتف</th>
                                <th>عنوان الرساله</th>
                                <th>محتوى الرساله</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact_us as $contact_u)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $contact_u->name }}</td>
                                <td>{{ $contact_u->email }}</td>
                                <td>{{ $contact_u->phone }}</td>
                                <td>{{ $contact_u->subject}}</td>
                                <td>{{ $contact_u->message }}</td>
                                <td>

                                    @can('contact_us.destroy')
                                    <form action="{{ route('admin.contact_us.destroy', $contact_u) }}" title="حذف"
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
