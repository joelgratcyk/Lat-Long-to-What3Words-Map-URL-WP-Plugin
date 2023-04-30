# Lat Long to What3Words Map URL WP Plugin

This WordPress plugin automatically converts geolocation data to a What3Words address for WP Job Manager location posts. When a post is saved, it checks if it's a WP Job Manager post and if the What3Words meta data is already set. If not, it gets the latitude and longitude from the previously geolocated WP Job Manager fields, makes an API request to the What3Words API, and saves the resulting What3Words map address as a custom field.

## Requirements

* WordPress 4.7 or later
* WP Job Manager 1.30.0 or later

## Installation

1. Download the plugin zip file from the [GitHub repository](https://github.com/joelgratcyk/lat-long-to-what3words-wp-plugin-geo-added-calling).
2. In your WordPress dashboard, go to Plugins > Add New.
3. Click on the "Upload Plugin" button.
4. Select the plugin zip file and click "Install Now".
5. Activate the plugin.

## Configuration

The plugin requires a What3Words API key to make API requests. You can get a free API key by [signing up on the What3Words website](https://accounts.what3words.com/register). Once you have a key, go to wp-what3words-plugin.php and find YOUR_API_KEY on Line 34. Replace YOUR_API_KEY with the API key you want to use from your What3Words Developer account.

## Usage

After installing and configuring the plugin, all new job listing posts with geolocation data will automatically have their What3Words address calculated and saved as a custom field called `_what3words`. You can display this field in your templates by using the `get_post_meta` function, e.g.:

```
$what3words = get_post_meta( get_the_ID(), '_what3words', true );
echo 'What3Words address: ' . $what3words;
```

## Changelog

### 1.0

* Initial release

## Credits

* Joel Gratcyk (author)
* MacGPT (contributor)

## License

This plugin is released under the MIT License. See the [LICENSE](LICENSE) file for details.

The included Geocoder.php is copyright what3words Ltd and included with permission. You can find it's source [here](https://github.com/what3words/w3w-php-wrapper/blob/master/src/Geocoder.php).
