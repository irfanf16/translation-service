# Translation Management Service

**Laravel 12 REST API microservice** for managing application translation strings. Stores key/value translation pairs per locale with tag-based categorization, full-text search, and exports as flat JSON objects. Redis-cached export endpoint tested to respond under 500ms.

![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel)
![Laravel Sanctum](https://img.shields.io/badge/Sanctum-Auth-FF2D20?style=flat&logo=laravel)
![Redis](https://img.shields.io/badge/Redis-Cache-DC382D?style=flat&logo=redis)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=flat&logo=mysql)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat&logo=docker)
![OpenAPI](https://img.shields.io/badge/OpenAPI-3.0-85EA2D?style=flat&logo=swagger)

## Features

- **Translation CRUD** — create/update translations (key, content, locale)
- **Locale Management** — pre-seeded: English (`en`), French (`fr`), Spanish (`es`)
- **Tag System** — many-to-many tags per translation; synced on create/update
- **Search** — filter by key (LIKE), locale code, tag name, content (MySQL full-text index); paginated 50/page
- **Export** — `GET /api/translations/export/{locale}` returns `{ key: content }` JSON; Redis-cached 60s; cache invalidated on write
- **Performance Test** — `TranslationPerformanceTest` asserts export < 500ms
- **Repository Pattern** — `TranslationRepository` for queries; `TranslationService` for tag sync + cache
- **Sanctum Auth** — all endpoints require `Authorization: Bearer {token}`
- **Docker** — `docker-compose.yml` with `app`, `mysql:8`, `redis:alpine`
- **OpenAPI** — full `openapi.yaml` spec included

## Database Schema

| Table | Key Columns | Purpose |
|---|---|---|
| `locales` | `id`, `code`, `name` | Supported languages |
| `translations` | `id`, `key` (indexed), `locale_id`, `content` (full-text indexed) | Translation strings |
| `tags` | `id`, `name` | Tag definitions |
| `translation_tag` | `translation_id`, `tag_id` | Pivot table |

## API Endpoints (all require Bearer token)

| Method | Endpoint | Description |
|---|---|---|
| `POST` | `/api/translations` | Create translation (key, content, locale_id, tags[]) |
| `PUT` | `/api/translations/{id}` | Update translation |
| `GET` | `/api/translations/{id}` | Get single translation |
| `GET` | `/api/translations/search` | Search (key/locale/tag/content) |
| `GET` | `/api/translations/export/{locale}` | Export flat JSON for locale (Redis-cached) |

## Getting Started

```bash
# Docker
cp .env.example .env && docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan migrate --seed

# Local
composer install   # or: composer run setup (installs, migrates, builds)
cp .env.example .env && php artisan key:generate
php artisan migrate --seed   # seeds en/fr/es locales
php artisan serve

# Run tests
php artisan test   # includes TranslationPerformanceTest
```

## License
MIT
