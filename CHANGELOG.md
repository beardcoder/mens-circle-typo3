# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2024-01-31

### Added - Initial Release

#### Core Setup
- TYPO3 v14.1 LTS installation with PHP 8.5
- Composer-based project structure
- Single sitepackage extension architecture
- TYPO3 v14 Sets configuration system
- Basic Fluid template structure
- Minimal, semantic CSS styling
- Vanilla JavaScript for progressive enhancement

#### Event Management
- Event domain model with typed properties
- Event repository for data access
- TCA configuration for backend editing
- Event list content element
- Fluid template for event display
- Automatic capacity tracking
- Date/time/location display
- "Full" status indicator
- Database schema with indexes

#### Newsletter System
- Subscriber domain model
- Newsletter subscription form content element
- Email validation
- Privacy consent checkbox
- Double opt-in architecture (backend ready)
- TCA configuration for subscriber management
- Database schema with unique email constraint

#### Testimonials
- Testimonial domain model
- Backend approval workflow
- Testimonials list content element
- Quotation-style display
- Author attribution
- Chronological ordering
- TCA configuration
- Database schema

#### Frontend
- Semantic HTML5 structure
- Responsive CSS with mobile-first approach
- CSS variables for theming
- Clean navigation structure
- Accessible forms with labels
- AJAX form handling (JavaScript)
- Modern CSS features (Grid, Flexbox)

#### Documentation
- Comprehensive README.md with installation guide
- ARCHITECTURE.md with design decisions
- CONTRIBUTING.md for development guidelines
- Inline code documentation
- Database schema documentation

#### Configuration
- Site configuration (config/sites/main/)
- Environment variables (.env.example)
- Apache .htaccess with security headers
- TYPO3 frontend bootstrap (public/index.php)
- Extension metadata files

### Technical Details
- **PHP**: 8.5 with strict types
- **TYPO3**: v14.1 LTS
- **Architecture**: Single sitepackage pattern
- **Database**: MariaDB/MySQL compatible
- **License**: GPL-2.0-or-later

---

## Future Versions

### [1.1.0] - Planned
- Event registration functionality
- Newsletter sending system
- Testimonial submission form
- Email notification system

### [1.2.0] - Planned
- Calendar integration (iCal export)
- Event detail pages
- User authentication
- Search functionality

---

[1.0.0]: https://github.com/beardcoder/mens-circle-typo3/releases/tag/v1.0.0
