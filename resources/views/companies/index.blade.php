@extends('layouts.app')
@section('title', 'List of Companies')

@section('content')
<div class="container">
    <!-- Title and Add Company Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold m-0" style="color: var(--text-main);">List of Companies</h1>
        <a href="{{ route('companies.create') }}" class="btn btn-purple px-4 fw-bold">
            Add Company
        </a>
    </div>

    <!-- Success Messaging Alert Box -->
    @if(session('success'))
        <div class="alert alert-success border-0 bg-success text-white px-4 py-3 mb-4 shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Filter Panel Area -->
    <div class="row mb-3">
    <div class="card border-0 col-md-7 col-lg-6 shadow-sm" style="background-color: var(--bg-dark-grey, #1e1e1e); border-radius: 10px;">
        <form id="searchForm" action="{{ url()->current() }}" method="GET">
            <!-- Retain current sort and order preferences natively -->
            @if(request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif
            @if(request('direction'))
                <input type="hidden" name="direction" value="{{ request('direction') }}">
            @endif  
                <div class="row g-3 align-items-center">
                    <div class="col">
                    <div class="input-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                        <span class="input-group-text border-0 text-muted" style="background-color: #2a2a2a; color: var(--text-main) !important;">
                            <svg xmlns="http://w3.org" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            id="searchInput"
                            value="{{ request('search') }}" 
                            class="form-control border-0 text-white py-2" 
                            style="background-color: #2a2a2a; color-scheme: dark;"
                            placeholder="Type a company name..."
                            aria-label="Search by company name"
                            autocomplete="off"
                        >
            
                        
                    </div>
                </div>

                <!-- Search Button -->
                <div class="col-auto d-flex gap-3">
                    <button class="btn btn-purple fw-bold px-4" type="submit">
                        Search
                    </button>

                     @if(request('search'))
                        <a href="{{ url()->current() . (request('sort') ? '?sort='.request('sort').'&direction='.request('direction') : '') }}" 
                           class="btn fw-bold px-4 py-2 custom-clear-btn" 
                           style="border-radius: 8px; color: var(--text-main, #ffffff); border: 2px solid rgba(255, 255, 255, 0.4); background: transparent;"
                           title="Reset Table">
                            Clear
                        </a>
                    @endif

                </div>
            </div>    
        </form>
    </div>
    </div>

    <!-- List of Companies Table -->
    <div class="table-responsive">
    <table class="table table-dark-custom align-middle shadow-sm">
        <thead>
            <tr>
                <th scope="col" style="width: 80px; color: var(--text-main);">Logo</th>
                
                <!-- Sortable Name Column -->
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => ($sort === 'name' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--text-main);">
                        Name 
                        <span class="sort-triangle {{ $sort === 'name' ? $direction : 'default' }}"></span>
                    </a>
                </th>
                
                <!-- Sortable Email Column -->
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'email', 'direction' => ($sort === 'email' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--text-main);">
                        Email 
                        <span class="sort-triangle {{ $sort === 'email' ? $direction : 'default' }}"></span>
                    </a>
                </th>
                
                <!-- Sortable Website Column -->
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'website', 'direction' => ($sort === 'website' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--text-main);">
                        Website 
                        <span class="sort-triangle {{ $sort === 'website' ? $direction : 'default' }}"></span>
                    </a>
                </th>
                
                <!-- Sortable Dynamic Count Column -->
                <th scope="col" class="text-center">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'employees_count', 'direction' => ($sort === 'employees_count' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center justify-content-center" style="color: var(--text-main);">
                        Employees 
                        <span class="sort-triangle {{ $sort === 'employees_count' ? $direction : 'default' }}"></span>
                    </a>
                </th>
                
                <th scope="col" class="text-center" style="color: var(--text-main);">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <!-- Logo Section -->
                <td>
                    @if($company->logo)
                        <a href="{{ route('companies.show', $company->id) }}">
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" class="company-logo-frame">
                        </a>
                    @else
                        <span class="text-muted small opacity-50 italic">No Logo</span>
                    @endif
                </td>

                <!-- Company Name -->
                <td>
                    <a href="{{ route('companies.show', $company->id) }}" class="profile-link fw-bold">
                        {{ $company->name }}
                    </a>
                </td>
                
                <!-- Contact Email -->
                <td>{{ $company->email ?? '-' }}</td>

                <!-- Company Website -->
                <td>
                    @if($company->website)
                        <a href="{{ $company->website }}" target="_blank" class="website-link font-medium">
                            {{ str_replace(['http://', 'https://', 'www.'], '', $company->website) }}
                        </a>
                    @else
                        <span class="text-muted opacity-50">-</span>
                    @endif
                </td>
                
                <!-- Staff Count Pill -->
                <td class="text-center">
                    <span class="badge rounded-pill px-3 py-2 border border-secondary" style="background-color: var(--bg-dark-grey); color: var(--text-main); font-size: 1.1rem;">
                        {{ $company->employees_count ?? $company->employees->count() }}
                    </span>
                </td>
                
                <!-- Actions Links (View, Edit & Delete) -->
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center gap-3 px-2">                       
            
                    <div class="d-flex justify-content-center align-items-center gap-3 px-2">
                        <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info px-3 py-2 fw-bold">View</a>
                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-edit px-3 py-2 fw-bold">Edit</a>
    
                        <!-- Trigger button linked to the modal below -->
                        <button type="button" 
                                class="btn-delete btn px-3 py-2 border-0 align-baseline fw-bold"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal-{{ $company->id }}">
                            Remove
                        </button>
                    </div>

<!-- Dynamic Confirmation Modal -->
<div class="modal fade text-start" id="deleteModal-{{ $company->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $company->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light border-secondary">
      
      <div class="modal-header border-secondary">
        <h5 class="modal-title" id="deleteModalLabel-{{ $company->id }}">Confirm Company Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="deleteForm-{{ $company->id }}" action="{{ route('companies.destroy', $company->id) }}" method="POST" class="m-0">
          @csrf 
          @method('DELETE')

          <div class="modal-body text-wrap opacity-90">
            <p>Are you sure you want to permanently remove <strong>{{ $company->name }}</strong>?</p>

            <!-- CONDITION A: Company HAS employees -> Force Reassignment -->
            @if(($company->employees_count ?? $company->employees->count()) > 0)
                <div class="alert alert-warning bg-transparent border-warning text-warning small mb-3">
                    <i class="bi bi-exclamation-triangle"></i> 
                    <strong>Action Required:</strong> This company has <strong>{{ $company->employees_count ?? $company->employees->count() }} staff employees </strong>. You must reassign them to another company before deleting this company.
                </div>

                <div class="mb-2">
                    <label for="reassign-{{ $company->id }}" class="form-label small fw-bold text-light opacity-75">Transfer Employees To:</label>
                    <select name="reassign_company_id" id="reassign-{{ $company->id }}" class="form-select bg-dark text-light border-secondary shadow-none" required>
                        <option value="" disabled selected>-- Choose target company --</option>
                        @foreach($allCompanies as $targetCompany)
                            {{-- Hide the current company from its own transfer list --}}
                            @if($targetCompany->id !== $company->id)
                                <option value="{{ $targetCompany->id }}">{{ $targetCompany->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

            <!-- CONDITION B: Company has NO employees -> Safe to delete directly -->
            @else
                <div class="alert fw-bold alert-success bg-transparent border-success text-success small mb-0">
                    <i class="bi bi-check-circle"></i> This company currently has 0 staff employees and can be safely deleted.
                </div>
            @endif
          </div>
          
          <div class="modal-footer border-secondary">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            
            <!-- Button updates dynamically depending on the employee count state -->
            <button type="submit" class="btn {{ ($company->employees_count ?? $company->employees->count()) > 0 ? 'btn-warning text-dark' : 'btn-danger' }} fw-bold">
                {{ ($company->employees_count ?? $company->employees->count()) > 0 ? 'Reassign & Remove' : 'Remove Company' }}
            </button>
          </div>
      </form>

    </div>
  </div>
</div>
                        <!-- 
                        <form id="deleteForm-{{ $company->id }}" action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline m-0">
                            @csrf 
                            @method('DELETE')
                            <!-- Trigger button linked to modal below 
                            <button type="button" 
                                    class="btn-delete btn px-3 py-2 border-0 align-baseline fw-bold"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal-{{ $company->id }}">
                                Remove
                            </button>
                        </form>
                    </div>

                    <!-- Confirmation Modal -->
                     <!--
                    <div class="modal fade text-start" id="deleteModal-{{ $company->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $company->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-dark text-light border-secondary">
                          
                          <div class="modal-header border-secondary">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $company->id }}">Confirm Deletion</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          
                          <div class="modal-body text-wrap opacity-90">
                            Are you sure you want to permanently remove <strong>{{ $company->name }}</strong>? <br>
                            <span class="text-warning small"><i class="bi bi-exclamation-triangle"></i> All employees linked to this firm will be unassigned.</span>
                          </div>
                          
                          <div class="modal-footer border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="deleteForm-{{ $company->id }}" class="btn btn-danger fw-bold">Remove Company</button>
                          </div>

                        </div>
                      </div>
                    </div> -->

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Row Handled by Vendor/Pagination Bootstrap Files -->
    <div class="d-flex justify-content-center mt-4">
        {{ $companies->appends(request()->query())->links() }}
    </div>
</div>
@endsection
