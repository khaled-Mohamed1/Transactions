<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="
width: 20rem !important;position: relative">

    <div style="position: sticky;top: 0">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-university"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Tech-Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active ">
            <a class="nav-link text-right" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt" ></i>
                <span>لوحة التحكم</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading text-right text-white h3" style="font-size: 1.3rem">
            تحكم
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed text-right" href="#" data-toggle="collapse" data-target="#taTpDropDown"
               aria-expanded="true" aria-controls="taTpDropDown">
                <span>تحكم بالموظفين</span>
                <i class="fas fa-user-alt"></i>
            </a>
            <div id="taTpDropDown" class="collapse text-right" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded" >
                    <h6 class="collapse-header">تحكم بالموظفين:</h6>
                    <a class="collapse-item" href="{{ route('users.index') }}">بيانات</a>
                    <a class="collapse-item" href="{{ route('users.create') }}">اضافة جديد</a>
                    {{--                <a class="collapse-item" href="{{ route('users.import') }}">Import Data</a>--}}
                </div>
            </div>
        </li>

        {{--    customer--}}
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading text-right text-right text-white" style="font-size: 1.3rem">
            عملاء
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item text-right">
            <a class="nav-link collapsed text-right" href="#" data-toggle="collapse" data-target="#customer"
               aria-expanded="true" aria-controls="taTpDropDown">
                <span>تحكم بالعملاء</span>
                <i class="fas fa-user-alt"></i>
            </a>
            <div id="customer" class="collapse text-right" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">تحكم بالعملاء:</h6>
                    <a class="collapse-item" href="{{ route('customers.index.customers') }}">جميع العملاء</a>
                    <a class="collapse-item" href="{{ route('customers.index') }}">بيانات العملاء الجدد</a>
                    <a class="collapse-item" href="{{ route('customers.index.task') }}">العملاء المقبولين (المهام)</a>
                    <a class="collapse-item" href="{{ route('customers.index.adverser') }}">العملاء المتعسرين</a>
                    <a class="collapse-item" href="{{ route('customers.index.committed') }}">العملاء الملتزمين</a>
                    <a class="collapse-item" href="{{ route('customers.index.rejected') }}">العملاء المرفوضين</a>
                    <a class="collapse-item" href="{{ route('customers.index.follow') }}">المتابعة</a>
                    {{--                <a class="collapse-item" href="{{ route('users.create') }}">Add New</a>--}}
{{--                    <a class="collapse-item" href="{{ route('customers.import') }}">استيراد بيانات</a>--}}
                </div>
            </div>
        </li>

        {{--    customer--}}
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading text-right text-right text-white" style="font-size: 1.3rem">
            اضافات
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed text-right" href="#" data-toggle="collapse" data-target="#Transaction"
               aria-expanded="true" aria-controls="taTpDropDown">
                <span>تحكم بالإضافات</span>
                <i class="fas fa-exchange-alt"></i>
            </a>
            <div id="Transaction" class="collapse text-right" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">تحكم بالإضافات:</h6>
                    <a class="collapse-item" href="{{route('transactions.index')}}">المعاملات</a>
                    <a class="collapse-item" href="{{ route('drafts.index') }}">كمببالات</a>
                    <a class="collapse-item" href="{{ route('issues.index') }}">قضايا</a>
                    <a class="collapse-item" href="{{ route('stores.index') }}">المخازن</a>
                    {{--                <a class="collapse-item" href="{{ route('users.import') }}">Import Data</a>--}}
{{--                    <a class="collapse-item" href="{{ route('drafts.import') }}">استيراد بيانات كمبيالات</a>--}}
{{--                    <a class="collapse-item" href="{{ route('issues.import') }}">استيراد بيانات قضايا</a>--}}


                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        @hasrole('Admin')
        <!-- Heading -->
        <div class="sidebar-heading text-right text-right text-white" style="font-size: 1.3rem">
            قسم المدير
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed text-right" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true" aria-controls="collapsePages">
                <span>سيد</span>
                <i class="fas fa-fw fa-folder"></i>
            </a>
            <div id="collapsePages" class="collapse text-right" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">وظائف و الصلاحيات</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">الوظائف</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">الصلاحيات</a>
                    <a class="collapse-item" href="{{ route('banks.index') }}">البنوك</a>
                    <a class="collapse-item" href="{{ route('jobs.index') }}">وظائف العملاء</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        @endhasrole

        @hasrole('المدير العام')
        <!-- Heading -->
        <div class="sidebar-heading text-right text-right text-white" style="font-size: 1.3rem">
            قسم المدير
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed text-right" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true" aria-controls="collapsePages">
                <span>سيد</span>
                <i class="fas fa-fw fa-folder"></i>
            </a>
            <div id="collapsePages" class="collapse text-right" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">وظائف و الصلاحيات</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">الوظائف</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">الصلاحيات</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        @endhasrole

        <li class="nav-item ">
            <a class="nav-link text-right" href="#" data-toggle="modal" data-target="#logoutModal">
                <span>تسجيل خروج</span>
                <i class="fas fa-sign-out-alt"></i>

            </a>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->
        {{--    <div class="text-center d-none d-md-inline">--}}
        {{--        <button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
        {{--    </div>--}}
    </div>



</ul>
