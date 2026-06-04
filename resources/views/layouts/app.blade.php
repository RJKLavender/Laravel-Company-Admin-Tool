<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Company Admin Tool'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://bunny.net" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

<style>
/* Custom Theme Styling over the top of Bootstrap */
/* Base Styling */
:root {
    --bg-dark-grey: #121214;
    --bg-card-grey: #1e1e24;
    --purple-primary: #8b5cf6;
    --purple-hover: #7c3aed;
    --purple-accent: #f472b6;
    --text-main: #f8fafc;
    --text-muted: #e2e8f0;
}

body {
    background-color: var(--bg-dark-grey);
    color: var(--text-main);
    min-height: 100vh;
}

/* Navigation Styling  */
.navbar-nav .nav-link {
    color: var(--text-muted) !important;
    font-weight: 500;
    position: relative;
    transition: color 0.15s ease-in-out;
    padding-bottom: 6px !important;
}

/* Smooth Underline Hover Effect for Desktop  */
@media (min-width: 768px) {

    /* Added :not(.btn-purple) here to stop it from underlining the login button */
    .navbar-nav .nav-link:not(#navbarDropdown):not(.btn-purple)::after {
        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: var(--purple-primary);
        transform-origin: bottom left;
        transition: transform 0.15s ease-in-out;
    }

    .navbar-nav .nav-link:not(#navbarDropdown):not(.btn-purple):hover::after {
        transform: scaleX(1);
    }

    .navbar-nav .nav-link.active::after {
        transform: scaleX(1);
        background-color: var(--purple-primary);
    }
}

/* Hover and Active Text Colours for Navbar */
.navbar-nav .nav-link:hover {
    color: #ffffff !important;
}
.navbar-nav .nav-link.active {
    color: #ffffff !important;
    font-weight: 700 !important;
}

/* Admin User Drop Down Menu Styling */
#navbarDropdown:hover {
    color: #ffffff !important;
    border-color: var(--purple-primary) !important;
}

.admin-user-nav-item {
    position: relative !important;
}

.dropdown-menu-dark-custom {
    background-color: var(--bg-card-grey) !important;
    opacity: 1 !important;
    border: 1px solid rgba(139, 92, 246, 0.3) !important;
    padding: 0.6rem 0 !important; /* Vertical spacing inside the box */
    
    /* These lines lock the width to the parent button */
    width: 100% !important; 
    min-width: 100% !important;
    left: 0 !important;
    right: 0 !important;
    
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5) !important;
}

/* Logout Link Styling */
.dropdown-menu-dark-custom .logout-link {
    color: var(--text-muted) !important;
    display: inline-block !important; 
    width: auto !important; /* Keeps the underline strictly under the text */
    background: transparent !important;
    padding: 0 !important;
    position: relative;
    text-decoration: none;
    transition: color 0.15s ease-in-out;
}

.dropdown-menu-dark-custom .logout-link:hover {
    color: #ffffff !important;
}

/* Underline matching the text length */
.dropdown-menu-dark-custom .logout-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: var(--purple-primary);
    transform: scaleX(0);
    transform-origin: bottom left;
    transition: transform 0.15s ease-in-out;
}

.dropdown-menu-dark-custom .logout-link:hover::after {
    transform: scaleX(1);
}

/* Responsive Styling  */
@media (max-width: 767.98px) {
    // Added :not(.btn-purple) here too 
    .navbar-nav .nav-link:not(#navbarDropdown):not(.btn-purple) {
        padding-left: 12px !important;
        margin-bottom: 4px;
    }

    .navbar-nav .nav-link:not(#navbarDropdown):not(.btn-purple):hover, 
    .navbar-nav .nav-link.active {
        border-left: 3px solid var(--purple-primary);
    }
}

/* Button Styling */
.btn-purple {
    background-color: var(--purple-primary);
    color: white !important;
    border: none;
    transition: background-color 0.15s ease-in-out;
    font-size: 1rem;
}

.btn-purple:hover {
    background-color: #6d28d9 !important;
    color: white !important;
}

/* Hamburger styling for phones */
.navbar-toggler {
    border-color: rgba(139, 92, 246, 0.4) !important;
    padding: 0.6rem !important;
    
    display:flex;
    align-items: center !important;
    justify-content: center !important;
    width: 44px !important;
    height: 40px !important;
    background: transparent !important;
    outline: 1px solid var(--purple-primary) !important;
}

.navbar-toggler-icon {
    background-image: none !important;
    width: 24px !important;           
    height: 14px !important;          
    display: inline-block !important;
   
    background: linear-gradient(
        to bottom,
        #ffffff 0px, #ffffff 1px,      
        transparent 2px, transparent 6px, 
        #ffffff 6px, #ffffff 7px,      
        transparent 8px, transparent 12px, 
        #ffffff 12px, #ffffff 13px    
    ) !important;
    
    filter: none !important;
}

.navbar-toggler:focus {
    outline: 3px solid var(--purple-primary) !important;
    box-shadow: none !important;
    border-color: var(--purple-primary) !important;
}


.navbar-toggler:active {
    background-color: rgba(139, 92, 246, 0.1) !important;
    transform: scale(0.98); 
}

/* Login Page Styling */
.login-card {
    background-color: var(--bg-card-grey) !important;
    border: 1px solid rgba(139, 92, 246, 0.2);
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
}

.login-header {
    background-color: rgba(139, 92, 246, 0.1) !important;
    color: var(--purple-primary);
    font-weight: 700;
    border-bottom: 1px solid rgba(139, 92, 246, 0.1);
    border-top-left-radius: 12px !important;
    border-top-right-radius: 12px !important;
    font-size: 1.6rem;
}

/* Universal Form Styling */
.form-label {
    color: var(--text-muted);
    font-weight: 700;
    font-size: 1.2rem;
}

.form-container-card {
    background-color: var(--bg-card-grey) !important;
    border: 1px solid rgba(139, 92, 246, 0.15) !important;
    border-radius: 12px;
}

.form-control-dark {
    background-color: var(--bg-dark-grey) !important;
    border: 1px solid #3f3f46 !important;
    color: white !important;
    padding: 0.75rem;
    border-radius: 8px;
}

.form-control-dark:focus {
    border-color: var(--purple-primary) !important;
    box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25) !important;
    outline: none;
}

.forgot-link {
    color: var(--text-muted);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.15s;
}

.forgot-link:hover {
        color: var(--purple-primary);
}

    input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active {
    -webkit-box-shadow: 0 0 0 1000px var(--bg-dark-grey) inset !important;
    -webkit-text-fill-color: white !important;
    transition: background-color 5000s ease-in-out 0s;
}

.form-control {
    /* Medium-dark charcoal (Lighter than background, darker than slate) */
    background-color: #334155 !important; 
    border: 1px solid #475569 !important;
    /* High-contrast white text for maximum readability */
    color: #ffffff !important; 
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: all 0.2s ease-in-out;
}

.form-control:focus {
    background-color: #1e293b !important; /* Dips darker on focus for depth */
    border-color: var(--purple-primary) !important;
    box-shadow: 0 0 0 0.3rem rgba(139, 92, 246, 0.3) !important;
    color: #ffffff !important;
}

input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px #334155 inset !important;
    -webkit-text-fill-color: #ffffff !important;
}

::placeholder {
    color: #94a3b8 !important;
    opacity: 0.8;
}

/* Home Page Styling */
.dashboard-card {
    background-color: var(--bg-card-grey) !important;
    border: 1px solid rgba(139, 92, 246, 0.15) !important;
}
  
.dashboard-header {
    background-color: rgba(139, 92, 246, 0.05) !important;
    color: var(--purple-primary) !important;
    border-bottom: 1px solid rgba(139, 92, 246, 0.1) !important;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding-left: 50px;
}

/* this box handles the counts of employees and companies on home page */
.metric-box {
    background-color: var(--bg-dark-grey) !important;
    border: 1px solid rgba(139, 92, 246, 0.15) !important;
    border-radius: 12px;
    transition: transform 0.2s ease;
}

.metric-box:hover {
    transform: translateY(-3px);
    border-color: var(--purple-primary) !important;
}

.btn-metric-primary {
    background-color: #0d6efd !important;
    color: #ffffff !important;
    border: none;
    font-weight: 700;
    box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    font-size: 1rem;
}

.btn-metric-primary:hover {
    background-color: #0a58ca;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.btn-metric-success {
    background-color: #198754 !important;
    color: #ffffff !important;
    border: none;
    font-weight: 700;
    box-shadow: 0 4px 10px rgba(25, 135, 84, 0.2);
    font-size: 1rem;
}

.btn-metric-success:hover {
    background-color: #157347;
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
}

/* Universal Table Styling */
.hr-muted {
    border-color: rgba(255, 255, 255, 0.1) !important;
    opacity: 1;
}

.table-dark-custom {
    --bs-table-bg: var(--bg-card-grey) !important;
    --bs-table-hover-bg: #26262e !important;
    --bs-table-color: var(--text-muted) !important;
    border-collapse: separate;
    border-spacing: 0 6px; /* Clean gap row separation spacing */
}

.table-dark-custom thead th {
    background-color: rgba(139, 92, 246, 0.08) !important;
    color: var(--purple-primary);
    border: none;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 1px;
    padding: 1.1rem 1rem;
    text-align:center;
    font-size: 1.1rem;
    font-weight: 600;
}

.table-dark-custom tbody tr {
    background-color: var(--bg-card-grey);
    transition: transform 0.15s ease-in-out, background-color 0.15s;
}

.company-logo-frame {
    width:150px;
    height:150px;
    border-radius:10px;
}

.table-dark-custom td {
    color: var(--text-muted);
    padding: 1.1rem 1rem;
    vertical-align: middle;
    border-top: 1px solid rgba(255, 255, 255, 0.04);
    border-bottom: 1px solid rgba(255, 255, 255, 0.04);
    font-size: 1rem;
    text-align: center;
}

/* Profile Pages Styling */
.profile-link {
    color: var(--text-main) !important;
    text-decoration: none;
    transition: color 0.15s ease;
}

.profile-link:hover {
    color: var(--purple-primary) !important;
    text-decoration: underline !important;
}

.profile-header-card {
    background-color: var(--bg-card-grey) !important;
    border: 1px solid rgba(139, 92, 246, 0.15) !important;
    border-radius: 12px;
}

.profile-logo-bubble {
    width: 96px;
    height: 96px;
    object-fit: cover;
    border-radius: 10px;
    border: 3px solid rgba(139, 92, 246, 0.25);
    background-color: var(--bg-dark-grey);
}

.profile-logo-placeholder {
    width: 96px;
    height: 96px;
    border-radius: 10px;
    border: 3px dashed rgba(255, 255, 255, 0.1);
    background-color: var(--bg-dark-grey);
    color: var(--text-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Action Links Layout configuration */
.action-link {
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.15s;
    font-size: 1.05rem;
}

.action-link:hover {
    text-decoration: underline !important;
    opacity: 0.85;
}

/* Dark Theme Pagination Overrides */
.pagination .page-link {
    background-color: var(--bg-card-grey) !important;
    border-color: #2d2d35 !important;
    color: var(--text-muted) !important;
}

.pagination .page-item.active .page-link {
    background-color: var(--purple-primary) !important;
    border-color: var(--purple-primary) !important;
    color: white !important;
}

.pagination .page-item.disabled .page-link {
    background-color: #17171c !important;
    border-color: #2d2d35 !important;
    color: #52525b !important;
}

/* Drop Down Menu In Forms Styling */
.form-select-dark {
    background-color: #334155 !important;
    border: 1px solid #475569 !important;
    color: #ffffff !important;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://w3.org' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23e2e8f0' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
    background-position: right 0.75rem center !important;
    background-repeat: no-repeat !important;
    background-size: 10px 12px !important;
}

.form-select-dark:focus {
    background-color: #1e293b !important;
    border-color: var(--purple-primary) !important;
    box-shadow: 0 0 0 0.3rem rgba(139, 92, 246, 0.3) !important;
    color: #ffffff !important;
    outline: none;
}    

/* Custom File Input File-Selector Button Styling */
.form-control-file-custom::-webkit-file-upload-button {
    background-color: var(--bg-dark-grey) !important;
    color: var(--text-muted) !important;
    border: 1px solid #475569 !important;
    border-radius: 6px;
    padding: 0.35rem 0.75rem;
    margin-right: 0.75rem;
    transition: all 0.15s ease-in-out;
}

.form-control::file-selector-button {
    margin: 0.1rem 0.1rem; !important;

}

.form-control-file-custom::file-selector-button {
    margin-right: 8px; 
}

.form-control-file-custom::-webkit-file-upload-button {
    margin-right: 8px;
}

.form-control-file-custom::-webkit-file-upload-button:hover {
    background-color: #1e293b !important;
    color: #ffffff !important;
}

/* Edit form shows a logo preview of current logo */
.edit-logo-preview {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid rgba(139, 92, 246, 0.3);
    background-color: var(--bg-dark-grey);
}

/* Other Buttons and Links Styling */
.btn-secondary-custom {
    background-color: transparent;
    border: 1px solid #475569;
    color: var(--text-muted) !important;
    font-weight: 600;
    transition: all 0.15s ease-in-out;
}

.btn-secondary-custom:hover {
    background-color: rgba(255, 255, 255, 0.05);
    color: #ffffff !important;
    border-color: #94a3b8;
}

.website-link {
    color: #38bdf8 !important;
    text-decoration: none;
}

.website-link:hover {
    text-decoration: underline !important;
}

.empty-state-box {
    background-color: var(--bg-card-grey);
    border: 1px dashed rgba(255, 255, 255, 0.1);
    color: var(--text-muted);
    border-radius: 8px;
}

/* Error Message Styling  */
.dark-error-alert {
    background-color: rgba(244, 63, 94, 0.1) !important;
    border: 1px solid rgba(244, 63, 94, 0.25) !important;
    color: #fca5a5 !important;
    border-radius: 8px;
}

.invalid-feedback-custom {
    color: #fb7185 !important;
    font-size: 0.8rem;
    font-weight: 500;
}

</style>
</head>
<body>
    <div id="app">
        <!-- Modernized Dark Grey & Purple Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: var(--bg-card-grey);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <span style="color: var(--purple-primary);">★</span> {{ config('app.name', 'AdminTool') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <!-- Left Side -->
            <ul class="navbar-nav me-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}">Companies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">Employees</a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                    </li>
                @else
                    <li class="nav-item dropdown admin-user-nav-item">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle py-2 px-3 border border-secondary rounded-3 text-center" href="#" role="button" data-bs-toggle="dropdown">
                            <span class="me-1" style="color: var(--purple-primary);">●</span> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark-custom text-center shadow-lg mt-2">
                            <a class="dropdown-item fw-bold logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="logout-text">Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

        <!-- Main Content Area -->
        <main class="py-4 px-2 px-sm-0">
            @yield('content')
        </main>
    </div>

     <footer class="footer mt-auto py-3 bg-dark border-top border-secondary">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center text-center text-sm-start gap-2">
            <!-- Copyright Section -->
            <span class="text-secondary small text-white-50 fs-6">
                &copy; {{ date('Y') }} {{ config('app.name', 'Company Admin Tool') }}, Robert Lavender.
            </span>

            <!-- Dynamic API Link Buttons -->
            @auth
                <div>
                    @if(request()->routeIs('companies.*'))
                        <a href="{{ route('api.companies.index') }}" class="btn btn-sm btn-primary px-3 fs-6" target="_blank">
                            View Companies JSON API File
                        </a>
                    @endif

                    @if(request()->routeIs('employees.*'))
                        <a href="{{ route('api.employees.index') }}" class="btn btn-sm btn-primary text-white px-3 fs-6" target="_blank">
                            View Employees JSON API File
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </footer>
</body>
</html>