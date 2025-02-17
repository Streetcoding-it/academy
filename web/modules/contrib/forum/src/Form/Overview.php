<?php

namespace Drupal\forum\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\Core\Url;
use Drupal\taxonomy\Form\OverviewTerms;
use Drupal\taxonomy\VocabularyInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Provides forum overview form for the forum vocabulary.
 *
 * @internal
 * @phpstan-ignore-next-line
 */
class Overview extends OverviewTerms {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'forum_overview';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, ?VocabularyInterface $taxonomy_vocabulary = NULL) {
    $forum_config = $this->config('forum.settings');
    $vid = $forum_config->get('vocabulary');
    $vocabulary = $this->entityTypeManager->getStorage('taxonomy_vocabulary')->load($vid);
    if (!$vocabulary) {
      throw new NotFoundHttpException();
    }

    // Build base taxonomy term overview.
    $form = parent::buildForm($form, $form_state, $vocabulary);

    foreach (Element::children($form['terms']) as $key) {
      if (isset($form['terms'][$key]['#term'])) {
        /** @var \Drupal\taxonomy\TermInterface $term */
        $term = $form['terms'][$key]['#term'];
        $form['terms'][$key]['term']['#url'] = Url::fromRoute('forum.page', ['taxonomy_term' => $term->id()]);

        if (!empty($term->forum_container->value)) {
          $title = $this->t('edit container');
          $url = Url::fromRoute('entity.taxonomy_term.forum_edit_container_form', ['taxonomy_term' => $term->id()]);
        }
        else {
          $title = $this->t('edit forum');
          $url = Url::fromRoute('entity.taxonomy_term.forum_edit_form', ['taxonomy_term' => $term->id()]);
        }

        // Re-create the operations column and add only the edit link.
        $form['terms'][$key]['operations'] = [
          '#type' => 'operations',
          '#links' => [
            'edit' => [
              'title' => $title,
              'url' => $url,
            ],
          ],
        ];

      }
    }

    // Remove the alphabetical reset.
    unset($form['actions']['reset_alphabetical']);

    // Use the existing taxonomy overview submit handler.
    $form['terms']['#empty'] = $this->t('No containers or forums available. <a href=":container">Add container</a> or <a href=":forum">Add forum</a>.', [
      ':container' => Url::fromRoute('forum.add_container')->toString(),
      ':forum' => Url::fromRoute('forum.add_forum')->toString(),
    ]);
    return $form;
  }

}
