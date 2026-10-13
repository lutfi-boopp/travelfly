<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Portal - TravelFly</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/assets/admin-viTrFQkC.css') }}">
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="admin-body">

    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand-icon">✈️</div>
                <div class="sidebar-brand-text">
                    <h2>TravelFly</h2>
                    <span>Admin Portal</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="sidebar-nav-title">Main Menu</div>
                
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
                    <span>Dashboard</span>
                </a>

                <div class="sidebar-nav-title">Management</div>

                <a href="{{ route('admin.flights.index') }}" class="{{ request()->routeIs('admin.flights.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    <span>Flights</span>
                </a>

                <a href="{{ route('admin.airlines.index') }}" class="{{ request()->routeIs('admin.airlines.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.8 19.2L16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.3c.4-.2.6-.6.5-1.1z"/></svg>
                    <span>Airlines</span>
                </a>

                <a href="{{ route('admin.bookings.index') }}" class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    <span>Bookings</span>
                </a>

                <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    <span>Payments</span>
                </a>
            </nav>

            <!-- Sidebar User & Footer -->
            <div class="sidebar-footer">
                <div class="sidebar-user-card">
                    <div class="sidebar-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="sidebar-user-role">Administrator</div>
                    </div>
                </div>

                <div class="sidebar-actions">
                    <a href="{{ route('home') }}" target="_blank" title="View Public Website">
                        <span>🌐 Web</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="flex: 1; margin: 0;">
                        @csrf
                        <button type="submit" style="width: 100%;" title="Sign out from admin">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <main class="admin-main">
            <header class="admin-header">
                <div class="admin-header-title">
                    <span class="admin-header-breadcrumb">TravelFly / Portal</span>
                    <h1>@yield('header', 'Dashboard')</h1>
                </div>

                <div class="admin-header-right">
                    <div class="status-pill">
                        <span class="status-dot"></span>
                        <span>System Live</span>
                    </div>
                </div>
            </header>

            <div class="admin-content">
                @if (session('success'))
                    <div class="alert alert-success">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Dropdown menu handler for action buttons
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.action-dropdown')) {
                document.querySelectorAll('.action-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                });
            }

            const toggleBtn = e.target.closest('.btn-icon');
            if (toggleBtn) {
                const dropdown = toggleBtn.nextElementSibling;
                const isShowing = dropdown.classList.contains('show');
                
                document.querySelectorAll('.action-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                });
                
                if (!isShowing) {
                    dropdown.classList.add('show');
                }
            }
        });
    </script>
</body>
</html>
