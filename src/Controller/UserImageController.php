<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

/**
 * UserImageController est un custom Controller (custom Operation),
 * les données renvoyer vers UserImageController seront nommée $data par convention.
 *
 * __invoke() ce déclenche tout seul lorsqu'on appel la class UserImageController dans
 * la custom operation avec image qui est dans itemOperation de l'entité User
 */
class UserImageController
{
    public function __invoke(Request $request): User
    {
        $user = $request->attributes->get('data');
        

        if(! ($user instanceof User)){
            throw new \RuntimeException('Article attendu');
        }
        
        $user->setFile($request->files->get('file'));

        $user->setUpdatedAt(new \DateTime());

        return $user;
    }
}