<?php
/**
 * Plugin Name: IBAW-GSAP Video Scroll Animation
 * Plugin URI: https://ericksonvilleta.com
 * Description: Enables GSAP ScrollTrigger video scrubbing for MP4 videos via shortcode or custom CSS classes.
 * Version: 1.0.0
 * Author: Erick Villeta
 * Author URI: https://ericksonvilleta.com
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Prevent direct access
}

class IBAW_GSAP_Video_Scroll {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'ibaw_enqueue_assets' ) );
        add_shortcode( 'ibaw_scroll_video', array( $this, 'ibaw_render_video_shortcode' ) );
    }

    /**
     * Enqueue GSAP, ScrollTrigger, and custom scrubbing script
     */
    public function ibaw_enqueue_assets() {
        // Register GSAP Core and ScrollTrigger from CDN
        wp_register_script( 'ibaw-gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true );
        wp_register_script( 'ibaw-gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array( 'ibaw-gsap' ), '3.12.5', true );

        // Enqueue GSAP scripts
        wp_enqueue_script( 'ibaw-gsap' );
        wp_enqueue_script( 'ibaw-gsap-scrolltrigger' );

        // Add inline CSS for full-screen video scrubbing layout
        $custom_css = "
            .ibaw-video-scroll-container {
                position: relative;
                width: 100%;
                overflow: visible;
            }
            .ibaw-video-sticky-wrapper {
                position: sticky;
                top: 0;
                width: 100%;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }
            .ibaw-gsap-video {
                width: 100%;
                height: 100%;
                object-fit: cover;
                pointer-events: none;
            }
        ";
        wp_add_inline_style( 'wp-block-library', $custom_css );

        // Add inline JS to execute GSAP ScrollTrigger timeline
        $custom_js = "
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
                
                gsap.registerPlugin(ScrollTrigger);

                const scrollContainers = document.querySelectorAll('.ibaw-video-scroll-container');

                scrollContainers.forEach(container => {
                    const video = container.querySelector('.ibaw-gsap-video');
                    if (!video) return;

                    const initVideoScroll = () => {
                        // Ensure video is paused so GSAP takes full control of playback position
                        video.pause();

                        let tl = gsap.timeline({
                            scrollTrigger: {
                                trigger: container,
                                start: 'top top',
                                end: 'bottom bottom',
                                scrub: 1, // Smooth scrubbing effect (1 second catch-up)
                                pin: container.querySelector('.ibaw-video-sticky-wrapper'),
                                anticipatePin: 1
                            }
                        });

                        // Scrub video.currentTime across the duration of the scroll area
                        tl.fromTo(video, 
                            { currentTime: 0 }, 
                            { 
                                currentTime: video.duration || 1, 
                                ease: 'none' 
                            }
                        );
                    };

                    // Execute when video metadata (duration) is loaded
                    if (video.readyState >= 1) {
                        initVideoScroll();
                    } else {
                        video.addEventListener('loadedmetadata', initVideoScroll);
                    }
                });
            });
        ";
        wp_add_inline_script( 'ibaw-gsap-scrolltrigger', $custom_js );
    }

    /**
     * Render MP4 video container shortcode
     * Usage: [ibaw_scroll_video src="https://example.com/video.mp4" scroll_height="300vh"]
     */
    public function ibaw_render_video_shortcode( $atts ) {
        $atts = shortcode_atts(
            array(
                'src'           => '',
                'scroll_height' => '300vh', // Controls how long the user must scroll to complete the video
            ),
            $atts,
            'ibaw_scroll_video'
        );

        if ( empty( $atts['src'] ) ) {
            return '';
        }

        ob_start();
        ?>
        <div class="ibaw-video-scroll-container" style="height: <?php echo esc_attr( $atts['scroll_height'] ); ?>;">
            <div class="ibaw-video-sticky-wrapper">
                <video class="ibaw-gsap-video" 
                       src="<?php echo esc_url( $atts['src'] ); ?>" 
                       muted 
                       playsinline 
                       preload="auto">
                </video>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

// Initialize the plugin
new IBAW_GSAP_Video_Scroll();