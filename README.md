# Translation Management Service

## Overview
This project is an API-driven Translation Management Service built using Laravel.
It is designed to demonstrate clean architecture, scalability, performance
optimization, and security best practices.

The service allows managing translations across multiple locales, tagging them
for context, and exporting them efficiently for frontend applications.

---

## Features
- Multi-locale translation support (en, fr, es, extensible)
- Tag-based translation context (mobile, desktop, web)
- CRUD and search APIs
- JSON export endpoint for frontend apps (Vue.js / React)
- Token-based authentication
- High-performance optimized queries
- Database seeding for 100k+ records
- Docker support
- Swagger / OpenAPI documentation
- Unit, Feature, and Performance tests

---

## Tech Stack
- Laravel 10
- PHP 8.1+
- MySQL 8
- Redis (cache)
- Laravel Sanctum (API authentication)
- Docker

---

## Architecture
The project follows SOLID principles:

- **Controllers**: Thin, handle HTTP requests only
- **Services**: Business logic
- **Repositories**: Database query abstraction
- **Models**: Eloquent ORM

This separation ensures testability, scalability, and clean code.

---

## Database Schema
- `locales` – Supported languages
- `translations` – Translation key/value pairs
- `tags` – Context tags
- `translation_tag` – Pivot table (many-to-many)

Indexes and FULLTEXT search are used to ensure fast queries.

---

## Performance Strategy
- Indexed columns for filtering
- FULLTEXT search for content
- Redis caching for JSON export
- Cache invalidation on create/update/delete
- Optimized select queries
- Pagination for large result sets

### Benchmarks
- CRUD APIs: < 200ms
- JSON Export (100k+ records): < 500ms

---

## Authentication
- Token-based authentication using Laravel Sanctum
- Stateless API
- All endpoints protected via `auth:sanctum`

---

## Setup Instructions

### 1. Clone Repository
```bash
git clone <your-repo-url>
cd translation-service

## 2. Install Dependencies
composer install

##3. Environment Setup
cp .env.example .env
php artisan key:generate

##4. Run Migrations
php artisan migrate:fresh --seed


##5. Seed Large Dataset (Optional)

php artisan translations:seed 100000

## 6. Run Application

php artisan serve

##API Documentation Swagger/OpenAPI specification is available in:
openapi.yaml

## Testing
php artisan test

## Docker Setup (Optional)
docker-compose up -d

