# Changelog

## Unrelease

- Updated package.json dependencies
- Migrate to api-response v2.0.0

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
