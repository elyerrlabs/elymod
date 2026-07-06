# Changelog

## [v3.0.3]

- Fix file processing to replace `Elymod` placeholders with the new module name.
- Update `composer.json` template.

---

## [v3.0.2]

- Fix Composer state before module generation to prevent autoload collisions

---

## [v3.0.1]

- fix packagist installer

---

## [v3.0.0]

### Changed

- Migrated project scaffolding to external skeleton repository (`elymod-app`).
- Removed internal `stubs` system in favor of centralized template management.
- Installer now relies entirely on `elymod-app` as the single source of truth for module structure.
- Simplified module creation flow by removing Laravel Mix / Vite driver selection.
- Standardized all module generation to use the Elymod App template.
- Updated installer to support remote skeleton retrieval and processing.

### Removed

- Removed support for Laravel Mix frontend driver.
- Removed support for Vite/Mix selection logic in module generation.
- Removed internal stub-based scaffolding system.

### Improved

- Cleaner and more maintainable module creation pipeline.
- Centralized template versioning via `elymod-app`.
- Reduced duplication between Elymod core and module skeleton.
- Improved consistency across generated modules.
- Better separation of responsibilities between installer and skeleton.

### Notes

- Elymod now depends entirely on the `elymod-app` repository for module structure.
- Future structural changes must be done inside `elymod-app`.
- Installer is now responsible only for orchestration (clone, replace, setup), not scaffolding logic.

---

## [v2.0.0]

### Added

- Added support for **Vite** as a frontend asset driver for Elymod modules.
- Added the new `--driver` option to the module generator.
- Added support for the following drivers:
  - `vite` (default)
  - `mix`

- Added dedicated stub templates for each supported driver:
  - `stubs/vite`
  - `stubs/mix`

- Added automatic driver selection during module creation.
- Added support for Vite-based modules compatible with OAuth2 Passport Server v7+.

### Improved

- Improved Laravel Mix support and updated the development environment used by Mix-based modules.
- Improved asset compilation workflows for both supported drivers.
- Improved module scaffolding generation by separating driver-specific resources and configuration files.
- Improved compatibility between Elymod modules and OAuth2 Passport Server v7+.

### Changed

- The module generator now accepts a frontend driver:

Creates a module using **Vite** (default).

```bash
php artisan module:make ModuleName
```

Creates a module using **Vite**.

```bash
php artisan module:make ModuleName --driver=vite
```

Creates a module using **Laravel Mix**.

```bash
php artisan module:make ModuleName --driver=mix
```

- The internal stub structure has been reorganized into driver-specific templates.
- Vite is now the default environment when no driver is specified.

### Compatibility

- This version is compatible only with **OAuth2 Passport Server v7+**.
- Modules generated with Elymod v2 are intended to be used with OAuth2 Passport Server v7 and newer versions.

### Migration Notes

Modules created with Elymod **1.x** are not directly compatible with OAuth2 Passport Server v7+.

To migrate an existing module:

1. Update the module dependencies to the versions required by Elymod v2.
2. Update Laravel Mix-related packages to the new supported versions.
3. Replace or merge the development environment files from the new Mix template.
4. Review build scripts and asset compilation settings.
5. Rebuild assets using the updated toolchain.

After updating the development environment and dependencies, existing Laravel Mix modules can continue to be used under OAuth2 Passport Server v7+.

### Notes

Although OAuth2 Passport Server v7 uses Vite as its primary frontend build system, Elymod continues to support Laravel Mix for third-party modules, providing a migration path for existing ecosystems while offering Vite as the default choice for new projects.

---
