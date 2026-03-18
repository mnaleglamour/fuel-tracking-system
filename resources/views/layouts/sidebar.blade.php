<style>
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: var(--primary-navy);
    padding: 0;
    color: #e5e7eb;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    transition: all 0.3s;
}

.sidebar-header {
    padding: 25px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
}

.sidebar-header h2 {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.sidebar-header h2 i {
    color: var(--accent-blue);
    font-size: 24px;
}

.sidebar-nav {
    flex: 1;
    overflow-y: auto;
    padding: 20px 0;
}

.sidebar-nav::-webkit-scrollbar {
    width: 6px;
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}

.nav-item {
    margin: 0 12px 8px 12px;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: #cbd5e1;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s;
    font-weight: 500;
    font-size: 14px;
}

.nav-link i {
    font-size: 18px;
    width: 24px;
    text-align: center;
}

.nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    transform: translateX(4px);
}

.nav-link.active {
    background: var(--accent-blue);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.sidebar-footer {
    padding: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.user-info {
    padding: 12px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    margin-bottom: 12px;
}

.user-info p {
    margin: 0;
    font-size: 13px;
    color: #94a3b8;
}

.user-info strong {
    color: #ffffff;
    font-size: 14px;
}

.logout-btn {
    width: 100%;
    background: rgba(220, 38, 38, 0.1);
    border: 1px solid rgba(220, 38, 38, 0.3);
    color: #fca5a5;
    font-weight: 600;
    cursor: pointer;
    padding: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    border-radius: 8px;
    transition: all 0.2s;
    font-size: 14px;
}

.logout-btn:hover {
    background: var(--danger-red);
    border-color: var(--danger-red);
    color: #ffffff;
}

.mobile-toggle {
    display: none;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1100;
    background: var(--primary-navy);
    color: white;
    border: none;
    padding: 12px 16px;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .mobile-toggle {
        display: block;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .overlay.active {
        display: block;
    }
}
</style>

<button class="mobile-toggle" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
</button>

<div class="overlay" onclick="toggleSidebar()"></div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>
            <i class="bi bi-speedometer2"></i>
            Sales Tracking
        </h2>
    </div>

    <div class="sidebar-nav">
        <div class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Dashboard</span>
            </a>
        </div>

        @if(Auth::user()->isAdmin())
            <div class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Attendants</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.pumps.index') }}" class="nav-link {{ request()->routeIs('admin.pumps.*') ? 'active' : '' }}">
                    <i class="bi bi-fuel-pump"></i>
                    <span>Pumps</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.govcap.upload') }}" class="nav-link {{ request()->routeIs('admin.govcap.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-excel"></i>
                    <span>CAP Prices</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('shifts.index') }}" class="nav-link {{ request()->routeIs('shifts.*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    <span>Shifts</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('sales.index') }}" class="nav-link {{ request()->routeIs('sales.index') ? 'active' : '' }}">
                    <i class="bi bi-graph-up"></i>
                    <span>All Sales</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('sales.download') }}" class="nav-link {{ request()->routeIs('sales.download') ? 'active' : '' }}">
                    <i class="bi bi-download"></i>
                    <span>Download Sales</span>
                </a>
            </div>
        @endif

        @if(Auth::user()->isAttendant())
            <div class="nav-item">
                <a href="{{ route('sales.create') }}" class="nav-link {{ request()->routeIs('sales.create') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i>
                    <span>Record Sale</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('shifts.index') }}" class="nav-link {{ request()->routeIs('shifts.*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    <span>My Shifts</span>
                </a>
            </div>
        @endif
    </div>

    <div class="sidebar-footer">
        <div class="user-info">
            <p>Logged in as</p>
            <strong>{{ Auth::user()->name }}</strong>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.querySelector('.overlay');
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
}
</script>
