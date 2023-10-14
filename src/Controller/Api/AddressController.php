<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/address')]
class AddressController extends AbstractController
{
    #[Route('/{userId}', name: 'app_address_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        $addresses = $user->getAddress();
        $currentAddress = $addresses->filter(fn (Address $address) => $address->isMain())->first();

        return new JsonResponse([
            'street' => $currentAddress->getStreet(),
            'number' => $currentAddress->getStreetNumber(),
            'zip' => $currentAddress->getZipCode(),
            'city' => $currentAddress->getCity(),
        ]);
    }
}
