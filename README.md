# TwoClickPrivacy

This Joomla!-Plugin hides embedded videos and reveales them only on click. This prevents the loading of third-party cookies to protect the users privacy.

No additional steps other than installation and activation in Joomla! are required. The script will detect embedded YouTube- and Vimeo-videos and hide them.

However you can modify the texts and colors shown when the video is hidden in the Joomla!-Backend if you like.

## Disclaimer

This plugin will not prevent cookies to be loaded when JavaScript is deactivated in the users browser. Therefore it should only be used as an additional layer of privacy-protection. 

It is recommended that you add a corresponding paragraph to your sites privacy policy when you embed external videos to comply with the european General Data Protection Regulation (GDPR).

Do not rely on this plugin for legal security, the use is at your own risk.

If you want support for browsers with deactivated JavaScript, you need to replace the ```src```-attribute with ```data-src``` like this (example from [https://github.com/a-v-l/dsgvo-video-embed](https://github.com/a-v-l/dsgvo-video-embed))

Starting from
```html
  <!-- Example YouTube -->
  <iframe width="560" height="315" src="https://www.youtube.com/embed/hZ3w5VMr8gw?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  <!-- Example Vimeo -->
  <iframe src="https://player.vimeo.com/video/10149605" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
```

```src``` replaced with ```data-src```:
```html
  <!-- Example YouTube -->
  <iframe width="560" height="315" data-src="https://www.youtube.com/embed/hZ3w5VMr8gw?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  <!-- Example Vimeo -->
  <iframe data-src="https://player.vimeo.com/video/10149605" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
```

## Credits:
- Base functionality derived from [https://github.com/a-v-l/dsgvo-video-embed](https://github.com/a-v-l/dsgvo-video-embed)
