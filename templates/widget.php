<?php
/**
 * @package Chative Widget for WordPress
 * @author Chative
 * @copyright (C) 2021- Chative
 */
?>

<script type="text/javascript">
(function (t, a) {
  var n = a.location.hostname;
  var c = t.createElement("script");
  var channelId = '<?php echo esc_js(get_option('chative-channel-id')) ?>';
  c.src = 'https://messenger.svc.chative.io/static/v1.0/channels/' + channelId + '/script.js?mode=livechat' + '&hostname=' + n;
  c.type = "text/javascript";
  c.async = 1;
  t.body.append(c)
})(document, window);
</script>

