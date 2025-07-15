<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">{{ auth('admin')->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth('admin')->user()->email }}</p>
        </div>
    </div>

    <ul class="app-menu">

        <li><a class="app-menu__item" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">الرئيسية</span></a></li>


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label"> المشرفين وصلاحياتهم</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('admins')
                <li><a class="treeview-item" href="{{ route('admin.admins.index') }}"><i
                            class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">المشرفين</span></a>
                </li>
                @endcan

                @can('roles')
                <li><a class="treeview-item" href="{{ route('admin.roles.index') }}"><i
                            class="app-menu__icon fa fa-user"></i>
                        <span class="app-menu__label">اوامر وصلاحيات</span></a></li>
                @endcan

            </ul>
        </li>


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label"> الاقسام</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('mainCategories')
                <li><a class="treeview-item" href="{{ route('admin.mainCategories.index') }}"><i
                            class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">الاقسام
                            الرئيسيه</span></a></li>
                @endcan
                @can('categories')
                <li><a class="treeview-item" href="{{ route('admin.categories.index') }}"><i
                            class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">الاقسام</span></a></li>
                @endcan
            </ul>
        </li>
        @can('brands')
        <li><a class="app-menu__item" href="{{ route('admin.brands.index') }}"><i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">الماركات</span></a></li>
        @endcan

        @can('ads')
        <li><a class="app-menu__item" href="{{ route('admin.ads.index') }}"><i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">الاعلانات</span></a></li>
        @endcan


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label"> الاعدادات
                    والسياسات</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('settings')
                <li><a class="treeview-item" href="{{ route('admin.settings.index') }}"><i
                            class="app-menu__icon fa fa-user"></i>
                        <span class="app-menu__label">الاعدادات</span></a></li>
                @endcan
                @can('terms')
                <li><a class="treeview-item" href="{{ route('admin.terms.index') }}"><i
                            class="app-menu__icon fa fa-user"></i>
                        <span class="app-menu__label">الشروط والاحكام </span></a></li>
                @endcan

                @can('about_us')
                <li><a class="treeview-item" href="{{ route('admin.about_us.index') }}"><i
                            class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">
                            عن المنظمة</span></a></li>
                @endcan
            </ul>
        </li>


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label"> التواصل</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('contact_us')
                <li><a class="treeview-item" href="{{ route('admin.contact_us.index') }}"><i
                            class="app-menu__icon fa fa-user"></i>
                        <span class="app-menu__label">رسائل المستخدمين او الزوار</span></a></li>
                @endcan
            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label"> البائعين والمحافظات
                </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                {{-- @can('governorate') --}}
                <li><a class="treeview-item" href="#"><i class="app-menu__icon fa fa-user"></i>
                        <span class="app-menu__label">المحافظات</span></a></li>
                {{-- @endcan --}}

            </ul>
        </li>

    </ul>
</aside>
