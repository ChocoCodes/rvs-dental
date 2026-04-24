# RVS Dental Management System

RVS Dental is a Laravel-based clinic management system for handling patient records, appointment scheduling, treatment documentation, and payment tracking in one unified web application.

It is built for day-to-day dental clinic operations where staff and dentists need a reliable workflow from patient intake to treatment history and billing.

---

## What This System Is About

This project centralizes four core clinic workflows:

1. **Patient Management** - maintain patient profiles and records.
2. **Appointment Management** - schedule, track, and manage appointment statuses.
3. **Clinical Documentation** - record medical history responses, conditions, and treatment procedures.
4. **Financial Tracking** - manage ledgers, payments, and running balances per treatment.

Instead of storing these processes across separate tools, RVS Dental connects them through a shared relational data model.

---

## Core Features

### 1) Patient Module

- Create, update, view, and soft-delete patient records.
- Store patient demographics and contact details.
- Upload patient photo files to clinic storage.
- Search patients by first name, last name, or full name.
- View patient medical history derived from appointment responses.
- View patient appointment folders with procedure files/images.
- View quick patient financial summary (latest completed, next scheduled, deficiency, total payment).

### 2) Appointment Module

- Full appointment CRUD operations.
- Schedule appointments by patient, dentist, date/time slot, and status.
- Filter appointment list by date, search query, sort direction, and status.
- Calendar endpoint for month/year grid rendering.
- Dedicated detailed appointment view.
- Attach dental procedures to appointments.
- Upload appointment-specific clinical images/files.
- Capture and save structured medical form responses:
  - Yes/No questions
  - Yes/No/N/A questions
  - note-required conditional questions
  - free-text medical entries
- Track patient medical conditions, including custom "Others" notes.

### 3) Procedure and Clinical Records

- Procedure catalog support via dental procedures table.
- Appointment-to-procedure many-to-many mapping through appointment procedures.
- Per-procedure notes stored for clinical context.
- Procedure file/image management per appointment.
- Generate treatment view for selected appointment data (patient, dentist, procedures).

### 4) Transactions and Billing Module

- Record transactions linked to a ledger per appointment procedure.
- Track `charged_price`, payments, and computed running balance.
- Prevent overpayment in payment entry logic.
- Distinguish pending vs completed balances.
- Filter transactions by patient, date, and status.
- View transaction details with related patient + procedure context.

---

## Authentication and Authorization

### Authentication Flow

- Login is handled through email/password authentication.
- Session is regenerated after successful login.
- Logout invalidates session and regenerates CSRF token.
- Guests are redirected to `/` (login route).

### Authorization (Role-Based Access)

- Protected routes require both `auth` and custom `role` middleware.
- Allowed roles for protected access are:
  - `Staff`
  - `Dentist`
- Unauthorized roles receive HTTP `403 Unauthorized`.

> Note: A `Patient` user may exist in seed data, but current role middleware restricts application modules to Staff and Dentist roles.

---

## CRUD Coverage

RVS Dental provides CRUD operations across major entities:

| Entity | Create | Read | Update | Delete |
|---|---|---|---|---|
| Patients | Yes | Yes | Yes | Yes (soft delete) |
| Appointments | Yes | Yes | Yes | Yes (resource route) |
| Transactions | Yes | Yes | Yes (amount update endpoint) | Resource route present |
| Appointment Procedures | Yes | Yes (via appointment detail) | Managed through linked records | Managed through linked records |

Additional read/utility endpoints exist for:

- patient search
- patient summary
- appointment calendar data
- appointment full details (JSON)
- medical form views and submissions

---

## High-Level Data Model

Key domain relationships:

- A **Patient** has many **Appointments**.
- A **Dentist** has many **Appointments**.
- An **Appointment** has many **Appointment Procedures**.
- An **Appointment Procedure** belongs to one **Ledger**.
- A **Ledger** has many **Transactions**.
- An **Appointment** has many **Patient Responses** (medical questionnaire answers).
- An **Appointment** has many **Patient Conditions** (selected medical conditions).
- An **Appointment** has many **Procedure Files** (uploaded images/documents).

This relationship chain allows the app to connect clinical actions with financial outcomes.

---

## Tech Stack

### Backend

- **PHP 8.2+**
- **Laravel 12**
- **Eloquent ORM** for relational modeling
- **Laravel validation**, middleware, sessions, file storage

### Frontend

- **Blade templating**
- **Vite** build tooling
- **Tailwind CSS v4**
- **Axios** for asynchronous requests

### Database and Persistence

- Relational SQL database via Laravel migrations
- Seeders for users, patients, dentists, appointments, procedures, ledgers, transactions

### Testing and Dev Tooling

- **Pest** (+ Laravel plugin)
- **Laravel Pint**
- **Laravel Sail** (optional)

---

## Route and Module Map

Top navigation modules:

- `/patients`
- `/appointments`
- `/transactions`

Important additional routes include:

- `GET /patients/search`
- `GET /patients/{patient}/summary`
- `GET /patients/{patient}/appointments`
- `GET /appointments/calendar/data`
- `GET /appointments/{appointment}/view`
- `GET /appointments/{appointment}/medical-form`
- `POST /appointments/{appointment}/medical-form`
- `GET /appointments/{appointment}/full`
- `POST /appointments/{appointment}/upload`
- `POST /appointments/{appointment}/images/upload`

---

## API-Style Endpoint Reference

Although this is a server-rendered Laravel web app (Blade views), the routes below are documented in API-style format so developers can quickly understand each module contract.

### Conventions

- Base URL (local): `http://127.0.0.1:8000`
- Authenticated routes require session login.
- Protected module access requires role: `Staff` or `Dentist`.
- Response type is mostly HTML views; some routes return JSON or HTML partials for AJAX.

### Authentication Module

| Method | Endpoint | Auth | Description | Response |
|---|---|---|---|---|
| GET | `/` | Guest only (`logged_in`) | Render login page | HTML view |
| POST | `/` | Guest only (`logged_in`) | Authenticate user with email/password | Redirect (on success/failure) |
| POST | `/logout` | Auth + role | Log out user and invalidate session | Redirect to login |

### Patients Module

#### Resource Endpoints

| Method | Endpoint | Auth | Description | Response |
|---|---|---|---|---|
| GET | `/patients` | Auth + role | List patients (supports pagination; AJAX list partial) | HTML view/partial |
| GET | `/patients/create` | Auth + role | Render patient create form | HTML view |
| POST | `/patients` | Auth + role | Create patient record (with optional photo upload) | Redirect |
| GET | `/patients/{patient}` | Auth + role | Show patient profile, history, folders/files | HTML view |
| GET | `/patients/{patient}/edit` | Auth + role | Render patient edit form | HTML view |
| PUT/PATCH | `/patients/{patient}` | Auth + role | Update patient record (and optional photo replacement) | Redirect |
| DELETE | `/patients/{patient}` | Auth + role | Soft-delete patient | Redirect |

#### Utility Endpoints

| Method | Endpoint | Auth | Description | Response |
|---|---|---|---|---|
| GET | `/patients/search` | Auth + role | Search patients by name (`query`, min 3 chars) | JSON array |
| GET | `/patients/{patient}/appointments` | Auth + role | Get relevant patient appointments | JSON array |
| GET | `/patients/{patient}/summary` | Auth + role | Get summary metrics (last/next appointment, deficiency, total payment) | JSON object |

### Appointments Module

#### Resource Endpoints

| Method | Endpoint | Auth | Description | Response |
|---|---|---|---|---|
| GET | `/appointments` | Auth + role | List appointments with filters (`search`, `date`, `status`, `sort`) | HTML view/partial |
| GET | `/appointments/create` | Auth + role | Render appointment create form | HTML view |
| POST | `/appointments` | Auth + role | Create appointment | Redirect |
| GET | `/appointments/{appointment}` | Auth + role | Show compact appointment detail component | HTML view |
| GET | `/appointments/{appointment}/edit` | Auth + role | Render appointment edit form | HTML view |
| PUT/PATCH | `/appointments/{appointment}` | Auth + role | Update appointment | Redirect |
| DELETE | `/appointments/{appointment}` | Auth + role | Delete appointment | Redirect |

#### Extended Appointment Endpoints

| Method | Endpoint | Auth | Description | Response |
|---|---|---|---|---|
| GET | `/appointments/calendar/data` | Auth + role | Calendar dataset by `month` and `year` | JSON (AJAX) / HTML |
| GET | `/appointments/{appointment}/view` | Auth + role | Full appointment detail page with procedures/ledger | HTML view |
| GET | `/appointments/{appointment}/generate` | Auth + role | Generated treatment view | HTML view |
| GET | `/appointments/{appointment}/medical-form` | Auth + role | Render medical questionnaire form | HTML view |
| POST | `/appointments/{appointment}/medical-form` | Auth + role | Save questionnaire responses and condition selections | Redirect |
| GET | `/appointments/{appointment}/full` | Auth + role | Return deep appointment financial details | JSON object |
| POST | `/appointments/{appointment}/procedures` | Auth + role | Attach procedure(s) to appointment | Redirect/JSON (controller-dependent) |
| POST | `/appointments/{appointment}/upload` | Auth + role | Upload procedure images to appointment folder | Redirect |
| POST | `/appointments/{appointment}/images/upload` | Auth + role | Save uploaded images via dedicated file endpoint | Redirect/JSON (controller-dependent) |

### Transactions Module

#### Resource Endpoints

| Method | Endpoint | Auth | Description | Response |
|---|---|---|---|---|
| GET | `/transactions` | Auth + role | List transactions (search/date/status/sort; AJAX partial supported) | HTML view/partial |
| GET | `/transactions/create` | Auth + role | Render transaction create form | HTML view |
| POST | `/transactions` | Auth + role | Create transaction/payment entry | Redirect |
| GET | `/transactions/{transaction}` | Auth + role | Show transaction detail | HTML view/partial |
| GET | `/transactions/{transaction}/edit` | Auth + role | Resource route available (UI implementation may vary) | HTML view (if implemented) |
| PUT/PATCH | `/transactions/{transaction}` | Auth + role | Update payment amount and recompute running balance | JSON |
| DELETE | `/transactions/{transaction}` | Auth + role | Resource route available | Redirect/JSON |

### Common HTTP Behaviors

- Validation errors usually return redirect responses with flashed errors for form routes.
- AJAX list endpoints return HTML partials and may include `X-Has-More` header for infinite scroll.
- Unauthorized access to protected modules returns `403 Unauthorized`.

---

## Getting Started

### 1) Prerequisites

- PHP 8.2+
- Composer
- Node.js + npm
- Database engine supported by Laravel (MySQL recommended)

### 2) Install and Bootstrap

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
```

### 3) Run in Development

```bash
composer run dev
```

This starts Laravel server, queue listener, and Vite concurrently.

### 4) Build Frontend Assets

```bash
npm run build
```

### 5) Run Tests

```bash
composer test
```

---

## Seeded Demo Accounts (Development Only)

If you run database seeders, sample users are created:

- Dentist: `jo.admin@sample.dev` / `admin123`
- Staff: `tj.admin@sample.dev` / `admin123`
- Patient: `rt.patient@sample.dev` / `patient123`

Use these credentials **only for local development/testing**.

---

## Project Structure (Key Directories)

- `app/Http/Controllers` - request handling and business flow
- `app/Models` - Eloquent models and relationships
- `app/Http/Middleware` - auth and role guards
- `routes/web.php` - web routes
- `resources/views` - Blade templates/components/pages
- `database/migrations` - schema history
- `database/seeders` - development data
- `config/navigation.php` - top navigation links

---

## Typical User Workflow

1. Staff logs in.
2. Staff creates or searches a patient profile.
3. Staff schedules an appointment with assigned dentist.
4. Dentist/staff records procedures and medical form details during/after visit.
5. System generates ledger entries and accepts payment transactions.
6. Staff reviews patient summary, upcoming appointments, and outstanding balances.

---

## Notes and Current Scope

- The app is primarily designed for internal clinic users (staff/dentist).
- Role checks are currently strict and intentional on protected routes.
