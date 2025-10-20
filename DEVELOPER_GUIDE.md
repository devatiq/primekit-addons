
# PrimeKit Addons Developer Guide

This document provides an overview of the PrimeKit Addons plugin architecture, file structure, and development guidelines for developers.

## 1. Plugin Architecture

PrimeKit Addons is a WordPress plugin that extends the Elementor page builder with a variety of new widgets and features. The plugin follows a modular and object-oriented architecture.

The core logic is divided into two main parts:

*   **Admin:** Handles the WordPress dashboard interface, including settings pages, widget availability, and admin-specific assets.
*   **Frontend:** Manages the integration with Elementor, registers widgets, and renders them on the frontend of the site.

The plugin is initialized by the main plugin file `primekit-addons.php`, which then loads the `Inc/Manager.php`. The Manager is responsible for loading and initializing all the different modules of the plugin, such as the Admin and Frontend components.

## 2. Directory Structure

The plugin's directory structure is organized as follows:

```
/primekit-addons/
├── primekit-addons.php       # Main plugin file - entry point.
│
├── composer.json             # PHP dependency management.
├── package.json              # JavaScript dependency management.
│
├── Inc/                      # Core plugin logic.
│   ├── Activate.php          # Handles plugin activation.
│   ├── Deactivate.php        # Handles plugin deactivation.
│   └── Manager.php           # Main orchestrator for the plugin modules.
│
├── Admin/                    # Handles all backend (WordPress Admin) functionality.
│   ├── AdminManager.php      # Manages the admin-side components.
│   ├── Assets/               # Admin-specific CSS, JS, images, and icons.
│   └── Inc/                  # Admin-related includes.
│       ├── Hooks/            # WordPress action and filter hooks for the admin area.
│       ├── Metabox/          # Logic for custom meta boxes.
│       └── Templates/        # Admin-side template management (e.g., for the template library).
│
├── Frontend/                 # Handles all frontend functionality.
│   ├── Frontend.php          # Entry point for frontend components.
│   └── Elementor/            # Elementor-specific integration.
│       ├── Configuration.php # Configuration for Elementor integration.
│       ├── Assets/           # CSS and JS for frontend widgets.
│       ├── Globals/          # Global Elementor features (e.g., Custom CSS, PreLoader).
│       ├── Inc/              # Utility functions and classes for the frontend.
│       └── Widgets/          # Contains the code for each individual Elementor widget.
│           └── [WidgetName]/ # Each widget has its own folder.
│               └── [WidgetName].php
│
├── assets/                   # Global assets used across the plugin.
│
├── languages/                # Translation files (.pot).
│
├── vendor/                   # Composer dependencies.
├── node_modules/             # NPM dependencies.
│
└── .wordpress-org/           # Assets for the WordPress.org plugin repository (banners, icons, screenshots).
```

### Key Files and Directories:

*   **`primekit-addons.php`**: The main plugin file that WordPress recognizes. It's responsible for loading the initial plugin setup.
*   **`Inc/Manager.php`**: This is the central class that loads and initializes all other parts of the plugin. If you need to trace how different modules are loaded, this is the place to start.
*   **`Frontend/Elementor/Widgets/`**: This is the most important directory for widget development. Each subdirectory corresponds to a specific Elementor widget. To create a new widget, you would add a new folder and widget class file here.
*   **`Admin/AdminManager.php`**: Manages the admin dashboard pages, settings, and assets.
*   **`Admin/Inc/Templates/`**: This directory and its sub-components handle the logic for the PrimeKit template library feature.

## 3. How to Add a New Widget

1.  **Create a New Widget Folder:**
    *   Navigate to `Frontend/Elementor/Widgets/`.
    *   Create a new folder for your widget (e.g., `MyAwesomeWidget`).

2.  **Create the Widget Class File:**
    *   Inside your new widget folder, create a PHP file (e.g., `MyAwesomeWidget.php`).
    *   This file will contain a class that extends `\Elementor\Widget_Base`.
    *   Implement the required methods: `get_name()`, `get_title()`, `get_icon()`, `get_categories()`, `_register_controls()`, and `render()`.

3.  **Register the New Widget:**
    *   The plugin likely auto-loads widgets from the `Widgets/` directory. Check `Frontend/Elementor/Configuration.php` or a similar file to see how widgets are registered. You may need to add your new widget class to an array of widgets to be loaded.

4.  **Add Assets:**
    *   If your widget requires custom CSS or JavaScript, add the files to the `Frontend/Elementor/Assets/css/` and `Frontend/Elementor/Assets/js/` directories respectively.
    *   Enqueue your assets within your widget class file using the `get_style_depends()` or `get_script_depends()` methods.

## 4. Dependencies

*   **PHP:** Managed via [Composer](https://getcomposer.org/). To install, run `composer install`.
*   **JavaScript:** Managed via [NPM](https://www.npmjs.com/). To install, run `npm install`.

This guide should provide a solid starting point for understanding and extending the PrimeKit Addons plugin.
