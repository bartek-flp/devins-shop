<?php

namespace Drupal\devinshop\Helpers;

use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CurrentUser {
    /**
     * @var AccountInterface $account
     */
    protected $account;

    /**
     * Class constructor.
     */
    public function __construct(AccountInterface $account) {
        $this->account = $account;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        // Instantiates this form class.
        return new static(
        // Load the service required to construct this class.
            $container->get('current_user')
        );
    }

    public function getId()
    {
        return $this->account->id();
    }
}