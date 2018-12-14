<?php

/**
 * @file
 * Contains \Drupal\devinshop_calculators\Form\IbuCalculatorForm.
 */

namespace Drupal\devinshop_calculators\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\taxonomy\Entity\Term;

/**
 * Contribute form.
 */
class IbuCalculatorForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'ibu_calculator';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['#attached']['library'][] = 'devinshop_calculators/ibucalc';

        $form['hop_variety'] = [
            '#type' => 'entity_autocomplete',
            '#target_type' => 'taxonomy_term',
            '#selection_settings' => [
                'target_bundles' => ['hop_variety'],
            ],
//            '#selection_handler' => 'views',
//            '#selection_settings' => [
//                'view' => [
//                    'view_name' => 'hop_list',
//                    'display_name' => 'default',
//                ],
//                'match_operator' => 'CONTAINS'
//            ],
            '#ajax' => [
                'callback' => 'Drupal\devinshop_calculators\Form\GetHopsData::data',
                'event' => 'autocompleteclose',
                'wrapper' => 'edit-output',
            ],
        ];

        // Wrap textfields in a container. This container will be replaced through
        // AJAX.
        $form['data_container'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'edit-output'],
        ];

        // This form is rebuilt on all requests, so whether or not the request comes
        // from AJAX, we should rebuild everything based on the form state.
        // Checkbox values are expressed as 1 or 0, so we have to be sure to compare
        // type as well as value.
        $form['data_container']['alfa_acids'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Alpha Acids (all)'),
            '#required' => TRUE,
            '#attributes' => ['class' => ['alpha-acid']],
        ];

        $form['data_container']['cohumulon'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Cohumulon'),
        ];

        $form['hop']['wort_gravity'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Gravity [Plato]'),
            '#attributes' => ['class' => ['wort-gravity']],
        ];

        $form['hop']['weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Weight [g]'),
            '#attributes' => ['class' => ['hop-weight']],
        ];

        $form['hop']['contact_time'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact time in boiled wort [min]'),
            '#attributes' => ['class' =>['hop-contact-time']],
        ];

        $form['hop']['ibu-value'] = [
            '#markup' => '<div class="ibu-value">IBU: 0</div>',
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

    }

}
