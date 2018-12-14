<?php

/**
 * @file
 * Contains \Drupal\devinshop_calculators\Form\Test.
 */

namespace Drupal\devinshop_calculators\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;

class GetHopsData  {

    use StringTranslationTrait;

    public function data(array &$form, FormStateInterface $form_state) : array {
        $tid = $form_state->getValue('hop_variety');
        $term = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($tid);
        $alphaAcids = !empty($term->field_alpha_acids->value) ? $term->field_alpha_acids->value : '';
        $cohumulon = !empty($term->field_cohumulon->value) ? $term->field_cohumulon->value : '';

        $form['data_container']['alfa_acids'] = [
            '#type' => 'textfield',
            '#title' => 'Alfa Kwasy (całościowo)',
            '#size' => '60',
            '#value' => $alphaAcids,
            '#attributes' => [
                'id' => ['edit-output'],
                'class' => ['alpha-acid'],
            ],
        ];
        $form['data_container']['cohumulon'] = [
            '#type' => 'textfield',
            '#title' => 'Cohumulon',
            '#size' => '60',
            '#value' => $cohumulon,
            '#attributes' => [
                'id' => ['edit-output'],
            ],
        ];

        return $form['data_container'];

    }
}
