# Seasonal Home Slider

A small WordPress plugin for the PA Central Miata Club website, [pacemiataclub.org](https://pacemiataclub.org), that automatically swaps the homepage Avada/Fusion Slider based on the current season.

The plugin keeps the homepage Avada Slider element set to a single default slider, `home`, and intercepts that slider at render time to display the appropriate seasonal slider instead.

## Purpose

The PA Central Miata Club site uses Avada/Fusion Slider for the homepage banner. The club has four seasonal homepage banners:

* Spring
* Summer
* Fall
* Winter

Rather than manually editing the homepage each season, this plugin automatically selects the correct slider based on the current month. It also provides an admin override so a site administrator can force a specific season when needed.

## How It Works

The homepage should continue to use the native Avada Slider element set to:

```text
home
```

When WordPress renders the Avada/Fusion Slider shortcode for `home`, this plugin intercepts it and swaps the slider name to the current seasonal slider.

Default automatic mapping:

```text
Spring: March, April, May       → home-spring
Summer: June, July, August      → home-summer
Fall:   September, October, November → home-fall
Winter: December, January, February  → home-winter
```

## Required Avada Sliders

The following Avada/Fusion Sliders must exist:

```text
home
home-spring
home-summer
home-fall
home-winter
```

The `home` slider acts as the placeholder/default slider selected in the Avada page builder.

Each seasonal slider should contain the appropriate seasonal slide:

```text
home-spring → Spring banner slide
home-summer → Summer banner slide
home-fall   → Fall banner slide
home-winter → Winter banner slide
```

## Required Homepage Setup

On the homepage, use the native Avada Slider element.

The selected slider should remain:

```text
home
```

Do not replace the Avada Slider element with a Text Block, Code Block, or shortcode block.

Do not use:

```text
[seasonal_home_slider]
```

The plugin works by intercepting the existing Avada/Fusion Slider render process.

## Admin Settings

The plugin adds a settings page:

```text
WordPress Admin → Settings → Seasonal Home Slider
```

Available options:

```text
Auto
Spring
Summer
Fall
Winter
```

### Auto

Uses the current month to determine the season.

### Manual Override

Forces the homepage to display the selected seasonal slider, regardless of date.

This is useful for testing, special events, or temporary promotional banners.

## Installation

Upload the plugin folder to:

```text
wp-content/plugins/seasonal-home-slider/
```

The main plugin file should be located at:

```text
wp-content/plugins/seasonal-home-slider/seasonal-home-slider.php
```

Then activate it from:

```text
WordPress Admin → Plugins
```

## Recovery / Disable Instructions

If the plugin ever causes a fatal error or the site becomes inaccessible, disable it by renaming the plugin folder via SFTP, hosting file manager, or GoDaddy File Browser.

Rename:

```text
wp-content/plugins/seasonal-home-slider
```

to:

```text
wp-content/plugins/seasonal-home-slider-disabled
```

WordPress will automatically deactivate the plugin when the folder is renamed.

Do not rename the Avada theme folder. Do not disable unrelated plugins unless necessary.

## GoDaddy Managed WordPress Notes

The PA Central Miata Club site is hosted on GoDaddy Managed WordPress.

If wp-admin is unavailable, use one of these recovery methods:

```text
GoDaddy File Browser
SFTP
WordPress Recovery Mode email
GoDaddy Support
```

The only folder that should need to be renamed for plugin recovery is:

```text
wp-content/plugins/seasonal-home-slider
```

## Development Notes

This plugin intentionally avoids modifying the Avada parent theme.

It also avoids replacing homepage content with a custom shortcode, because Avada Slider rendering is most reliable when using the native Avada Slider element.

The plugin uses WordPress’s `pre_do_shortcode_tag` filter to intercept supported Avada/Fusion Slider shortcode tags before rendering.

Supported shortcode tags checked by the plugin:

```text
fusion_slider
fusionslider
fusion_fusionslider
```

Only sliders named exactly `home` are intercepted.

Other Avada sliders on the site are left untouched.

## Version History

### 1.4.0

* Added admin settings page.
* Added Auto / Spring / Summer / Fall / Winter override.
* Preserved automatic month-based behavior.

### 1.3.0

* Switched to safer shortcode interception using `pre_do_shortcode_tag`.
* Removed risky content rewriting and Avada builder internal filters.
* Limited interception to the `home` slider only.

## Maintenance Checklist

When updating seasonal images:

1. Go to Avada/Fusion Slides.
2. Edit the slide for the correct season.
3. Replace the Featured Image with the new Media Library image.
4. Confirm the slide is assigned to the correct seasonal slider.
5. Confirm the homepage Avada Slider element is still set to `home`.
6. Clear Avada/site cache if needed.
7. Test the setting under:

```text
Settings → Seasonal Home Slider
```

## Site-Specific Slider Names

This plugin currently assumes these slider names:

```text
home-spring
home-summer
home-fall
home-winter
```

If the slider names are changed in Avada, update the `$slider_names` array in `seasonal-home-slider.php`.

## License / Ownership

Custom utility plugin created for the PA Central Miata Club website.

Site: [pacemiataclub.org](https://pacemiataclub.org)
