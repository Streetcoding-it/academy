(function ($, Drupal) {
  Drupal.behaviors.opignoDropzonejsWidgets = {
    attach: function (context, settings) {

      // We have issue that we need to Init view first before select existing media.
      $("form[id^='entity-browser-media-entity-browser-groups-form--']").find(".views-exposed-form .button").click();
      $("form[id^='entity-browser-media-entity-browser-badge-images-form--']").find(".views-exposed-form .button").click();
      $("form[id^='entity-browser-media-entity-browser-file-pdf-form--']").find(".views-exposed-form .button").click();

      // Make form auto submission.
      var targetNode = document.querySelector("form.entity-browser-form #edit-actions .is-entity-browser-submit");

      if (targetNode) {
        // Options for the observer (which mutations to observe)
        var config = {attributes: true, subtree: true};
        // Create an observer instance
        var observer = new MutationObserver(function (mutations) {
          mutations.forEach(function (mutation) {
            if (mutation.attributeName === 'disabled') {
              // Check if file is loaded.
              var value = $("input[name='upload[uploaded_files]']").attr('value');
              if (value && value.length) {
                // Trigger click on submit button.
                $("form.entity-browser-form").find("#edit-actions .is-entity-browser-submit").click();
              }
              else {
                // This case can happen when the user tries to upload more files
                // than it's set in field cardinality. Entity browser handles
                // this case by uploading the limited number of files, but it
                // takes extra time.
                setTimeout(function () {
                  $("form.entity-browser-form").find("#edit-actions .is-entity-browser-submit").click();
                }, 1000);
              }
            }
          });
        });

        // Start observing the target node for configured mutations
        observer.observe(targetNode, config);
      }

      // observer.disconnect();

    }
  }
}(jQuery, Drupal));
