# AGENTS.md

# MediNote – AI Medical Practice Management System

## Project Overview

MediNote is an AI-powered medical practice management system built to reduce physicians' administrative workload after each consultation.

Instead of manually organizing consultation notes into structured medical records, physicians can write their observations in free text. An AI assistant analyzes the note and generates a structured consultation containing the consultation reason, symptoms, observations, diagnosis, prescriptions, follow-up information, and a medical summary.

The AI acts only as an assistant. It never replaces the physician and never makes autonomous medical decisions. Every AI-generated consultation must be reviewed, edited if necessary, and validated by the physician before being permanently stored.

The application also provides patient management, appointment scheduling, consultation history, dashboard statistics, and role-based access control for doctors and assistants.

---

# Problem Statement

After every consultation, physicians spend several minutes performing administrative work instead of focusing on patient care.

A physician typically writes consultation notes in free text and must then manually structure the information into the patient's medical record.

This repetitive process:

- takes valuable time
- increases administrative workload
- may lead to missing important medical information
- reduces consultation efficiency

The goal of MediNote is to automate the structuring of consultation notes using Artificial Intelligence while keeping the physician fully responsible for validating the generated medical record.

---

# Project Objectives

The project aims to:

- Reduce physicians' administrative workload.
- Speed up consultation documentation.
- Improve medical record consistency.
- Preserve physician validation before persistence.
- Demonstrate the integration of Artificial Intelligence into a Laravel application.
- Showcase Specification-Driven Development using OpenSpec.
- Showcase Laravel AI, Laravel Boost, Scribe, Sanctum, Queues, Jobs and REST APIs.

---

# User Roles

## Doctor

The doctor has complete access to the system.

Responsibilities include:

- Manage patients
- Manage appointments
- Start consultations
- Write consultation notes
- Launch AI analysis
- Review AI-generated consultations
- Edit generated information
- Validate consultations
- Access consultation history
- Export consultations
- View dashboard statistics

The doctor is the only user allowed to validate AI-generated consultations.

---

## Assistant

The assistant is responsible for administrative tasks only.

Responsibilities include:

- Manage patients
- Create appointments
- Update appointments
- Cancel appointments
- Search patients
- View dashboard

The assistant cannot:

- Start consultations
- Access AI features
- Modify structured consultations
- Validate consultations
- Access physician-only medical features

---

# Project Scope

The application includes the following modules.

## Authentication

- User registration
- User login
- User logout
- Role-based authorization

---

## Patient Management

Users with the appropriate permissions can:

- Create patients
- Update patient information
- Delete patients
- Search patients
- View patient list

---

## Appointment Management

Users with the appropriate permissions can:

- Schedule appointments
- Update appointments
- Cancel appointments
- Filter appointments by date
- View appointment calendar

---

## Consultation Management

Doctors can:

- Start a consultation from an appointment
- Write a free-text consultation note
- Submit the note for AI analysis
- Review the generated consultation
- Edit generated data
- Validate the consultation

---

## Artificial Intelligence

The AI assistant can:

- Analyze consultation notes
- Extract structured medical information
- Detect missing information
- Generate consultation summaries
- Produce valid structured JSON
- Compare consultations (Bonus)

---

## Medical History

Doctors can:

- View consultation history
- Review validated consultations
- View the patient's medical timeline (Bonus)

---

## Dashboard

Doctors and assistants can view:

- Number of patients
- Number of appointments
- Number of consultations
- Daily activity statistics

---

## Export

Doctors can export validated consultations as PDF documents.

---

# Non-Goals

MediNote is **not** intended to become a complete Hospital Information System (HIS).

The project focuses exclusively on demonstrating how Artificial Intelligence can automate the transformation of free-text consultation notes into structured medical records while preserving human validation.

# Business Workflow

The application follows the workflow below.

## Appointment Workflow

1. An assistant or a doctor creates an appointment for a patient.
2. The patient arrives at the scheduled appointment.
3. The doctor starts a consultation from that appointment.

---

## Consultation Workflow

1. The doctor starts a consultation linked to an appointment.
2. The doctor writes a free-text medical note.
3. The note is stored inside the **TextBrut** table.
4. A Laravel Job sends the note to the AI Agent.
5. The AI analyzes the note.
6. The AI returns a structured consultation as valid JSON.
7. The doctor reviews the generated consultation.
8. The doctor edits generated information if necessary.
9. The doctor validates the consultation.
10. The structured consultation is saved.
11. Prescriptions are created.
12. If a follow-up date exists, a new appointment may be scheduled.

The physician always remains responsible for validating the consultation before it is permanently stored.

---

# Database Model

The project is intentionally designed with separated entities to keep the raw medical note independent from the structured consultation generated by AI.

## Entities

- User
- Patient
- Appointment
- TextBrut
- Consultation
- Prescription

---

# Database Relationships

User

1 ------ N Patients

Patient

1 ------ N Appointments

Appointment

1 ------ 1 TextBrut

TextBrut

1 ------ 1 Consultation

Consultation

1 ------ N Prescriptions

---

# Entity Responsibilities

## User

Represents authenticated users.

Supported roles:

- doctor
- assistant

Doctors have full access.

Assistants only manage administrative operations.

---

## Patient

Stores patient personal information.

Examples:

- First name
- Last name
- Birth date
- Gender
- Phone number
- Address

Each patient belongs to one doctor.

A patient can have multiple appointments.

---

## Appointment

Represents a scheduled medical appointment.

Contains:

- appointment date
- appointment time
- appointment status

An appointment is linked to one patient.

Each appointment can generate exactly one consultation.

---

## TextBrut

Stores the original consultation note written by the doctor.

This table contains only the raw text entered before AI processing.

The content is never modified automatically.

It remains available for auditing and traceability.

---

## Consultation

Stores the validated structured consultation generated by AI.

Contains:

- consultation reason
- observations
- diagnosis
- follow-up
- AI summary
- validation status

The consultation is created only after AI processing.

---

## Prescription

Stores medications prescribed during the consultation.

Each consultation may contain multiple prescriptions.

Each prescription contains:

- medication name
- dosage
- frequency
- duration

---

# Functional Workflow

Doctor

↓

Appointment

↓

Start Consultation

↓

Write Free Text Note

↓

Save TextBrut

↓

Laravel Job

↓

Laravel AI Agent

↓

Structured JSON

↓

Doctor Review

↓

Doctor Validation

↓

Save Consultation

↓

Create Prescriptions

↓

(Optional) Schedule Follow-up Appointment

---

# User Stories

## Authentication

US1 — Register

As a user,
I want to create an account,
So that I can access the application.

---

US2 — Login

As a user,
I want to authenticate,
So that I can access features according to my role.

---

US3 — Logout

As a user,
I want to log out,
So that my account remains secure.

---

# Patient Management

US4 — Create Patient

As an assistant or doctor,
I want to register a new patient,
So that a medical record can be created.

---

US5 — Update Patient

As an assistant or doctor,
I want to update patient information,
So that medical records remain accurate.

---

US6 — Delete Patient

As an assistant or doctor,
I want to remove a patient,
So that obsolete records are deleted.

---

US7 — List Patients

As an assistant or doctor,
I want to view all patients,
So that I can quickly find a patient.

---

US8 — Search Patient

As an assistant or doctor,
I want to search patients by name,
So that I can access their records faster.

---

# Appointment Management

US9 — Create Appointment

As an assistant or doctor,
I want to schedule an appointment,
So that consultations can be organized.

---

US10 — Update Appointment

As an assistant or doctor,
I want to modify an appointment,
So that scheduling changes can be managed.

---

US11 — Cancel Appointment

As an assistant or doctor,
I want to cancel an appointment,
So that the time slot becomes available.

---

US12 — View Appointments

As an assistant or doctor,
I want to view appointments,
So that I know upcoming consultations.

---

US13 — Filter Appointments

As an assistant or doctor,
I want to filter appointments by date,
So that I can quickly find scheduled consultations.

---

# Consultation Management

US14 — Start Consultation

As a doctor,
I want to start a consultation from an appointment,
So that I can begin examining the patient.

---

US15 — Write Free-Text Consultation Note

As a doctor,
I want to write a consultation note in free text,
So that AI can analyze it later.

---

US16 — View Consultation

As a doctor,
I want to view validated consultations,
So that I can follow the patient's medical history.

# AI Features

## AI User Stories

US17 — Generate Structured Consultation

As a doctor,
I want to send a free-text consultation note to the AI,
So that I automatically receive a structured consultation.

---

US18 — Extract Medical Information

As a doctor,
I want the AI to extract the consultation reason, symptoms, observations, diagnosis, prescriptions, and follow-up information,
So that I save time documenting consultations.

---

US19 — Detect Missing Information

As a doctor,
I want the AI to identify important missing information,
So that I can complete the consultation before validation.

---

US20 — Generate Consultation Summary

As a doctor,
I want an automatic consultation summary,
So that I can quickly understand the consultation outcome.

---

US21 — Track AI Analysis Status

As a doctor,
I want to know whether the AI analysis is pending, processing, completed, or failed,
So that I know when the consultation is ready for review.

---

# Validation

US22 — Edit Generated Consultation

As a doctor,
I want to edit the AI-generated consultation,
So that I can correct or complete the generated information before validation.

---

US23 — Validate Consultation

As a doctor,
I want to validate the structured consultation,
So that only verified medical information is permanently stored.

---

# Medical History

US24 — View Patient Medical History

As a doctor,
I want to view all previous consultations,
So that I can monitor the patient's medical evolution.

---

# Dashboard

US25 — View Dashboard

As a doctor or assistant,
I want to access a dashboard,
So that I can quickly view important medical practice statistics.

---

# Bonus Features

US26 — Compare With Previous Consultation

As a doctor,
I want AI to compare the current consultation with the previous one,
So that changes in the patient's condition are easier to identify.

---

US27 — Export Consultation

As a doctor,
I want to export a consultation as PDF,
So that I can print or share it.

---

US28 — Medical Timeline

As a doctor,
I want to visualize consultations as a timeline,
So that I can better understand the patient's medical history.

---

# Technical Stack

## Backend

- Laravel 13
- PHP 8.3
- REST API
- MVC Architecture
- Service Layer
- Repository Pattern only when necessary

---

## Database

- MySQL
- Laravel Migrations
- Eloquent ORM
- Foreign Keys
- Soft Deletes where appropriate

---

## Authentication

- Laravel Sanctum
- Protected API Routes
- Form Requests
- Role-based Authorization

Roles:

- doctor
- assistant

---

## Frontend

- React JS
- JavaScript (No TypeScript)
- Tailwind CSS
- Axios
- React Router

The frontend communicates exclusively through the REST API.

---

# Artificial Intelligence

The application uses the official Laravel AI SDK.

Compatible providers include:

- Groq
- OpenAI

The AI receives a free-text consultation note and returns a structured JSON response.

No AI-generated consultation may be saved without physician validation.

---

# AI Architecture

## Layer 1 — AI Agent

The application uses a Laravel AI Agent.

The Agent has access to manually implemented Laravel Tools.

Available tools include:

- getPatientHistory(patientId)
- getCurrentMedications(patientId)
- getPatientAllergies(patientId)
- saveStructuredConsultation(consultation)

The agent should use these tools whenever additional patient context is required.

---

## Layer 2 — Conversation Memory

Laravel AI Conversation Memory is enabled.

Memory should be used to:

- preserve consultation context
- avoid asking repeated questions
- improve conversation consistency

Conversation memory must never replace the patient's permanent medical history stored in the database.

---

## Layer 3 — Structured Output

Every AI response must follow this exact JSON schema.

```json
{
  "motif": "string",
  "symptomes": [
    "string"
  ],
  "observations": "string",
  "diagnostic": "string | null",
  "prescriptions": [
    {
      "medicament": "string",
      "dosage": "string | null",
      "frequence": "string | null",
      "duree": "string | null"
    }
  ],
  "suivi": {
    "date": "YYYY-MM-DD | null",
    "commentaire": "string | null"
  },
  "resume": "string"
}
```

The AI must always return valid JSON.

No Markdown.

No explanations.

No additional text.

---

# Asynchronous Processing

AI requests must always run asynchronously using:

- Laravel Jobs
- Laravel Queues

The frontend must display the current processing status:

- Pending
- Processing
- Completed
- Failed

---

# API Documentation

The REST API must be documented using Scribe.

Requirements:

- PHPDoc annotations
- Auto-generated documentation
- Up-to-date documentation
- Postman Collection

---

# Laravel Boost

Laravel Boost is installed.

Generated code should leverage:

- project structure
- routes
- migrations
- models
- installed packages
- application conventions

---

# OpenSpec

The project follows Specification-Driven Development.

Every feature must be developed using OpenSpec.

Workflow:

Proposal

↓

Specification

↓

Tasks

↓

Implementation

↓

Validation

No feature should be implemented before its specification is approved.

---

# Development Rules

Always create:

- Migration
- Model
- Controller
- Service
- Form Request
- API Resource
- Policy (if needed)
- Job (for AI processing)
- Tests (when applicable)

Controllers must remain thin.

Business logic belongs inside Services.

AI logic belongs inside dedicated Agents and Actions.

Never call AI directly from Controllers.

Use Dependency Injection.

Use API Resources.

Centralize exception handling.

Follow Laravel best practices.

---

# Code Quality

The project should follow:

- SOLID principles
- Clean Architecture concepts
- Separation of Concerns
- DRY
- KISS

Avoid:

- Fat Controllers
- Duplicate code
- Business logic inside Models
- Direct database queries inside Controllers

---

# Definition of Done

A feature is considered complete only if:

- OpenSpec specification exists
- Database migration completed
- Model implemented
- Validation implemented
- Service implemented
- API endpoints implemented
- API Resource created
- Authorization configured
- AI integration completed (if applicable)
- Queue processing implemented
- Documentation updated
- Feature tested

---

# AI Rules

The AI is an assistant.

It must never:

- make medical decisions
- invent patient information
- prescribe treatments autonomously
- modify stored data automatically
- validate consultations

The AI should only:

- organize information
- extract medical data
- summarize consultations
- detect missing information
- generate structured output

The physician always remains responsible for reviewing and validating every consultation.

---

# Project Goal

The objective of MediNote is not to build a complete Hospital Information System.

The objective is to demonstrate how Artificial Intelligence can significantly reduce physicians' administrative workload by transforming free-text consultation notes into structured medical records while keeping the physician fully responsible for reviewing and validating all generated data before persistence.