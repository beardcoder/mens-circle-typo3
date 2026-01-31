# Mens Circle Niederbayern - TYPO3 v14.1

A clean, modern TYPO3 v14.1 website for Mens Circle Niederbayern, built with PHP 8.5 following the KISS principle.

## Overview

This is a minimal TYPO3 installation focused on simplicity and maintainability. The project uses:

- **TYPO3 v14.1 LTS** - Latest TYPO3 version
- **PHP 8.5** - Modern PHP with strict types
- **Single sitepackage** - All functionality in one extension
- **Composer-based** - Modern dependency management
- **Semantic HTML & minimal CSS** - Performance-focused frontend

## Features

The website provides:

- **Event Management** - Display and manage men's circle events
  - Event list content element
  - Event details with date, time, location
  - Participant capacity tracking
  - Automatic "full" status display
- **Newsletter System** - Double opt-in email subscriptions
  - Newsletter subscription form content element
  - Subscriber management in backend
  - Email validation
  - Privacy consent checkbox
- **Testimonials** - Community member testimonials
  - Testimonials list content element
  - Backend approval workflow
  - Author attribution
  - Clean, quotation-style display
- **Static Content** - Pages for About, Contact, Legal information
- **SEO-optimized** - Clean URLs, meta tags, semantic HTML

## Requirements

- PHP 8.5 or higher
- MariaDB 11.4+ or MySQL 8.0+
- Composer 2.x
- Web server (Apache/Nginx) or PHP built-in server for development

## Installation

### 1. Clone Repository

```bash
git clone https://github.com/beardcoder/mens-circle-typo3.git
cd mens-circle-typo3
```

### 2. Install Dependencies

```bash
composer install
```

This will:
- Install TYPO3 core packages
- Set up the sitepackage extension
- Create necessary directories

### 3. Configure Environment

```bash
cp .env.example .env
```

Edit `.env` and configure your database connection:

```env
TYPO3_DB_HOST=127.0.0.1
TYPO3_DB_NAME=typo3
TYPO3_DB_USER=root
TYPO3_DB_PASSWORD=your_password
```

### 4. Set Up Database

Create your database:

```bash
mysql -u root -p
CREATE DATABASE typo3 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Run TYPO3 Install Tool

Access the install tool in your browser:

```
http://localhost/typo3/install.php
```

Follow the installation wizard to:
1. Set up database connection
2. Create admin user
3. Import base configuration

### 6. Activate Extension

In TYPO3 Backend:
1. Go to **Extensions** module
2. Activate **sitepackage** extension

### 7. Create Root Page

1. Go to **Page** module
2. Create a new page at root level
3. Set it as "Use as Root Page"
4. Set page title to "Home"

## Local Development

### Using PHP Built-in Server

```bash
cd public
php -S localhost:8000
```

Access the site at: http://localhost:8000

### Using Apache/Nginx

Point your web server's document root to the `public/` directory.

## Project Structure

```
mens-circle-typo3/
├── config/                      # TYPO3 configuration
│   └── sites/                   # Site configurations
│       └── main/
│           └── config.yaml      # Main site config
├── packages/                    # Extensions
│   └── sitepackage/             # Main sitepackage extension
│       ├── Classes/             # PHP classes
│       │   ├── Controller/      # Extbase controllers
│       │   ├── Domain/          # Domain models & repositories
│       │   │   ├── Model/       # Domain models
│       │   │   └── Repository/  # Repositories
│       ├── Configuration/       # Extension configuration
│       │   ├── Sets/            # TYPO3 v14 Sets (replaces TypoScript)
│       │   │   └── Sitepackage/
│       │   │       ├── config.yaml
│       │   │       └── setup.typoscript
│       │   └── TCA/             # Table configuration
│       ├── Resources/
│       │   ├── Private/         # Fluid templates
│       │   │   ├── Templates/
│       │   │   │   └── Page/    # Page templates
│       │   │   ├── Layouts/     # Fluid layouts
│       │   │   └── Partials/    # Reusable partials
│       │   └── Public/          # Public assets
│       │       ├── Css/         # Stylesheets
│       │       ├── Js/          # JavaScript
│       │       └── Images/      # Images
│       ├── composer.json        # Extension composer config
│       └── ext_emconf.php       # Extension metadata
├── public/                      # Web root (document root)
│   ├── index.php                # Entry point (created by TYPO3)
│   └── typo3/                   # TYPO3 backend (symlinked)
├── var/                         # Cache, logs (auto-generated)
├── vendor/                      # Composer dependencies
├── .env                         # Environment configuration
├── .env.example                 # Example environment config
├── composer.json                # Project dependencies
└── README.md                    # This file
```

## Architecture Decisions

### 1. Single Sitepackage Extension

**Decision**: All functionality lives in one `sitepackage` extension.

**Rationale**: 
- Simpler to understand and maintain
- Faster development for small-to-medium projects
- No overhead of multiple extension coordination
- Easy to split later if needed

### 2. TYPO3 v14 Sets (Not Classic TypoScript)

**Decision**: Use new Sets configuration format instead of classic TypoScript includes.

**Rationale**:
- Native TYPO3 v14 approach
- Better dependency management
- Cleaner structure
- Future-proof

### 3. Minimal CSS (No Framework)

**Decision**: Write custom CSS using modern standards, no Bootstrap/Tailwind.

**Rationale**:
- Smaller bundle size
- Better performance
- No unnecessary abstraction
- Full control over styling

### 4. PHP 8.5 Features

**Decision**: Target PHP 8.5 explicitly with modern features.

**Why**:
- Strict typing everywhere (`declare(strict_types=1)`)
- Constructor property promotion
- Readonly properties where applicable
- Better type safety and IDE support

### 5. Composer-Based Project

**Decision**: Use Composer mode, not legacy extension installation.

**Rationale**:
- Industry standard
- Better dependency management
- Version control friendly
- Easier deployment

## Development Guidelines

### PHP Code Style

- Always use `declare(strict_types=1)` at the top of PHP files
- Type all function parameters and return values
- Use constructor property promotion for dependency injection
- Prefer readonly properties for immutable data
- Follow PSR-12 coding standards

### Naming Conventions

- **Classes**: PascalCase (e.g., `EventController`)
- **Methods/Properties**: camelCase (e.g., `findUpcomingEvents()`)
- **Database Tables**: snake_case with extension prefix (e.g., `tx_sitepackage_domain_model_event`)
- **Fluid Templates**: PascalCase (e.g., `Default.html`)

### Code Organization

- **Controllers**: Handle HTTP requests, delegate to repositories/services
- **Models**: Domain objects with business logic
- **Repositories**: Database access layer
- **ViewHelpers**: Reusable Fluid functionality
- **Services**: Complex business logic (when needed)

## Adding Features

### Adding a New Content Element

1. Create Fluid template in `Resources/Private/Templates/ContentElements/`
2. Register in TCA: `Configuration/TCA/Overrides/tt_content.php`
3. Add TypoScript rendering configuration

### Adding a New Model

1. Create model class in `Classes/Domain/Model/`
2. Create repository in `Classes/Domain/Repository/`
3. Add TCA configuration in `Configuration/TCA/`
4. Run database updates via Install Tool

### Adding a New Page Type

1. Add Fluid template to `Resources/Private/Templates/Page/`
2. Configure in TypoScript `setup.typoscript`
3. Add backend layout if needed

## Deployment

### Production Checklist

1. **Install dependencies** (production only):
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

2. **Configure environment**:
   - Set `TYPO3_CONTEXT=Production` in `.env`
   - Configure proper database credentials

3. **Set file permissions**:
   ```bash
   chmod -R 755 public/
   chmod -R 775 var/
   ```

4. **Clear caches**:
   ```bash
   ./vendor/bin/typo3 cache:flush
   ```

5. **Configure web server** to point to `public/` directory

## Maintenance

### Updating TYPO3

```bash
composer update typo3/cms-*
./vendor/bin/typo3 database:updateschema
./vendor/bin/typo3 cache:flush
```

### Clearing Cache

```bash
# Via CLI
./vendor/bin/typo3 cache:flush

# Via Backend
Admin Tools > Maintenance > Flush Cache
```

## Troubleshooting

### "Page not found" on frontend

1. Check if root page exists and is marked as "Use as Root Page"
2. Verify site configuration in `config/sites/main/config.yaml`
3. Clear all caches

### Backend login not working

1. Check database connection in `.env`
2. Verify admin user was created during installation
3. Try resetting password via Install Tool

### Extension not found

1. Run `composer install`
2. Check if sitepackage is in `packages/` directory
3. Activate extension in Extension Manager

## License

GPL-2.0-or-later

## Support

For issues and questions:
- GitHub Issues: https://github.com/beardcoder/mens-circle-typo3/issues
- TYPO3 Documentation: https://docs.typo3.org/

## Credits

Developed by Markus Sommer for Mens Circle Niederbayern.

---

**Built with TYPO3 v14.1 LTS** - Enterprise Content Management System
