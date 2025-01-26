<?php

namespace Drupal\rust_playground\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\Annotation\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Formatta il campo Rust Code ed esegue il codice tramite Playground API.
 *
 * @FieldFormatter(
 *   id = "rust_code_formatter",
 *   label = @Translation("Rust Code Formatter"),
 *   field_types = {
 *     "rust_code"
 *   }
 * )
 */
class RustCodeFormatter extends FormatterBase {

  /**
   * Formatta l'output del campo.
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $code = $item->value;
      $output = $this->executeRustCode($code);

      $elements[$delta] = [
        '#theme' => 'rust_code_display',
        '#code' => $code,
        '#output' => $output,
      ];
    }

    return $elements;
  }

  /**
   * Invia il codice Rust al Playground API ed esegue il codice.
   */
  private function executeRustCode($code) {
    $client = new Client();

    try {
      $response = $client->post('https://play.rust-lang.org/execute', [
        'json' => [
          'code' => $code,
          'edition' => '2021',
          'crateType' => 'bin',
          'mode' => 'debug',
          'channel' => 'stable',
          'tests' => false
        ],
      ]);

      $result = json_decode($response->getBody()->getContents(), TRUE);
      return isset($result['stdout']) ? nl2br($result['stdout']) : 'Nessun output';

    } catch (RequestException $e) {
      return 'Errore nell\'esecuzione del codice: ' . $e->getMessage();
    }
  }
}

