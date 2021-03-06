<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/images/icon.png') }}" width="32" class="img-fluid">
        </div>
        <div class="sidebar-brand-text">
            <img src="{{ asset('assets/images/logo-white.png') }}" class="img-fluid">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider mt-0">

  	<!-- Nav Item -->
    <li class="nav-item {{ Request::path() == 'admin' ? 'active' : '' }}">
        <a class="nav-link" href="/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ strpos(Request::url(), '/admin/profil') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/profil">
        <i class="fas fa-fw fa-user"></i>
        <span>Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Data</div>

  	<!-- Nav Item -->
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.company.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.company.index') }}">
		<i class="fas fa-fw fa-building"></i>
		<span>{{ __('company.name') }}</span></a>
	</li>
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.office.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.office.index') }}">
		<i class="fas fa-fw fa-home"></i>
		<span>{{ __('office.name') }}</span></a>
	</li>
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.position.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.position.index') }}">
		<i class="fas fa-fw fa-route"></i>
		<span>{{ __('position.name') }}</span></a>
	</li>
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.vacancy.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.vacancy.index') }}">
		<i class="fas fa-fw fa-bolt"></i>
		<span>{{ __('vacancy.name') }}</span></a>
	</li>
	<li class="nav-item {{ strpos(Request::url(), '/admin/seleksi') ? 'active' : '' }}">
		<a class="nav-link" href="/admin/seleksi">
		<i class="fas fa-fw fa-user-check"></i>
		<span>Seleksi</span>
		</a>
	</li>
	<li class="nav-item {{ strpos(Request::url(), '/admin/hasil') ? 'active' : '' }}">
		<a class="nav-link {{ strpos(Request::url(), '/admin/hasil') ? '' : '' }}" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Hasil Tes</span>
		</a>
		<div id="collapseTwo" class="collapse {{ strpos(Request::url(), '/admin/hasil') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Hasil Tes:</h6>
                <a class="collapse-item {{ strpos(Request::url(), '/admin/hasil/karyawan') ? 'active' : '' }}" href="/admin/hasil/karyawan">Karyawan</a>
                <a class="collapse-item {{ strpos(Request::url(), '/admin/hasil/pelamar') ? 'active' : '' }}" href="/admin/hasil/pelamar">Pelamar</a>
                @if(Auth::user()->role->id == role('admin'))
                <a class="collapse-item {{ strpos(Request::url(), '/admin/hasil/magang') ? 'active' : '' }}" href="/admin/hasil/magang">Magang</a>
                @endif
            </div>
		</div>
	</li>
  
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">User</div>

    <!-- Nav Item -->
    @if(Auth::user()->role->id == role('admin'))
    <li class="nav-item {{ strpos(Request::url(), '/admin/list') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/list">
        <i class="fas fa-fw fa-user-secret"></i>
        <span>Admin</span></a>
    </li>
    <li class="nav-item {{ strpos(Request::url(), '/admin/hrd') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/hrd">
        <i class="fas fa-fw fa-user-shield"></i>
        <span>HRD</span></a>
    </li>
    @endif
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.employee.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.employee.index') }}">
		<i class="fas fa-fw fa-user-cog"></i>
		<span>{{ __('employee.name') }}</span></a>
	</li>
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.applicant.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.applicant.index') }}">
		<i class="fas fa-fw fa-user-tie"></i>
		<span>{{ __('applicant.name') }}</span></a>
	</li>
    @if(Auth::user()->username == 'ajifatur')
        <li class="nav-item {{ strpos(Request::url(), '/admin/umum') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/umum">
            <i class="fas fa-fw fa-users"></i>
            <span>Umum</span></a>
        </li>
    @endif
  
    @if(Auth::user()->role->id == role('admin'))

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Master</div>

    <!-- Nav Item -->
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.role.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.role.index') }}">
		<i class="fas fa-fw fa-key"></i>
		<span>{{ __('role.name') }}</span></a>
	</li>
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.test.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.test.index') }}">
		<i class="fas fa-fw fa-clipboard"></i>
		<span>{{ __('test.name') }}</span></a>
	</li>
	<li class="nav-item {{ is_int(strpos(Request::url(), route('admin.religion.index'))) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('admin.religion.index') }}">
		<i class="fas fa-fw fa-mosque"></i>
		<span>{{ __('religion.name') }}</span></a>
	</li>
    @endif  

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->