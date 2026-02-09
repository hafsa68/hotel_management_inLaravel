<div class="card">
    <div class="card-body">
        <div class="text-center mb-3">
            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                 style="width: 80px; height: 80px;">
                <i class="fas fa-user fa-2x text-white"></i>
            </div>
            <h5 class="mt-2">{{ Auth::user()->name }}</h5>
            <p class="text-muted">{{ Auth::user()->email }}</p>
        </div>
        
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('user.bookings') }}" class="text-decoration-none">
                    <i class="fas fa-calendar-alt me-2"></i> My Bookings
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('dashboard.profile') }}" class="text-decoration-none">
                    <i class="fas fa-user me-2"></i> Profile
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('logout') }}" class="text-decoration-none text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>