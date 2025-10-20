
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

Follow these steps to create a new Elementor widget and integrate it into the PrimeKit Addons plugin.

### Step 1: Create the Widget Files

1.  **Create a New Widget Folder:**
    *   Navigate to `Frontend/Elementor/Widgets/`.
    *   Create a new folder for your widget. The folder name should be in `PascalCase`, for example: `MyAwesomeWidget`.

2.  **Create the Main Widget File:**
    *   Inside your new widget folder (`MyAwesomeWidget/`), create a PHP file named `Main.php`.
    *   In this file, define your widget's class. The class name must be `Main` and it must extend `\Elementor\Widget_Base`.

    ```php
    <?php
    namespace PrimeKit\Modules\Elementor\Widgets\MyAwesomeWidget;

    use Elementor\Widget_Base;

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    class Main extends Widget_Base {

        // Implement required methods:
        public function get_name() {
            return 'primekit-my-awesome-widget';
        }

        public function get_title() {
            return esc_html__( 'My Awesome Widget', 'primekit-addons' );
        }

        public function get_icon() {
            return 'primekit-icon-my-awesome-widget'; // You can add a custom icon
        }

        public function get_categories() {
            return [ 'primekit-addons' ];
        }

        protected function _register_controls() {
            // Your widget controls go here
        }

        protected function render() {
            // Your widget's frontend output goes here
        }
    }
    ```

### Step 2: Register the Widget

1.  **Add to Configuration:**
    *   Open the file `Frontend/Elementor/Configuration.php`.
    *   Locate the `register_general_widgets` method.
    *   Add your new widget to the array. The key should be the widget's name (used for the dashboard toggle) and the value is the path to the widget's main class.

    ```php
    public static function register_general_widgets($widgets_manager) {
        $general_widgets = [
            // ... existing widgets
            'my-awesome-widget' => __NAMESPACE__ . '\Widgets\MyAwesomeWidget\Main',
        ];
        // ... rest of the method
    }
    ```

### Step 3: Add a Dashboard Toggle (Optional)

If you want to allow users to enable or disable your widget from the WordPress dashboard:

1.  **Edit the Dashboard File:**
    *   Open the file `Admin/Inc/Dashboard/AvailableWidgets/RegularTab.php`.
    *   Add your widget to the list, using the same key you defined in `Configuration.php` (`my-awesome-widget`). Follow the existing format to add the widget's title and icon.

    ```php
    // Inside the array in RegularTab.php
    'my-awesome-widget' => [
        'title' => esc_html__('My Awesome Widget', 'primekit-addons'),
        'icon'  => 'your-widget-icon-class' // Optional: Add an icon class
    ],
    ```

### Step 4: Add Assets

*   If your widget requires custom CSS or JavaScript, add the files to the `Frontend/Elementor/Assets/css/` and `Frontend/Elementor/Assets/js/` directories respectively.
*   Enqueue your assets within your widget's `Main.php` file using the `get_style_depends()` or `get_script_depends()` methods.

## 4. Dependencies

*   **PHP:** Managed via [Composer](https://getcomposer.org/). To install, run `composer install`.
*   **JavaScript:** Managed via [NPM](https://www.npmjs.com/). To install, run `npm install`.

This guide should provide a solid starting point for understanding and extending the PrimeKit Addons plugin.
