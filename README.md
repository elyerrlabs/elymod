# Elymod

**Elymod** is the official **module installer and generator** for the OAuth2 Passport Server modular ecosystem.

It is not the runtime itself — it is the **entry point for creating and scaffolding modules**.

Elymod works together with:

- **elymod-app** → Module skeleton (base structure for every module)
- **elyscope** → Composer + PHP-Scoper bridge/wrapper for dependency isolation
- **elyerr/laravel-runtime** → Lightweight Laravel-like runtime
- **OAuth2 Passport Server v8** → Core platform (host system)

Together, these components form a **modular mini-framework ecosystem** designed for scalable enterprise extensions.

---

# Architecture Overview

Elymod is the **installer + generator layer** of the ecosystem.

When a module is created:

1. Elymod generates the module using **elymod-app (skeleton)**
2. Dependencies are installed and resolved via **Composer**
3. **elyscope** processes dependencies:
   - wraps Composer resolution
   - applies PHP-Scoper transformations
   - rewrites namespaces into isolated module scope
4. The module runs on top of **elyerr/laravel-runtime**
5. OAuth2 Passport Server v8 registers the module

This produces a fully isolated module with its own namespace:

```
ModuleName\Vendor\Package
```

No collisions. No shared vendor pollution. Fully encapsulated execution.

---

# What Elymod Solves

Traditional modular systems in large PHP/Laravel ecosystems suffer from:

- ❌ Dependency collisions between modules
- ❌ Shared vendor pollution
- ❌ Tight coupling to the host application
- ❌ Hard upgrades and maintenance
- ❌ No real isolation between teams/modules
- ❌ Fragile plugin architectures

Elymod solves this by introducing a **fully isolated modular pipeline**.

---

# Ecosystem Components

## 🔧 Elymod (Installer & Generator)

Responsible for:

- Creating modules
- Bootstrapping module structure
- Orchestrating dependency pipeline
- Connecting all ecosystem tools
- Registering modules into OAuth2 Passport Server v8

---

## 📦 elymod-app (Skeleton)

A standardized module blueprint that includes:

- Laravel-like structure (lightweight)
- Prebuilt service container setup
- Routing, config, and lifecycle structure
- OAuth2 Passport Server integration layer
- Ready-to-run module foundation

Every module starts from this skeleton.

---

## 🧠 elyscope (Composer + PHP-Scoper Bridge)

**elyscope is not just PHP-Scoper.**

It is a **hybrid orchestration layer** between Composer and PHP-Scoper.

It is responsible for:

- Intercepting Composer dependency resolution
- Installing dependencies per module scope
- Running PHP-Scoper transformations
- Rewriting namespaces into isolated module space
- Ensuring dependency graph isolation per module

Example transformation:

```
Original:
Vendor\Package\Class

Scoped:
ModuleName\Vendor\Package\Class
```

It acts as a **bridge between dependency management and isolation engine**, ensuring both worlds work together.

---

## ⚙️ Laravel Runtime (Execution Layer)

**elyerr/laravel-runtime** provides a lightweight Laravel-like environment:

- Routing system
- Controllers lifecycle
- Middleware pipeline
- Service container abstraction
- Views rendering
- Policy execution

It allows modules to behave like Laravel apps without requiring full Laravel.

---

## 🧩 OAuth2 Passport Server v8 (Host System)

The core platform responsible for:

- Authentication (OAuth2)
- Authorization
- Module registry
- Module lifecycle management
- System security and integrity

---

# Module Flow (How it works)

When a module is created:

```bash
php artisan module:make BlogModule
```

The system executes:

1. Elymod generates structure using **elymod-app**
2. Composer installs dependencies
3. **elyscope** wraps Composer + applies PHP-Scoper isolation
4. Module is fully namespaced and sandboxed
5. Laravel runtime initializes execution layer
6. OAuth2 Passport Server registers module

---

# Module Structure Output

Each module is fully isolated:

```
BlogModule/
├── app
├── artisan
├── bootstrap
├── composer.json
├── composer.lock
├── config 
├── database
├── lang
├── package-lock.json
├── package.json
├── postcss.config.js
├── public 
├── resources
├── routes
│   ├── admin.php
│   ├── api.php
│   ├── console.php
│   ├── public.php
│   └── web.php
├── scoper.inc.php
├── storage
│   └── logs
├── temp
├── tests
│   ├── Feature
│   │   └── ExampleTest.php
│   ├── TestCase.php
│   └── Unit
│       └── ExampleTest.php
└── vite.config.js
```

All dependencies are rewritten into module scope:

```
BlogModule\Vendor\Package
```

No global dependency leakage.

---

# Key Benefits

### 🧩 True modular architecture

Modules behave like independent applications.

### 🔐 Full dependency isolation

Each module has its own scoped dependency tree.

### ⚙️ Hybrid dependency system

Composer + PHP-Scoper combined via elyscope bridge.

### ⚡ Lightweight execution layer

Runs on laravel-runtime instead of full Laravel stack.

### 📦 Portable modules

Modules can be moved between environments safely.

### 🏗️ Enterprise scalability

Designed for large organizations and multi-team systems.

### 🔁 Plug-and-play lifecycle

Install, enable, disable, remove without breaking the system.

---

# Why this ecosystem exists

As systems built on OAuth2 Passport Server grow, they face:

- Feature sprawl across teams
- Dependency conflicts
- Tight coupling between modules
- Difficult upgrade cycles
- Lack of isolation boundaries

This ecosystem solves it by introducing:

> A fully isolated modular architecture where dependency management and scoping are unified through elyscope.

---

# Development Philosophy

> The core system owns identity and security.  
> Modules own everything else.

This ensures:

- Stable authentication layer
- Independent feature evolution
- Safe scaling across organizations
- Zero coupling between teams

---

# License

MIT License.

Modules generated by Elymod may define their own licensing terms.

---

# Ecosystem Summary

- OAuth2 Passport Server v8 → Core platform
- Elymod → Installer & module generator
- elymod-app → Module skeleton
- elyscope → Composer + PHP-Scoper bridge
- laravel-runtime → Lightweight execution layer

---

Elymod is not just a generator.

It is the entry point to a **fully isolated modular ecosystem** designed for enterprise-scale systems built on OAuth2 Passport Server v8.
