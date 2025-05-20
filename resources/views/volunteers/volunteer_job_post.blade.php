<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Volunteer Job Posting</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f5f5;
      font-family: 'Segoe UI', Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      margin: 32px 0 16px 16px;
      font-size: 2.2rem;
      font-weight: 700;
      color: #222;
    }
    .form-container {
      background: #fff;
      max-width: 90vw;
      width: 900px;
      margin: 32px auto;
      border-radius: 12px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
      padding: 32px 32px 24px 32px;
    }
    .form-container h2 {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 24px;
      color: #222;
    }
    form#volunteerForm {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .form-group label {
      font-weight: 500;
      color: #374151;
      font-size: 0.95rem;
    }
    form#volunteerForm input[type="text"],
    form#volunteerForm input[type="email"],
    form#volunteerForm input[type="tel"],
    form#volunteerForm textarea {
      padding: 12px 16px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 1rem;
      background: #f9fafb;
      transition: all 0.2s;
      width: 100%;
      box-sizing: border-box;
    }
    form#volunteerForm textarea {
      min-height: 120px;
      resize: vertical;
    }
    form#volunteerForm input[type="text"]:focus,
    form#volunteerForm input[type="email"]:focus,
    form#volunteerForm input[type="tel"]:focus,
    form#volunteerForm textarea:focus {
      border: 1.5px solid #2563eb;
      outline: none;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .required-field::after {
      content: " *";
      color: #dc2626;
    }
    .form-row {
      display: flex;
      gap: 16px;
    }
    .form-row .form-group {
      flex: 1;
    }
    form#volunteerForm button[type="submit"] {
      margin-top: 16px;
      padding: 14px 0;
      background: #2563eb;
      color: #fff;
      font-size: 1.1rem;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s;
      box-shadow: 0 2px 8px rgba(37,99,235,0.08);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    form#volunteerForm button[type="submit"]:hover {
      background: #1d4ed8;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(37,99,235,0.15);
    }
    .loading {
      opacity: 0.7;
      pointer-events: none;
    }
    .loading::after {
      content: "";
      display: inline-block;
      width: 16px;
      height: 16px;
      border: 2px solid #fff;
      border-radius: 50%;
      border-top-color: transparent;
      animation: spin 1s linear infinite;
      margin-left: 8px;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 16px;
      display: none;
    }
    .alert-success {
      background: #dcfce7;
      color: #166534;
      border: 1px solid #86efac;
    }
    .alert-error {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }
    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 16px;
      }
    }
    @media (max-width: 600px) {
      .form-container {
        width: 98vw;
        padding: 16px 4vw;
      }
      h1 {
        font-size: 1.3rem;
        margin-left: 8px;
      }
    }
  </style>
</head>
<body>

  <h1>Volunteer Job Posting</h1>

  <div class="form-container">
    <h2>Post a Job (Needs Admin Approval)</h2>
    <div id="alert" class="alert"></div>
    <form id="volunteerForm">
      <div class="form-group">
        <label for="volRole" class="required-field">Job Role</label>
        <input type="text" id="volRole" name="role" autocomplete="off" required />
      </div>

      <div class="form-group">
        <label for="volTitle" class="required-field">Job Title</label>
        <input type="text" id="volTitle" name="title" autocomplete="off" required />
      </div>

      <div class="form-group">
        <label for="volCompanyName" class="required-field">Company Name</label>
        <input type="text" id="volCompanyName" name="company_name" autocomplete="organization" required />
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="volContactPerson" class="required-field">Contact Person</label>
          <input type="text" id="volContactPerson" name="contact_person" autocomplete="name" required />
        </div>
        <div class="form-group">
          <label for="volContactEmail" class="required-field">Contact Email</label>
          <input type="email" id="volContactEmail" name="contact_email" autocomplete="email" required />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="volContactPhone" class="required-field">Contact Phone</label>
          <input type="tel" id="volContactPhone" name="contact_phone" autocomplete="tel" required />
        </div>
        <div class="form-group">
          <label for="volLocation" class="required-field">Location</label>
          <input type="text" id="volLocation" name="location" autocomplete="address-level2" required />
        </div>
      </div>

      <div class="form-group">
        <label for="volDescription" class="required-field">Job Description</label>
        <textarea id="volDescription" name="description" required></textarea>
      </div>

      <div class="form-group">
        <label for="volQualifications" class="required-field">Qualifications</label>
        <textarea id="volQualifications" name="qualifications" required></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="volEmploymentType" class="required-field">Employment Type</label>
          <input type="text" id="volEmploymentType" name="employment_type" placeholder="e.g. Full-time, Part-time" required />
        </div>
        <div class="form-group">
          <label for="volSalaryRange">Salary Range (Optional)</label>
          <div class="form-row" style="gap: 8px;">
            <input type="text" id="volSalaryMin" name="salary_min" placeholder="Min" />
            <input type="text" id="volSalaryMax" name="salary_max" placeholder="Max" />
          </div>
        </div>
      </div>

      <button type="submit">
        <i class="fas fa-paper-plane"></i>
        Submit for Approval
      </button>
    </form>
  </div>

  <script>
    document.getElementById('volunteerForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const form = e.target;
      const submitButton = form.querySelector('button[type="submit"]');
      const alert = document.getElementById('alert');

      // Show loading state
      submitButton.classList.add('loading');
      submitButton.disabled = true;

      const formData = {
        title: document.getElementById('volTitle').value,
        role: document.getElementById('volRole').value,
        company_name: document.getElementById('volCompanyName').value,
        contact_email: document.getElementById('volContactEmail').value,
        location: document.getElementById('volLocation').value,
        description: document.getElementById('volDescription').value,
        qualifications: document.getElementById('volQualifications').value,
        contact_person: document.getElementById('volContactPerson').value,
        contact_phone: document.getElementById('volContactPhone').value,
        employment_type: document.getElementById('volEmploymentType').value,
        salary_min: document.getElementById('volSalaryMin').value,
        salary_max: document.getElementById('volSalaryMax').value,
        status: 'pending',
        is_admin_posted: false
      };

      fetch("{{ route('volunteer.jobs.store') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(err => Promise.reject(err));
        }
        return response.json();
      })
      .then(data => {
        // Show success message
        alert.className = 'alert alert-success';
        alert.textContent = data.message || 'Job submitted successfully! Waiting for admin approval.';
        alert.style.display = 'block';
        
        // Reset form
        form.reset();
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Redirect to admin jobs page after 2 seconds
        setTimeout(() => {
          window.location.href = "{{ route('jobs.admin.index') }}";
        }, 2000);
      })
      .catch(error => {
        // Show error message
        alert.className = 'alert alert-error';
        alert.textContent = error.message || 'Error submitting job. Please try again.';
        alert.style.display = 'block';
        
        console.error('Error:', error);
      })
      .finally(() => {
        // Remove loading state
        submitButton.classList.remove('loading');
        submitButton.disabled = false;
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
