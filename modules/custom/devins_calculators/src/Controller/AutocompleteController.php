<?php

namespace Drupal\devinshop_calculators\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Tags;
use Drupal\Component\Utility\Unicode;

/**
 * Defines a route controller for entity autocomplete form elements.
 */
class AutocompleteController extends ControllerBase {

    /**
     * Handler for autocomplete request.
     */
    public function handleAutocomplete(Request $request) {
        $results = [];

        // Get the typed string from the URL, if it exists.
        if ($input = $request->query->get('q')) {
            $typed_string = Tags::explode($input);
            $typed_string = Unicode::strtolower(array_pop($typed_string));
            // @todo: Apply logic for generating results based on typed_string and other
            // arguments passed.
        }

        return new JsonResponse($results);
    }

}