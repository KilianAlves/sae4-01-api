<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetMeController extends AbstractController
{
    public function __invoke(): \Symfony\Component\Security\Core\User\UserInterface
    {
        if (null != $this->getUser()) {
            $res = $this->getUser();
        } else {
            $res = $this->createNotFoundException('The product does not exist');
        }

        return $res;
    }
}
