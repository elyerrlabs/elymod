# Elymod

**Elymod** is a lightweight modular mini-framework inspired by Laravel.  
It is designed to build **fully independent third-party modules** that integrate with the
[oauth2-passport-server](https://github.com/elyerr/oauth2-passport-server) ecosystem.

Elymod behaves like a **minimal Laravel runtime**, providing only the required features
to develop, test, and distribute modules without depending on a full Laravel application.

---

## 🧠 What is Elymod?

Elymod is both:

- 🧩 A **mini Laravel runtime** for third-party module development
- 🏗️ A **modular mini-framework** focused on isolation and portability
- 🔐 A foundation for extending OAuth2 / Passport-based systems

It allows developers to create modules that *feel* like Laravel applications,
while remaining **decoupled from the system core**.

---

## ⚙️ Core Features

- 🚀 Powered by **laravel-runtime** to simplify resource creation
- 📦 Modules behave like standalone Laravel applications
- 🧩 Designed exclusively for **independent / third-party modules**
- 🛡️ Fail-safe by design: a module failure never crashes the system
- 🔁 Dynamic loading of:
  - Routes
  - Menus
  - Rate limits
  - Middleware
  - Feature flags
- 🔐 Built with OAuth2 / Passport servers in mind

---

## 🧩 Laravel Runtime Integration

Elymod uses **`elyerr/laravel-runtime`** during development to provide:

- Route registration
- Middleware resolution
- View rendering
- Resource creation (controllers, requests, etc.)

This enables a familiar Laravel workflow while keeping the runtime minimal.

> Elymod does **not** require a full Laravel installation in production.

---

## 📦 Dependencies

### Runtime / Core
- **`elyerr/api-response`**  
  Provides a unified and consistent response layer for both API and web outputs.

- **Transformer (required by api-response)**  
  Ensures controlled, predictable, and structured data output across all responses.

### Development
- **`laravel/framework`** (development only)  
  Used for local development, testing, and tooling.

- **`elyerr/laravel-runtime`**  
  Provides Laravel-like behavior without framework overhead.

---

## 🧪 Why Elymod?

Elymod solves common problems when developing third-party extensions:

- ❌ Tight coupling to the host system
- ❌ Mandatory framework dependencies
- ❌ Fragile forks and long-term maintenance
- ❌ Limited control over module lifecycle

With Elymod, modules can be:
- Developed independently
- Distributed as standalone packages
- Installed or removed safely
- Maintained without affecting the system

---

## 🔐 Designed for OAuth2 Passport Servers

Elymod is optimized for platforms like **oauth2-passport-server**, where:

- Authorization logic must remain stable
- Third-party modules evolve independently
- Isolation and security are mandatory

Each module controls its own:
- Routes
- Policies
- Scopes
- Internal lifecycle

---

## 📜 License

Elymod is licensed under the **MIT License**.

> Individual modules may define their own licenses and usage terms.

---

## 👤 Author

**Elvis Yerel Roman Concha**  
📧 Email: [yerel9212@yahoo.es](mailto:yerel9212@yahoo.es)

---

Elymod provides a clean, predictable, and Laravel-like environment for building
**independent modules without compromising system stability**.
