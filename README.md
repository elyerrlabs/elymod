# Elymod

**Elymod** is a lightweight modular mini-framework inspired by Laravel.

It is designed to build **fully independent third-party modules** that integrate with the **OAuth2 Passport Server ecosystem** while remaining isolated from the core application.

Elymod behaves like a **minimal Laravel runtime**, providing only the features required to develop, test, and distribute modules without depending on a full Laravel application.

---

# Compatibility

Elymod is fully compatible with **OAuth2 Passport Server v7 and later (v7+)**.

Starting with OAuth2 Passport Server v7, the host application uses **Vite** as its default asset bundler. However, Elymod maintains support for both **Laravel Mix** and **Vite** when creating and developing third-party modules.

Supported asset drivers:

* Vite (default)
* Laravel Mix (legacy support)

This allows existing modules to continue using Laravel Mix while enabling new modules to adopt Vite.

---

# Creating Modules

Modules can be generated directly from OAuth2 Passport Server using the built-in module generator.

### Create a module using Vite (default)

```bash
php artisan module:make UserAccount
```

or explicitly:

```bash
php artisan module:make UserAccount --driver=vite
```

### Create a module using Laravel Mix

```bash
php artisan module:make UserAccount --driver=mix
```

The selected driver determines the frontend build environment and generated project structure.

> Driver selection is available only in **OAuth2 Passport Server v7+**.

---

# Supported Drivers

## Vite (Default)

Recommended for all new modules.

Features:

* Fast development server
* Hot Module Replacement (HMR)
* Modern ES modules
* Optimized production builds
* Official asset pipeline for OAuth2 Passport Server v7+

### Development

```bash
npm ci
npm run build
```

---

## Laravel Mix

Maintained for backward compatibility.

Features:

* Webpack-based workflow
* Compatible with existing modules
* Legacy asset compilation support
* Migration-friendly environment

### Development

```bash
npm ci
npm run dev
```

> Although Laravel Mix is no longer used by the OAuth2 Passport Server host application, support remains available for third-party modules developed with Elymod.

---

# What is Elymod?

Elymod is both:

* 🧩 A mini Laravel runtime for third-party module development
* 🏗️ A modular mini-framework focused on isolation and portability
* 🔐 A foundation for extending OAuth2 Passport Server ecosystems

It allows developers to create modules that feel like Laravel applications while remaining fully decoupled from the core platform.

---

# Core Features

* 🚀 Powered by `laravel-runtime`
* 📦 Modules behave like standalone Laravel applications
* 🧩 Designed exclusively for third-party modules
* 🛡️ Fail-safe architecture: module failures do not affect the core system
* 🔁 Dynamic loading of:

  * Routes
  * Menus
  * Middleware
  * Rate limits
  * Feature flags
* 🔐 Built for OAuth2 and Passport-based authorization platforms
* 🏗️ Compatible with enterprise modular architectures

---

# Laravel Runtime Integration

Elymod uses **`elyerr/laravel-runtime`** during development to provide:

* Route registration
* Middleware resolution
* View rendering
* Resource generation
* Controller generation
* Request generation
* Policy generation

This provides a familiar Laravel experience while keeping the runtime lightweight.

> Elymod does not require a full Laravel installation in production environments.

---

# Dependencies

## Runtime / Core

### `elyerr/api-response`

Provides a unified response layer for both API and web responses.

### Transformer

Required by `api-response` to ensure structured and predictable outputs across modules.

---

## Development

### `laravel/framework`

Used only during local development, testing, and tooling.

### `elyerr/laravel-runtime`

Provides Laravel-like functionality without requiring a full Laravel application.

---

# Why Elymod?

Elymod solves common challenges in modular development:

* ❌ Tight coupling to the host application
* ❌ Heavy framework dependencies
* ❌ Fragile upgrades and forks
* ❌ Poor module isolation
* ❌ Difficult long-term maintenance

With Elymod, modules are:

* Independent
* Portable
* Versionable
* Safe to install or remove
* Isolated from core system failures

---

# Designed for OAuth2 Passport Server v7+

Elymod is optimized for OAuth2 Passport Server environments where:

* Authentication and authorization remain centralized
* Third-party modules evolve independently
* Security and isolation are mandatory
* Platform upgrades should not break extensions

Each module manages its own:

* Routes
* Views
* Policies
* Middleware
* Configuration
* Frontend assets
* Internal lifecycle

while remaining isolated from the host application.

---

# Development Philosophy

> The platform owns authentication and authorization.
> Modules own their business logic.

This separation allows the platform and its extensions to evolve independently while maintaining stability, security, and long-term maintainability.

---

# License

MIT License.

Individual modules may define their own licenses and distribution terms.

---

# Author

**Elvis Yerel Roman Concha**

Email: [yerel9212@yahoo.es](mailto:yerel9212@yahoo.es)

---

# Ecosystem

* OAuth2 Passport Server
* Elymod
* Laravel Runtime
* Third-party Elymod Modules

---

Elymod provides a clean, predictable, and Laravel-like environment for building independent modules without compromising platform stability, security, or maintainability.
