# PA Central Miata Club WordPress Customizations

This repository contains custom WordPress code for the PA Central Miata Club website:

https://pacemiataclub.org

The site uses WordPress with the Avada theme. Customizations in this repository are intended to be small, isolated, and update-safe. They should not modify the Avada parent theme directly.

## Repository Structure

```text
pacemiata/
  README.md
  plugins/
    seasonal-home-slider/
      README.md
      seasonal-home-slider.php
```

## Custom Plugins

### Seasonal Slider

Location:

```text
plugins/seasonal-home-slider/
```

Purpose:

Automatically swaps the homepage Avada/Fusion Slider based on the current season.

The homepage should continue to use the native Avada Slider element set to:

```text
home
```

The plugin intercepts that slider at render time and swaps it to one of the seasonal sliders:

```text
home-spring
home-summer
home-fall
home-winter
```

The plugin also provides a WordPress admin settings page:

```text
Settings → Seasonal Home Slider
```

Available modes:

```text
Auto
Spring
Summer
Fall
Winter
```

`Auto` uses the current month to determine the season. The manual options force a specific seasonal banner.

## Deployment

Custom plugins should be deployed into the WordPress plugins directory.

For the seasonal slider plugin, the deployed folder should be:

```text
wp-content/plugins/seasonal-home-slider/
```

The main plugin file should be:

```text
wp-content/plugins/seasonal-home-slider/seasonal-home-slider.php
```

After deployment, activate the plugin from:

```text
WordPress Admin → Plugins
```

## Avada Theme Guidance

Do not edit the Avada parent theme directly.

Custom behavior should be implemented through:

* a custom plugin
* an Avada child theme, if theme-level customization is required
* Avada builder/layout configuration where possible

For the seasonal homepage slider, use the native Avada Slider element and leave it set to:

```text
home
```

Do not replace the Avada Slider element with a Text Block, Code Block, or custom shortcode block.

## Required Avada Sliders

The following Avada/Fusion Sliders should exist:

```text
home
home-spring
home-summer
home-fall
home-winter
```

Recommended slide assignment:

```text
home-spring → Spring banner slide
home-summer → Summer banner slide
home-fall   → Fall banner slide
home-winter → Winter banner slide
```

## Recovery Instructions

If a custom plugin causes a fatal error and wp-admin is inaccessible, disable the plugin by renaming its folder through SFTP, GoDaddy File Browser, or another hosting file manager.

For the seasonal slider plugin, rename:

```text
wp-content/plugins/seasonal-home-slider
```

to:

```text
wp-content/plugins/seasonal-home-slider-disabled
```

WordPress will automatically deactivate the plugin when the folder is renamed.

Do not rename the Avada theme folder. Do not disable unrelated plugins unless necessary.

## Hosting Notes

The site is hosted on GoDaddy Managed WordPress.

If wp-admin is unavailable, recovery options include:

```text
GoDaddy File Browser
SFTP
WordPress Recovery Mode email
GoDaddy Support
```

For SFTP access, use the GoDaddy hosting dashboard credentials, not the WordPress admin username and password.

## Maintenance Checklist

When updating seasonal banners:

1. Log in to WordPress.
2. Go to the Avada/Fusion Slides area.
3. Edit the appropriate seasonal slide.
4. Replace the Featured Image with the new Media Library image.
5. Confirm the slide is assigned to the correct seasonal slider.
6. Confirm the homepage Avada Slider element is still set to `home`.
7. Go to `Settings → Seasonal Home Slider`.
8. Test each override option if needed.
9. Return the setting to `Auto` unless a manual override is desired.
10. Clear Avada/site/hosting cache if the update is not immediately visible.

## Development Principles

* Keep custom code isolated in plugins.
* Avoid editing Avada parent theme files.
* Avoid broad hooks or risky content rewrites when possible.
* Prefer narrow, targeted WordPress hooks.
* Keep recovery simple by ensuring custom plugins can be disabled by renaming their folder.
* Document any site-specific assumptions, especially Avada slider names.

## Site-Specific Assumptions

The seasonal slider plugin assumes the homepage Avada Slider element uses the slider named:

```text
home
```

It also assumes the seasonal sliders are named:

```text
home-spring
home-summer
home-fall
home-winter
```

If these names change in Avada, update the plugin code accordingly.

## Ownership

Custom utility code for the PA Central Miata Club website.

Site:

https://pacemiataclub.org
