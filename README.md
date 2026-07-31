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

## Screenshots
<img width="1919" height="910" alt="1" src="https://github.com/user-attachments/assets/ef403d10-f410-4ea0-88ce-4e729f51acb1" />
<img width="1918" height="908" alt="2" src="https://github.com/user-attachments/assets/1a5626f8-a095-4432-8bd2-103afec557c2" />
<img width="1919" height="908" alt="3" src="https://github.com/user-attachments/assets/8316a759-a7f5-458e-b0fa-28edd0083100" />

## Video
Play the video to see it in action
https://github.com/user-attachments/assets/07e2e466-00ae-4edf-863e-d3a31319e8b4

## Usage
Insert the shortcode on any post, page, or page builder (such as an Elementor shortcode widget).

### Standard Shortcode
```text
[ibaw_scroll_video src="[https://yourdomain.com/wp-content/uploads/your-video.mp4](https://yourdomain.com/wp-content/uploads/your-video.mp4)"]
