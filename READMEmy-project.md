========================================================================
LARAVEL DIRECTORY STRUCTURE (CLEAN ROLE SEPARATION)
========================================================================

app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/                         <-- Handles System Login/Registration
│   │   │   ├── LoginController.php
│   │   │   └── RegisterController.php
│   │   │
│   │   ├── Admin/                        <-- Admin Backend Code Only
│   │   │   ├── DashboardController.php
│   │   │   ├── HospitalApprovalController.php
│   │   │   ├── VaccineController.php
│   │   │   └── ReportExportController.php
│   │   │
│   │   ├── Hospital/                     <-- Hospital Backend Code Only
│   │   │   ├── DashboardController.php
│   │   │   ├── RequestQueueController.php
│   │   │   └── MedicalRecordController.php
│   │   │
│   │   └── Patient/                      <-- Patient Backend Code Only
│   │       ├── DashboardController.php
│   │       ├── ProfileController.php
│   │       ├── SearchHospitalController.php
│   │       └── BookingController.php
│   │
│   └── Middleware/                       <-- Route Gatekeepers
│       ├── AdminMiddleware.php           <-- Checks if role == 'admin'
│       ├── HospitalMiddleware.php        <-- Checks if role == 'hospital' & approved
│       └── PatientMiddleware.php         <-- Checks if role == 'patient'
│
└── Models/                               <-- Database Entities
    ├── User.php                          <-- Central Authenticable Model
    ├── PatientProfile.php                <-- Personal details linked to User
    ├── HospitalProfile.php               <-- Hospital info linked to User
    ├── Vaccine.php                       <-- Inventory items
    ├── Appointment.php                   <-- Scheduling details
    └── MedicalReport.php                 <-- Testing & Vaccination outcomes

database/
└── migrations/                           <-- Database Tables
    ├── 2026_01_01_000000_create_users_table.php
    ├── 2026_01_01_000001_create_patient_profiles_table.php
    ├── 2026_01_01_000002_create_hospital_profiles_table.php
    ├── 2026_01_01_000003_create_vaccines_table.php
    ├── 2026_01_01_000004_create_appointments_table.php
    └── 2026_01_01_000005_create_medical_reports_table.php

resources/
└── views/                                <-- Blade Layouts & UI Panels
    ├── layouts/                          <-- Master layout wrappers
    │   ├── admin.blade.php
    │   ├── hospital.blade.php
    │   └── patient.blade.php
    │
    ├── admin/                            <-- Admin UI Panel
    │   ├── dashboard.blade.php
    │   ├── hospitals/index.blade.php
    │   ├── vaccines/index.blade.php
    │   └── reports/index.blade.php
    │
    ├── hospital/                         <-- Hospital UI Panel
    │   ├── dashboard.blade.php
    │   ├── requests/index.blade.php
    │   └── records/edit.blade.php
    │
    └── patient/                          <-- Patient UI Panel
        ├── dashboard.blade.php
        ├── profile/edit.blade.php
        ├── search/index.blade.php
        ├── appointments/book.blade.php
        └── results/index.blade.php

routes/
└── web.php                               <-- Divided cleanly using Route Groups