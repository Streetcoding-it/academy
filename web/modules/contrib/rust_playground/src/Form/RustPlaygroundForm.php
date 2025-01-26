<?php

namespace Drupal\rust_playground\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Render\Markup;

/**
 * Class RustPlaygroundForm.
 *
 * Form per inviare codice Rust al Playground API.
 */
class RustPlaygroundForm extends FormBase {

  /**
   * Identificativo del form.
   */
  public function getFormId() {
    return 'rust_playground_form';
  }

  /**
   * Costruisce il form con Ace Editor.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Area di testo nascosta per memorizzare il codice.
    $form['code'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Inserisci codice Rust'),
      '#description' => $this->t('Scrivi il codice Rust da eseguire nel Playground'),
      '#attributes' => ['id' => 'edit-code'], // Imposta ID per accesso JS
      '#default_value' => '',
      '#required' => TRUE,
    ];

    // Div per Ace Editor.
    $form['editor'] = [
      '#type' => 'markup',
      '#markup' => Markup::create('<div id="ace-editor" style="height: 300px; width: 100%; border: 1px solid #ccc;"></div>'),
    ];

    // Pulsante di invio.
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Esegui codice'),
      '#attributes' => ['id' => 'submit-button'], // Aggiunto ID per debugging
    ];

    // Aggiungi il file JavaScript di Ace Editor.
    $form['#attached']['library'][] = 'rust_playground/ace_editor';

    return $form;
  }

  /**
   * Gestisce il submit del form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage($this->t('Metodo submitForm chiamato.')); // Debug

    $code = $form_state->getValue('code');

    // Creazione del client HTTP per la richiesta al Playground Rust API.
    $client = new Client();

    try {
        $response = $client->post('https://play.rust-lang.org/execute', [
            'json' => [
                'code' => $code,
                'edition' => '2021',
                'crateType' => 'bin',
                'mode' => 'debug',
                'channel' => 'stable',
                'tests' => false // ⚠️ Campo richiesto per evitare errore 400
            ],
        ]);

        // Decodifica la risposta.
        $result = json_decode($response->getBody()->getContents(), TRUE);

        // Debug: Mostra il codice inviato e il risultato.
        \Drupal::logger('rust_playground')->notice('Codice inviato: @code', ['@code' => $code]);
        \Drupal::logger('rust_playground')->notice('Risultato ricevuto: @output', ['@output' => $result['stdout'] ?? 'Nessun output']);

        // Mostra il risultato all'utente.
        \Drupal::messenger()->addMessage($this->t('Risultato: @output', ['@output' => $result['stdout'] ?? 'Errore']));

    } catch (RequestException $e) {
        // Debug: Mostra l'errore nella richiesta.
        \Drupal::logger('rust_playground')->error('Errore durante l\'invio del codice: @error', ['@error' => $e->getMessage()]);

        // Mostra un messaggio di errore all'utente.
        \Drupal::messenger()->addError($this->t('Errore nella richiesta API: @error', ['@error' => $e->getMessage()]));
    }
  }
}

