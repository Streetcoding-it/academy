(function ($, Drupal) {
  Drupal.behaviors.aceEditorInit = {
    attach: function (context, settings) {
      if (!context.querySelector("#ace-editor")) {
        return;
      }

      var editor = ace.edit("ace-editor");
      editor.setTheme("ace/theme/monokai");  // Cambia il tema se necessario
      editor.session.setMode("ace/mode/rust"); // Evidenziazione per Rust
      editor.setFontSize("14px");
      editor.setShowPrintMargin(false);

      // DEBUG: Verifica che l'editor sia stato inizializzato
      console.log("Ace Editor inizializzato");

      // Aggiorna la textarea quando l'utente scrive nell'editor
      editor.session.on('change', function () {
        $("#edit-code").val(editor.getValue());
      });

      // Copia il contenuto dell'editor nella textarea prima di inviare il form
      $("form").on("submit", function () {
        var codeValue = editor.getValue();
        $("#edit-code").val(codeValue);

        // DEBUG: Controlla se il codice viene copiato correttamente
        console.log("Codice copiato: ", codeValue);
      });
    }
  };
})(jQuery, Drupal);

