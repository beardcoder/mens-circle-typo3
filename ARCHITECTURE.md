# Architecture Documentation

## Overview

This TYPO3 v14.1 project follows a **KISS (Keep It Simple, Stupid)** architecture philosophy. The entire project is built around a single sitepackage extension, prioritizing simplicity, maintainability, and clarity over clever abstractions.

## Core Principles

### 1. **Single Extension Architecture**

**Decision**: All functionality resides in one `sitepackage` extension.

**Why**:
- Reduces complexity - no inter-extension dependencies
- Easier to understand for new developers
- Faster development cycle
- Simpler deployment
- Can be split later if needed (but it won't be needed)

### 2. **PHP 8.5 Modern Practices**

**Applied Throughout**:
```php
declare(strict_types=1);  // Every PHP file

// Typed properties
protected string $title = '';
protected ?DateTime $startDate = null;

// Constructor property promotion
public function __construct(
    private readonly EventRepository $eventRepository,
) {}

// Explicit return types
public function findUpcoming(): array
public function isApproved(): bool
```

**Why**:
- Better IDE support and auto-completion
- Catches errors at development time, not runtime
- Self-documenting code
- Modern PHP best practices

### 3. **Domain-Driven Design (Lite)**

**Structure**:
```
Classes/
├── Domain/
│   ├── Model/           # Domain objects (Event, Subscriber, Testimonial)
│   └── Repository/      # Data access (EventRepository)
```

**Why**:
- Clear separation between data and logic
- Models are simple, focused objects
- Repositories handle database access
- Extbase convention-friendly

### 4. **TYPO3 v14 Sets (Not Classic TypoScript)**

**Location**: `Configuration/Sets/Sitepackage/`

**Why**:
- Native TYPO3 v14 approach
- Better dependency management
- Cleaner configuration structure
- Future-proof for TYPO3 v15+

### 5. **Content Elements Over Plugins**

**Pattern**: Custom content elements registered via TCA Overrides

**Examples**:
- `sitepackage_eventlist` - Event list display
- `sitepackage_newsletter` - Newsletter form
- `sitepackage_testimonials` - Testimonials display

**Why**:
- Simpler than Extbase plugins
- No controller overhead for simple displays
- Data processors handle queries
- Fluid templates for rendering
- Editors can place elements anywhere

## Data Flow

### Rendering Flow

```
Request
  ↓
TYPO3 Frontend (index.php)
  ↓
TypoScript (setup.typoscript)
  ↓
Content Element (tt_content.sitepackage_eventlist)
  ↓
Data Processor (DatabaseQueryProcessor)
  ↓
Fluid Template (EventList.html)
  ↓
HTML Response
```

### Database Access

```
Content Element
  ↓
Data Processor (TypoScript)
  ↓
Database Query
  ↓
Result Array
  ↓
Fluid Template
```

For more complex operations:
```
Controller
  ↓
Repository
  ↓
Model
  ↓
Template
```

## Feature Architecture

### Event Management

**Components**:
- `Event` model (Domain/Model/Event.php)
- `EventRepository` (Domain/Repository/EventRepository.php)
- TCA configuration (Configuration/TCA/tx_sitepackage_domain_model_event.php)
- Content element (TCA/Overrides/tt_content_eventlist.php)
- Template (Templates/ContentElements/EventList.html)

**Flow**:
1. Editor creates events in TYPO3 backend
2. Content element added to page
3. Data processor queries upcoming events
4. Template renders event list
5. CSS styles the output

**Key Features**:
- Automatic capacity tracking
- Slug-based URLs (ready for detail pages)
- Date-based filtering
- Simple, clear data structure

### Newsletter System

**Components**:
- `Subscriber` model
- TCA configuration
- Newsletter form content element
- Form template with validation

**Flow**:
1. User fills out form
2. JavaScript handles AJAX submission (optional)
3. Backend creates subscriber record
4. Email confirmation sent (to be implemented)
5. User confirms via token link
6. Subscriber marked as confirmed

**Security**:
- Email validation
- Privacy consent required
- Token-based confirmation
- SQL injection prevention via Extbase

### Testimonials

**Components**:
- `Testimonial` model
- Approval workflow (backend checkbox)
- Content element for display
- Template with quotation styling

**Flow**:
1. User submits testimonial (form to be implemented)
2. Stored as unapproved in backend
3. Admin reviews and approves
4. Approved testimonials appear in list
5. Displayed in chronological order

## Database Schema

### Naming Convention

Tables follow TYPO3 convention:
```
tx_[extensionkey]_domain_model_[modelname]
```

Example: `tx_sitepackage_domain_model_event`

### Common Fields

All tables include TYPO3 standard fields:
- `uid` - Primary key
- `pid` - Page ID (storage folder)
- `tstamp` - Last modified timestamp
- `crdate` - Creation timestamp
- `deleted` - Soft delete flag
- `hidden` - Visibility flag
- `sorting` - Manual sorting (events)

### Custom Fields

Each model adds specific fields:

**Event**:
- title, slug, description
- start_date, end_date, location
- max_participants, current_participants

**Subscriber**:
- email, name
- confirmed, confirmation_token
- confirmed_at, subscribed_at

**Testimonial**:
- author_name, content
- approved, submitted_at

## Frontend Architecture

### CSS Architecture

**Approach**: Vanilla CSS with CSS Variables

**Structure**:
```css
/* 1. Reset & Base */
* { box-sizing: border-box; }

/* 2. CSS Variables */
:root {
    --color-primary: #2c5f2d;
    --space-md: 2rem;
}

/* 3. Typography */
body { font-family: var(--font-family); }

/* 4. Layout */
header, main, footer { ... }

/* 5. Components */
.event-item { ... }
.testimonial-item { ... }
```

**Why**:
- No build step needed
- Fast browser parsing
- Easy to override
- Readable and maintainable
- Small file size

### JavaScript Architecture

**Approach**: Vanilla JavaScript, progressively enhanced

**Features**:
- Form validation
- AJAX submissions
- User feedback (success/error messages)
- No dependencies

**Pattern**:
```javascript
// Wait for DOM
document.addEventListener('DOMContentLoaded', () => {
    initForms();
});

// Progressive enhancement
if (form.dataset.ajax) {
    handleAjaxSubmit();
}
```

**Why**:
- Works without JavaScript
- No build step
- Fast page loads
- Easy to debug

## Configuration Management

### Environment Variables (.env)

```env
TYPO3_CONTEXT=Development
TYPO3_DB_HOST=127.0.0.1
TYPO3_DB_NAME=typo3
```

### Site Configuration (config/sites/main/config.yaml)

```yaml
base: 'http://localhost/'
rootPageId: 1
languages: [...]
settings:
  set: menscircle/sitepackage
```

### TypoScript (Configuration/Sets/Sitepackage/)

- `config.yaml` - Set metadata and dependencies
- `constants.typoscript` - Constants
- `setup.typoscript` - Page rendering and content elements

## Scalability Considerations

### Current Scale

Perfect for:
- Small to medium websites (< 10,000 pages)
- 1-5 editors
- 1-3 developers
- Clear feature requirements

### When to Refactor

Consider splitting if:
- Extension grows beyond 50 files
- Multiple independent features emerge
- Need separate versioning
- Team grows beyond 5 developers

### Performance Optimization

Current setup includes:
- Database indexes on frequently queried fields
- Content element caching (TYPO3 default)
- Minimal CSS/JS (no framework overhead)

Future optimizations:
- Redis/Memcached for object caching
- CDN for static assets
- Database query optimization
- Lazy loading images

## Extension Structure Best Practices

### File Organization

```
sitepackage/
├── Classes/              # PHP code
│   ├── Domain/          # Models, Repositories
├── Configuration/        # TCA, TypoScript, Site config
│   ├── Sets/            # TYPO3 v14 Sets
│   └── TCA/             # Database table configs
├── Resources/
│   ├── Private/         # Templates, not web-accessible
│   └── Public/          # CSS, JS, Images
├── composer.json        # Extension metadata
├── ext_emconf.php       # TYPO3 extension config
└── ext_tables.sql       # Database schema
```

### Code Organization Rules

1. **One class per file**
2. **Namespaces match directory structure**
3. **Models are pure data objects**
4. **Repositories handle queries only**
5. **Templates in logical groups**

## Testing Strategy

### Manual Testing

Current approach:
1. Create test content in backend
2. Verify frontend rendering
3. Check responsive design
4. Test form submissions
5. Validate data persistence

### Automated Testing (Future)

Recommended:
- PHPUnit for unit tests
- TYPO3 Testing Framework for functional tests
- Cypress/Playwright for E2E tests

## Deployment Strategy

### Development

```bash
composer install
# Configure .env
# Run TYPO3 install wizard
# Activate extension
```

### Production

```bash
composer install --no-dev --optimize-autoloader
# Set TYPO3_CONTEXT=Production
# Configure proper database
# Set file permissions
# Clear TYPO3 caches
```

## Security Considerations

### Built-in Protection

- TYPO3 CSRF protection
- SQL injection prevention (Extbase ORM)
- XSS prevention (Fluid auto-escaping)
- Password hashing (TYPO3 backend)

### Custom Measures

- Email validation on forms
- Privacy consent required
- Token-based confirmations
- Input sanitization

## Maintenance

### Regular Tasks

- TYPO3 core updates
- Extension updates
- Database backups
- Log monitoring
- Cache clearing

### Long-term Maintenance

- PHP version updates
- TYPO3 major version migrations
- Security patches
- Performance monitoring

## Decision Log

### Why No JavaScript Framework?

**Decision**: Use vanilla JavaScript

**Rationale**:
- No complex client-side state
- Simpler forms don't need React/Vue
- Faster initial page load
- Easier maintenance
- Progressive enhancement

### Why No CSS Framework?

**Decision**: Custom CSS with variables

**Rationale**:
- Smaller file size (< 3KB vs 300KB for Bootstrap)
- Full control over styling
- No unused classes
- Modern CSS features (Grid, Flexbox)
- Easy to customize

### Why Single Extension?

**Decision**: One sitepackage for everything

**Rationale**:
- Project scope is focused
- Team is small
- Features are related
- Simpler dependency management
- Faster development

### Why Data Processors Over Controllers?

**Decision**: Use TypoScript data processors for simple displays

**Rationale**:
- Less boilerplate code
- No controller overhead
- Simpler debugging
- Adequate for read-only displays
- Can add controllers later if needed

## Future Enhancements

### Phase 2 (If Needed)

- Event registration backend controller
- Newsletter sending functionality
- Testimonial submission form
- User authentication for event RSVP

### Phase 3 (If Needed)

- Calendar integration (iCal export)
- Email notifications
- User dashboard
- Search functionality

## Conclusion

This architecture prioritizes:

1. **Simplicity** - Easy to understand
2. **Maintainability** - Easy to modify
3. **Performance** - Fast page loads
4. **Standards** - TYPO3 conventions
5. **Future-proof** - TYPO3 v14 patterns

The result is a clean, minimal TYPO3 project that can be understood and modified by any TYPO3 developer in minutes, not hours.

---

**Remember**: This is not enterprise software. This is community software. Keep it simple. Keep it maintainable. Keep it human.
