<?php

namespace Drupal\devinshop_cart\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Database\Connection;
use Drupal\devinshop\Controller\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddToCart extends ControllerBase implements ContainerInjectionInterface {

    /**
     * @var AccountInterface $account
     */
    protected $account;

    /**
     * @var Database $db
     */
    private $db;

    /**
     * @return Database
     */
    private function getDatabaseConnection()
    {
        return $this->db;
    }

    /**
     * @return AccountInterface
     */
    private function getCurrentUser()
    {
        return $this->account;
    }

    /**
     * AddToCart constructor.
     *
     * @param AccountInterface $account
     * @param Database $db
     */
    public function __construct(AccountInterface $account, Database $db) {
        $this->account = $account;
        $this->db = $db;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('current_user'),
            $container->get('devinshop.db')
        );
    }

    public function add($pid)
    {
        $fields = [
            'product_id' => $pid,
            'user_id' => $this->getCurrentUser()->id(),
        ];

//        try {
//            $db = $this->getDatabaseConnection();
//            $db->insert('cart_items', $fields);
//        } catch (\Exception $e) {
//            echo 'Caught exception: ',  $e->getMessage(), "\n";
//        }

        $db = $this->getDatabaseConnection();
        $db->insert('cart_items', $fields);

        //move to separate class, maybe interface with easy redirects.
        $path = \Drupal\Core\Url::fromUserInput('/node/' . $pid)->toString();

        return new RedirectResponse($path);

    }
}
