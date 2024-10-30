// const webAppUrl = 'https://hard-dragonfly-41.loca.lt';
const webAppUrl = 'https://app.chative.io';

window.addEventListener('message', function (e) {
  if (e.origin === webAppUrl) {
    const { orgId, channelId } = e.data;
    jQuery.ajax(
      {
        type: 'POST',
        url: ajaxurl + '?action=chative_setwidget',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify({ action: 'chative_setwidget', channelId, orgId}),
        success: function( r ) {
        },
        error: function(err) {
        }
      }
    );
  }
})
