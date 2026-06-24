@extends('layouts.app')
@section('title', $company->name . ' Company Profile')

@section('content')

<div class="container">
    <!--Title and Back to Companies Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold m-0" style="color: var(--text-main);">Company Profile</h1>
        <a href="{{ route('companies.index') }}" class="btn btn-purple px-4 fw-bold">
            &larr; Back to Companies
        </a>
    </div>

     <!-- Success Messaging Alert Box -->
    @if(session('success'))
        <div class="alert alert-success border-0 bg-success text-white px-4 py-3 mb-4 shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Company Profile Card Header -->
    <div class="profile-header-card p-4 mb-5 shadow-sm">
        <div class="row align-items-center g-4">
            
            <!-- Logo Box -->
            <div class="col-auto">
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" class="profile-logo-bubble shadow">
                @else
                    <div class="profile-logo-placeholder">No Logo</div>
                @endif
            </div>

            <!-- Company Profile Details -->
            <div class="col-sm col-12">
                <h2 class="h2 fw-bold text-white mb-2">{{ $company->name }}</h2>
                
                <div class="g-2 text-sm">
                    <div class="col-md-6 mt-2">
                        <span class="fw-bold fs-5" style="color: var(--purple-primary);">Email:</span> 
                        <span class=" fs-5" style="color: var(--text-muted);">{{ $company->email ?? '-' }}</span>
                    </div>
                    <!-- Company Website -->
                    <div class="col-md-6 mt-2">
                        <span class="fw-bold fs-5 me-2" style="color: var(--purple-primary);">Website:</span> 
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="website-link font-medium fs-5">
                               {{ 'www.' . str_replace(['http://', 'https://', 'www.'], '', $company->website)}}
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                    <!-- Employee Count Bubble for Company -->
                    <div class="col-12 mt-2">
                        <span class="fw-bold fs-5" style="color: var(--purple-primary);">Total Number of Employees:</span> 
                        <span class="badge fs-5 rounded-pill px-3 py-1 ms-1" style="background-color: var(--bg-dark-grey); color: #fff; border: 1px solid rgba(139, 92, 246, 0.3);">
                            {{ $company->employees->count() }} Staff Employees
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table of Employeed Staff -->
    <div class="mb-2">
        <h3 class="h4 fw-bold mb-3" style="color: var(--text-main); letter-spacing: 0.5px;">Current Staff Employees</h3>
        
        <!-- If statement checks if empty then if not shows table list of employees -->
        @if($company->employees->isEmpty())
            <div class="empty-state-box p-4 text-center italic">
                This company currently has no staff employees.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle shadow-sm">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loops through the empoloyees that belong to this company to show their infomation -->
                        @foreach($company->employees as $worker)
                        <tr>
                        <!-- First Name -->
                        <td>
                            <a href="{{ route('employees.show', $worker->id) }}" class="profile-link fw-bold">
                                {{ $worker->first_name }}
                            </a>
                        </td>
                        
                        <!-- Last Name -->
                        <td>
                            <a href="{{ route('employees.show', $worker->id) }}" class="profile-link fw-bold">
                                {{ $worker->last_name }}
                            </a>
                        </td>
                        
                        <!-- Email -->
                        <td>{{ $worker->email ?? '-' }}</td>
                        
                        <!-- Action Links (View, Edit & Delete) -->
                        <td class="text-center flex-row justify-content-center d-sm-flex gap-4">
                            <a href="{{ route('employees.show', $worker->id) }}" class="btn btn-info px-3 py-2 fw-bold">View</a>
                            <a href="{{ route('employees.edit', $worker->id) }}" class="btn btn-edit px-3 py-2 fw-bold">Edit</a>
                            
                            <!-- Form wrapper now encapsulates everything, including the modal -->
                            <form action="{{ route('employees.update', $worker->id) }}" method="POST" class="d-inline m-0">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="first_name" value="{{ $worker->first_name }}">
                                <input type="hidden" name="last_name" value="{{ $worker->last_name }}">
                                <input type="hidden" name="company_id" value="">
                                
                                <input type="hidden" name="source" value="profile">
                                <!-- Trigger button remains visually the same -->
                                <button type="button" 
                                        class="btn btn-delete px-3 py-2 fw-bold border-0 align-baseline"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#removeWorkerModal-{{ $worker->id }}">
                                    Remove
                                </button>

                                <!-- Modal is safely enclosed within the form scope -->
                                <div class="modal fade text-start" id="removeWorkerModal-{{ $worker->id }}" tabindex="-1" aria-labelledby="removeWorkerLabel-{{ $worker->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-dark text-light border-secondary">
                                    <div class="modal-header border-secondary">
                                        <h5 class="modal-title" id="removeWorkerLabel-{{ $worker->id }}">Remove Employee from Company</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-wrap opacity-90">
                                        Are you sure you want to remove <strong>{{ $worker->first_name }} {{ $worker->last_name }}</strong> from this company? <br>
                                        <span class="text-muted small">The employee record will remain, but they will become unemployed and need to be reassigned to another company.</span>
                                    </div>
                                    <div class="modal-footer border-secondary">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <!-- Standard type="submit" now works naturally without external form binding attributes -->
                                        <button type="submit" class="btn btn-danger fw-bold">Remove Worker</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Company Action Links (Edit & Delete) -->
    <div class="d-flex align-items-center gap-3 pt-2">
        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-edit py-2 px-4 fw-bold">
            Edit Company
        </a>
        <span class="opacity-25" style="color: var(--text-muted);">|</span>
        
        <form id="deleteCompanyForm" action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline m-0">
        @csrf 
        @method('DELETE')
        
        <input type="hidden" name="source" value="profile">
        
            <button type="button" 
                class="btn btn-delete px-4 py-2 fw-bold border-0 align-baseline"
                data-bs-toggle="modal" 
                data-bs-target="#deleteCompanyModal">
                Delete Company
            </button>
        </form>
    
    </div>
</div>

<div class="modal fade text-start" id="deleteCompanyModal" tabindex="-1" aria-labelledby="deleteCompanyLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light border-secondary">
      
      <div class="modal-header border-secondary">
        <h5 class="modal-title" id="deleteCompanyLabel">
            {{ $company->employees()->count() > 0 ? 'Company Cannot Be Removed' : 'Confirm Company Deletion' }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body text-wrap opacity-90">
        @if($company->employees()->count() > 0)
            <!-- BLOCK CONDITION: Employees exist -->
            <p>You cannot delete <strong>{{ $company->name }}</strong> because it currently has <strong >{{ $company->employees()->count() }} staff employees</strong>.</p>
            
            <div class="alert alert-warning bg-transparent border-warning text-warning mb-0">
                <i class="bi bi-exclamation-triangle-fill"></i> 
                <strong>Action Required:</strong> To delete this company, you must either completely remove all employees from this company or reassign them to an another company.
            </div>
        @else
            <!-- ALLOW CONDITION: 0 Employees -->
            <p>Are you sure you want to permanently delete <strong>{{ $company->name }}</strong>?</p>
            <span class="text-danger small"><i class="bi bi-info-circle"></i> This action is permanent and cannot be undone.</span>
        @endif
      </div>
      
      <div class="modal-footer border-secondary">
        @if($company->employees()->count() > 0)
            <!-- Display ONLY a close button when blocked -->
            <button type="button" class="btn btn-secondary fw-bold px-4" data-bs-dismiss="modal">Close</button>
        @else
            <!-- Display full operational submit button when company is empty -->
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" form="deleteCompanyForm" class="btn btn-danger fw-bold">Delete Company</button>
        @endif
      </div>

    </div>
  </div>
</div>
@endsection