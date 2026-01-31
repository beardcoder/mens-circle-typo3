# Contributing to Mens Circle TYPO3 Website

Thank you for considering contributing to this project! This document provides guidelines for contributing code.

## Code of Conduct

This project is for the Mens Circle Niederbayern community. Please be respectful and constructive in all interactions.

## Development Setup

1. **Fork and Clone**
   ```bash
   git clone https://github.com/your-username/mens-circle-typo3.git
   cd mens-circle-typo3
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

4. **Run TYPO3 Install**
   - Access http://localhost/typo3/install.php
   - Follow installation wizard

## Coding Standards

### PHP

- **Always use** `declare(strict_types=1);` at the top of PHP files
- **Type everything**: properties, parameters, return values
- **Follow PSR-12** coding style
- **Use PHP 8.5 features**: readonly properties, constructor promotion
- **Keep it simple**: avoid over-abstraction

Example:
```php
<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Domain\Model;

class Example
{
    public function __construct(
        private readonly string $name,
        private int $count = 0,
    ) {}
    
    public function getName(): string
    {
        return $this->name;
    }
}
```

### JavaScript

- **Vanilla JavaScript** - no frameworks
- **Progressive enhancement** - works without JS
- **Clear function names**
- **Comment complex logic**

### CSS

- **Vanilla CSS** - no preprocessors
- **Use CSS variables** for theming
- **Mobile-first** responsive design
- **Logical property names** (inline-size, block-start)

### Fluid Templates

- **Semantic HTML** elements
- **Accessibility first** (ARIA labels, semantic tags)
- **Readable indentation**
- **Meaningful variable names**

## Project Structure

- `packages/sitepackage/Classes/` - PHP code
- `packages/sitepackage/Configuration/` - TCA, TypoScript
- `packages/sitepackage/Resources/Private/Templates/` - Fluid templates
- `packages/sitepackage/Resources/Public/` - CSS, JS, images

## Making Changes

### 1. Create a Feature Branch

```bash
git checkout -b feature/your-feature-name
```

### 2. Make Your Changes

- Keep changes focused and atomic
- One feature/fix per branch
- Write clear commit messages

### 3. Test Your Changes

- Test in TYPO3 backend
- Test on frontend
- Check responsive design
- Verify accessibility

### 4. Commit

```bash
git add .
git commit -m "Add feature: clear description of what changed"
```

Good commit messages:
```
Add event capacity display to event list
Fix newsletter form validation
Update testimonial styling for mobile
```

Bad commit messages:
```
update stuff
fix
changes
```

### 5. Push and Create Pull Request

```bash
git push origin feature/your-feature-name
```

Then create a Pull Request on GitHub with:
- Clear title
- Description of changes
- Screenshots (if UI changes)
- Testing notes

## Adding New Features

### Adding a New Content Element

1. Create TCA override in `Configuration/TCA/Overrides/tt_content_your-element.php`
2. Add TypoScript in `Configuration/Sets/Sitepackage/setup.typoscript`
3. Create Fluid template in `Resources/Private/Templates/ContentElements/`
4. Add CSS styling to `Resources/Public/Css/main.css`

### Adding a New Domain Model

1. Create model class in `Classes/Domain/Model/`
2. Create repository in `Classes/Domain/Repository/`
3. Create TCA in `Configuration/TCA/tx_sitepackage_domain_model_[name].php`
4. Add table schema to `ext_tables.sql`
5. Run database update in TYPO3 Install Tool

## Testing Checklist

Before submitting a pull request:

- [ ] Code follows project style guidelines
- [ ] PHP has strict types and type hints
- [ ] Works in TYPO3 backend
- [ ] Displays correctly on frontend
- [ ] Responsive on mobile/tablet/desktop
- [ ] Accessible (keyboard navigation, screen readers)
- [ ] No JavaScript errors in console
- [ ] No PHP errors in TYPO3 backend
- [ ] Database updates work correctly
- [ ] Changes documented in code comments where needed

## Questions?

- Open an issue on GitHub
- Ask in discussions
- Contact project maintainers

## License

By contributing, you agree that your contributions will be licensed under the GPL-2.0-or-later license.

---

Thank you for contributing to the Mens Circle community! 🙏
