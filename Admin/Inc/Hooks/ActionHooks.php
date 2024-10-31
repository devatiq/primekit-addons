<?php
namespace PrimeKit\Admin\Inc\Hooks;

class ActionHooks
{
    public function __construct()
    {
        
        // Hook for adding a widget area wrapper to the available widgets tab content area in the dashboard.
        add_action( 'primekit_available_widgets_wrapper_start', [$this, 'available_widgets_wrapper_start'] );
        add_action( 'primekit_available_widgets_wrapper_end', [$this, 'available_widgets_wrapper_end'] );
    }

    public function available_widgets_wrapper_start()
    {
        ?>

        <!-- Available widgets area -->
        <div class="primekit-available-widgets-area">
            <!-- Widgets Wrapper -->
            <div class="primekit-available-widgets-wrapper">
     <?php
    }

    public function available_widgets_wrapper_end()
    {
        ?>
            </div>
        </div>
        <?php
    }
}