# Copilot Instructions

This document provides guidelines for GitHub Copilot when working with the LSX Starter Plugin WordPress codebase.

## Project Overview

The LSX Starter Plugin is a scaffolding tool for building LSX theme extensions. It follows a modular architecture with autoloaded classes, content model support, and template registration for WordPress blocks.

## Architecture & Key Components

### Core Structure
- **Entry Point**: `lsx-starter-plugin.php` - Defines constants and initializes the Core class
- **Core Class**: `classes/class-core.php` - Singleton pattern, autoloads all classes from `/classes/` directory
- **Modular Classes**: Each class file returns an instantiated object (not class definition)

### Essential Patterns
```php
// Class instantiation pattern (return instance, not class)
return new Frontend();

// Namespace convention
namespace lsx_starter_plugin\classes;

// Constants pattern
define( 'LSX_STARTER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'LSX_STARTER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'LSX_STARTER_PLUGIN_VER', '2.0.0' );
```

### Content Model Integration
- Uses `vendors/create-content-model/` for post type generation
- Post types defined in JSON: `post-types/post-type.json`
- Global `$CONTENT_MODEL_JSON_PATH` array registration required
- Code marked with `@category "post-type-support"` can be removed when customizing

## Development Workflows

### Plugin Customization (Primary Use Case)
1. **Find & Replace Operations**: Use case-sensitive replacements:
   - `lsx_starter_plugin` → `your_plugin`
   - `LSX_STARTER_PLUGIN` → `YOUR_PLUGIN`  
   - `lsx-starter-plugin` → `your-plugin`
   - `LSX Starter Plugin` → `Your Plugin`

2. **Removing Post Type Support**: Delete files/folders and code with `@category "post-type-support"`

3. **Asset Building**: Use npm scripts for translations:
   ```bash
   npm run build-pot    # Generate POT file
   npm run build-mopo   # Compile MO files
   npm run translate-US # Create US locale
   ```

### Class System
- **Auto-discovery**: `Core::load_classes()` automatically loads all `class-*.php` files
- **Special handling**: Templates class gets `set_path()` call for template resolution
- **Includes**: Separate `load_includes()` for function files in `/includes/`

### Template System
- **Block Templates**: `class-templates.php` registers WordPress block templates
- **File Structure**: Template content in `/templates/*.html`
- **Registration**: Uses `register_block_template()` with namespace `lsx-starter-plugin//template-name`

## Code Conventions

### WordPress Standards
- Follow WPCS (WordPress PHP Coding Standards)
- Use proper escaping: `esc_html()`, `esc_url()`, `esc_attr()`
- Text domain: `lsx-starter-plugin`
- Hook priority: Admin assets priority 1, vendor loading priority 9

### Asset Management
```php
// Development vs. production asset loading
if ( ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) || ( defined('WP_LOCALSITE') && WP_LOCALSITE ) ) {
    $prefix = 'src/';
    $suffix = '';
} else {
    $prefix = '';
    $suffix = '.min';
}
```

### Naming Conventions
- Plugin prefix: `lsx_starter_plugin_`
- CSS/JS handles: `lsx-starter-plugin-*`
- Hook suffixes: Use descriptive names (e.g., `admin_assets`, `enqueue_scripts`)

## File Organization

```
lsx-starter-plugin/
├── classes/           # Core plugin classes (auto-loaded)
├── includes/          # Function files (auto-loaded)
├── templates/         # Block template HTML files
├── post-types/        # JSON content model definitions
├── vendors/           # Third-party libraries
├── assets/            # CSS/JS files (src/ and minified)
└── languages/         # Translation files
```

## Security & Performance
- **Script Debug**: Conditional asset loading based on `SCRIPT_DEBUG` and `WP_LOCALSITE`
- **Text Domain Loading**: Properly hooked to `init` action
- **Asset Dependencies**: Explicit jQuery dependency for frontend scripts
- **Version Control**: Use `LSX_STARTER_PLUGIN_VER` constant for cache busting

## Integration Points
- **Functionality Ecosystem**: Designed to provide functionality for themes
- **WordPress Blocks**: Template registration for Gutenberg
- **Content Models**: JSON-based post type definitions
- **Translation Ready**: Full i18n support with proper text domain

When customizing this plugin, maintain the modular class structure and ensure proper namespace updates throughout all files.