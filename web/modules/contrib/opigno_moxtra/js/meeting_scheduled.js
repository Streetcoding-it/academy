(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.opignoMoxtraMeetingScheduled = {
    attach: function (context, settings) {
      mepsdk.setup({
        baseDomain: drupalSettings.opignoMoxtra.baseDomain,
        deployDirectory: 'web',
        accessToken: drupalSettings.opignoMoxtra.accessToken
      });

      const $startBtn = $(once('click', '#start-meeting', context));
      $startBtn.click(function (e) {

        e.preventDefault();
        $('.start-meeting').hide();

        mepsdk.joinMeetWithMeetID(drupalSettings.opignoMoxtra.sessionKey,'#live-meeting-container', { autoJoinAudio: true });

        $startBtn.parent('.start-meeting').hide();
        return false;
      });
    },
  };
}(jQuery, Drupal, drupalSettings));
