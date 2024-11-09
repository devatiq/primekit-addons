<?php
namespace PrimeKit\Admin\Inc\Dashboard\AvailableWidgets;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use PrimeKit\Admin\Inc\Dashboard\AvailableWidgets\PrimeKitWidgets;

class RegularTab
{

    /**
     * Generates a complete demo URL by appending the given path to the base domain.
     *
     * @param string $path The specific path to append to the demo domain URL.
     * @return string The fully constructed demo URL.
     */
    public static function demo_url($path)
    {
        $domain = 'https://demo.primekitaddons.com/';
        return $domain . $path;
    }

    /**
     * Display a list of available widgets by calling the render method.
     */
    public static function primekit_regular_widgets_display()
    {
        // Animated Text.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_anim_text_widget_field',
            esc_html__('Animated Text', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/advanced-animated-text-elementor-widget/')
        );

        // Blockquote.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_blockquote_widget_field',
            esc_html__('Blockquote', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/blockquote-elementor-widget/')
        );

        // Blog Fancy.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_blog_fancy_widget_field',
            esc_html__('Blog Fancy', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/fancy-blog-posts.svg',
            true,
            self::demo_url('widgets/fancy-blog-posts-elementor-widget/')
        );

        // Author Bio.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_author_bio_widget_field',
            esc_html__('Author Bio', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/post-author-bio.svg',
            true,
            self::demo_url('widgets/post-author-bio-elementor-widget/')
        );

        // Blog Grid.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_blog_grid_widget_field',
            esc_html__('Blog Grid', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blog-posts-grid.svg',
            true,
            self::demo_url('widgets/blog-posts-grid-elementor-widget/')
        );

        // Blog List.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_blog_list_widget_field',
            esc_html__('Blog List', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blog-posts-list.svg',
            true,
            self::demo_url('widgets/blog-posts-list-elementor-widget/')
        );

        // Breadcrumb.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_breadcrumb_widget_field',
            esc_html__('Breadcrumb', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/breadcrumb.svg',
            true,
            self::demo_url('widgets/breadcrumb-elementor-widget/')
        );

        // Back To Top.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_back_top_widget_field',
            esc_html__('Back To Top', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/back-to-top-button.svg',
            true,
            self::demo_url('widgets/back-to-top-button-elementor-widget/')
        );

        // Before After Image.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_before_after_widget_field',
            esc_html__('Before After Image', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/before-after-image.svg',
            true,
            self::demo_url('widgets/before-after-image-compare-elementor-widget/')
        );

        // Card Info.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_card_info_widget_field',
            esc_html__('Card Info', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/card-info.svg',
            true,
            self::demo_url('widgets/card-info-elementor-widget/')
        );

        // Category List.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_cat_list_widget_field',
            esc_html__('Category List', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/post-category-list.svg',
            true,
            self::demo_url('widgets/post-category-list-elementor-widget/')
        );

        // Contact Form 7 Style.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_contact_form7_widget_field',
            esc_html__('Contact Form 7', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/contact-form-7.svg',
            true,
            self::demo_url('widgets/contact-form-7-style-elementor-widget/')
        );

        // Circular Skill.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_circular_skill_widget_field',
            esc_html__('Circular Skill', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-circular-skill.svg',
            true,
            self::demo_url('widgets/advanced-circular-skill-elementor-widget/'),
            true
        );

        // Comment Form.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_comment_form_widget_field',
            esc_html__('Comment Form', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/comment-form.svg',
            true,
            self::demo_url('widgets/comment-form-elementor-widget/')
        );

        // Contact & Social Info.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_contact_info_widget_field',
            esc_html__('Contact & Social Info', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/contact-and-social-info.svg',
            true,
            self::demo_url('widgets/contact-and-social-info-elementor-widget/')
        );

        // Count Down Timer.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_count_down_widget_field',
            esc_html__('Count Down Timer', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/count-down-timer.svg',
            true,
            self::demo_url('widgets/count-down-timer-elementor-widget/')
        );

        // Counter Up.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_counter_up_widget_field',
            esc_html__('Counter Up', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/counter-up.svg',
            true,
            self::demo_url('widgets/counter-up-elementor-widget/')
        );

        // Call To Action - CTA.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_cta_widget_field',
            esc_html__('Call To Action - CTA', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/call-to-action.svg',
            true,
            self::demo_url('widgets/advanced-call-to-action-elementor-widget/')
        );

        // Featured Image.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_feat_img_widget_field',
            esc_html__('Featured Image', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/featured-image.svg',
            true,
            self::demo_url('widgets/featured-image-elementor-widget/')
        );

        // Flip Box.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_flip_box_widget_field',
            esc_html__('Flip Box', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/flip-box.svg',
            true,
            self::demo_url('widgets/flip-box-elementor-widget/')
        );

        // Icon Box.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_icon_box_widget_field',
            esc_html__('Icon Box', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-icon-box.svg',
            true,
            self::demo_url('widgets/advanced-icon-box-elementor-widget/')
        );

        // Image Hover.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_img_hover_widget_field',
            esc_html__('Image Hover', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/image-hover.svg',
            true,
            self::demo_url('widgets/image-hover-elementor-widget/')
        );

        // Image & Text Scroll.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_img_text_scroll_widget_field',
            esc_html__('Image & Text Scroll', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/image-and-text-scroll.svg',
            true,
            self::demo_url('widgets/image-and-text-scroll-elementor-widget/')
        );

          // Loading Screen
          PrimeKitWidgets::primekit_available_widget(
            'primekit_loading_screen_widget_field',
            esc_html__('Loading Screen', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/image-and-text-scroll.svg',
            true,
            self::demo_url('widgets/loading-screen-elementor-widget/')
        );

        // Page Title.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_page_title_widget_field',
            esc_html__('Page Title', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/page-title.svg',
            true,
            self::demo_url('widgets/page-title-elementor-widget/')
        );

        // Popup.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_popup_widget_field',
            esc_html__('Popup', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/popup.svg',
            true,
            self::demo_url('widgets/popup-elementor-widget/')
        );

        // Portfolio.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_portfolio_widget_field',
            esc_html__('Portfolio', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/portfolio.svg',
            true,
            self::demo_url('widgets/portfolio-elementor-widget/')
        );

         // Post Content
         PrimeKitWidgets::primekit_available_widget(
            'primekit_post_content_widget_field',
            esc_html__('Post Content', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/page-title.svg',
            true,
            self::demo_url('widgets/post-content-elementor-widget/')
        );

        // Post Meta.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_post_meta_widget_field',
            esc_html__('Post Meta', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/post-meta-info.svg',
            true,
            self::demo_url('widgets/post-meta-elementor-widget/')
        );

        // Post Title.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_post_title_widget_field',
            esc_html__('Post Title', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/post-title.svg',
            true,
            self::demo_url('widgets/post-title-elementor-widget/')
        );

        // Pricing Table.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_pricing_table_widget_field',
            esc_html__('Pricing Table', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-pricing-table.svg',
            true,
            self::demo_url('widgets/advanced-pricing-table-elementor-widget/')
        );

        // Recent Post.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_recent_post_widget_field',
            esc_html__('Recent Posts', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/recent-posts-list.svg',
            true,
            self::demo_url('widgets/recent-posts-list-elementor-widget/')
        );

        // Related Post.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_related_post_widget_field',
            esc_html__('Related Posts', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/related-posts-elementor-widget/')
        );

        // Search Form.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_search_form_widget_field',
            esc_html__('Search Form', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/search-form-elementor-widget/')
        );

        // Search Icon.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_search_icon_widget_field',
            esc_html__('Search Icon', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/search-icon-elementor-widget/')
        );

        // Section Title.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_sec_title_widget_field',
            esc_html__('Section Title', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/section-title-elementor-widget/')
        );

        // Animated Shape.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_shape_anim_widget_field',
            esc_html__('Animated Shape', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/animated-shape.svg',
            true,
            self::demo_url('widgets/animated-shape-elementor-widget/')
        );

        // Single Image Scroll.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_single_img_scroll_field',
            esc_html__('Single Image Scroll', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/single-image-scroll-elementor-widget/')
        );

        // Site Logo.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_site_logo_widget_field',
            esc_html__('Site Logo', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/site-logo-elementor-widget/')
        );

        // Site Title & Tagline.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_site_title_tagline_field',
            esc_html__('Site Title & Tagline', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/site-title-and-tagline-elementor-widget')
        );

        // Skill Bar.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_skill_bar_widget_field',
            esc_html__('Skill Bar', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/skill-bar-elementor-widget/')
        );

        // Social Share.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_social_share_widget_field',
            esc_html__('Social Share', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/social-share-elementor-widget/')
        );

        // Sticker Text.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_sticker_text_field',
            esc_html__('Sticker Text', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/advanced-animated-text.svg',
            true,
            self::demo_url('widgets/sticker-text-elementor-widget/')
        );

        // Post Tag Info.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_tag_info_widget_field',
            esc_html__('Post Tag Info', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/post-tag-info.svg',
            true,
            self::demo_url('widgets/post-tag-info-elementor-widget/')
        );

        // Team Member.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_team_member_widget_field',
            esc_html__('Team Member', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/team-member-elementor-widget/')
        );

        // Testimonial Carousel.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_testi_caro_widget_field',
            esc_html__('Testimonial Carousel', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/testimonial-carousel-elementor-widget/')
        );

        // WordPress Menu.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_wp_menu_widget_field',
            esc_html__('WordPress Menu', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/wordpress-menu-elementor-widget/')
        );

        // Dual Button.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_dual_button_widget_field',
            esc_html__('Dual Button', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/dual-button.svg',
            true,
            self::demo_url('widgets/dual-button-elementor-widget/')
        );

        // Business Hours.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_business_hours_field',
            esc_html__('Business Hours', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/business-hours.svg',
            true,
            self::demo_url('widgets/business-hours-widget')
        );

        // Archive Title.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_archive_title_field',
            esc_html__('Archive Title', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/archive-title.svg',
            true,
            self::demo_url('widgets/archive-title-elementor-widget/')
        );

        // Gravity Form.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_gravity_form_field',
            esc_html__('Gravity Form', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/gravity-form.svg',
            true,
            self::demo_url('widgets/gravity-form-widget/')
        );

        // Image Gallery.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_image_gallery_field',
            esc_html__('Image Gallery', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/image-gallery.svg',
            true,
            self::demo_url('widgets/gallery-widget/')
        );

        // MailChimp.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_mailchimp_switch_field',
            esc_html__('MailChimp', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/mailchimp.svg',
            true,
            self::demo_url('widgets/mailchimp-widget/')
        );

        // Template Slider.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_template_slider_field',
            esc_html__('Template Slider', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/template-slider-widget/')
        );

        // Cost Estimation.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_cost_estimation_field',
            esc_html__('Cost Estimation', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/cost-estimation.svg',
            true,
            self::demo_url('widgets/cost-estimation-widget/')
        );

        // Modern Post Grid.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_modern_post_grid_field',
            esc_html__('Modern Post Grid', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/modern-post-grid.svg',
            true,
            self::demo_url('widgets/modern-post-grid/')
        );

        // Popular Posts.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_popular_posts_field',
            esc_html__('Popular Posts', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/popular-posts/')
        );

        // Fetch Posts.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_fetch_posts_field',
            esc_html__('Fetch Posts', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/fetch-posts/')
        );

        // Posts Slider.
        PrimeKitWidgets::primekit_available_widget(
            'primekit_posts_slider_field',
            esc_html__('Posts Slider', 'primekit-addons'),
            PRIMEKIT_ADMIN_ASSETS . '/img/icons/blockquote.svg',
            true,
            self::demo_url('widgets/posts-slider-widget/')
        );


    }


}
