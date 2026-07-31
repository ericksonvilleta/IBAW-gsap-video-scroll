# IBAW-GSAP Video Scroll Animation

A lightweight WordPress plugin that leverages GSAP and ScrollTrigger to seamlessly scrub through MP4 video playback as the user scrolls down the page. 

## Features
*   **GSAP Integration:** Automatically enqueues GSAP Core and ScrollTrigger from a reliable CDN.
*   **Shortcode Implementation:** Easily embed the scroll-animated video anywhere on your site using a simple shortcode.
*   **Customizable Scroll Depth:** Adjust the `scroll_height` parameter to control how long the user needs to scroll to finish the video, effectively acting as a playback speed controller.
*   **Sticky Viewport Layout:** Keeps the video pinned cleanly to the viewport while the scrubbing animation takes place.

## Installation
1. Create a folder named `ibaw-gsap-video-scroll` in your WordPress `wp-content/plugins/` directory.
2. Upload the `ibaw-gsap-video-scroll.php` file into this folder.
3. Log in to your WordPress Admin Dashboard.
4. Navigate to **Plugins** > **Installed Plugins**.
5. Locate **IBAW-GSAP Video Scroll Animation** and click **Activate**.

## Usage
Insert the shortcode on any post, page, or page builder (such as an Elementor shortcode widget).

### Standard Shortcode
```text
[ibaw_scroll_video src="[https://yourdomain.com/wp-content/uploads/your-video.mp4](https://yourdomain.com/wp-content/uploads/your-video.mp4)"]
