# gobanan

> A Fiverr-style freelance-services marketplace, revived on Laravel 12 + React 19 + Inertia.

[![CI](https://github.com/zzeordyga/gobanan/actions/workflows/ci.yml/badge.svg)](https://github.com/zzeordyga/gobanan/actions/workflows/ci.yml)
[![Live demo](https://img.shields.io/badge/live%20demo-fly.io-brand)](https://gobanan.fly.dev)

## Stack

- **Laravel 12** (PHP 8.4), **Breeze React** authentication via **Inertia.js**
- **React 19 + Vite 6 + Tailwind 4** on a shared design system (dark/light, responsive)
- **Sanctum 4**, **Pint**, **Larastan** (PHPStan level 3), **PHPUnit 11**

## Features

- Browse and search services, filter by category, paginated grids
- Service cards with ratings, seller avatars, lazy-loaded images
- Service detail with purchase rail, reviews (star rating), similar items
- Cart → checkout → transactions; sellers can mark orders done
- Admin dashboard (categories, services, reviews, transactions, users, roles)
- Email **or** username login, 18+ date-of-birth registration, admin role guard
- Dark/light mode persisted to localStorage, system-aware by default

## Local development

```bash
cp .env.example .env
php artisan key:generate
touch database/database.sqlite           # sqlite is the default for dev
php artisan migrate:fresh --seed        # admin + demo seller + sample data
npm install && npm run dev              # Vite (React + Tailwind 4)
php artisan serve                      # http://127.0.0.1:8000
```

Demo logins (after seeding): `admin@gobanan.test` / `password`, `seller@gobanan.test` / `password`.

## Verify

```bash
php artisan test          # 45 tests
vendor/bin/pint --test    # lint
vendor/bin/phpstan analyse --no-progress
npm run build             # frontend production build
```

## Deploy

Containerized (`Dockerfile`) and shipped to **Fly.io** via GitHub Actions on
push to `main` (image published to GHCR, migrations run on release). See
`.github/workflows/deploy.yml` and `fly.toml`. The same image runs on AWS
(ECS Fargate + RDS) with a deploy-target swap only.