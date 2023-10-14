<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/pet')]
class PetController extends AbstractController
{
    #[Route('/{id}', name: 'app_pet_show', methods: ['GET'])]
    public function show(Pet $pet): Response
    {
        $interval = (new \DateTime())->diff($pet->getDateOfBirth());
        $years = match ($interval->y) {
            0 => null,
            1 => $interval->y . ' rok',
            2, 3, 4 => $interval->y . ' roky',
            default => $interval->y . ' rokov',
        };

        $months = match ($interval->m) {
            0 => null,
            1 => $interval->m . ' mesiac',
            2, 3, 4 => $interval->m . ' mesiace',
            default => $interval->m . ' mesiacov',
        };

        $days = match ($interval->d) {
            0 => null,
            1 => $interval->d . ' deň',
            2, 3, 4 => $interval->d . ' dni',
            default => $interval->d . ' dní',
        };

        return new JsonResponse([
            'id' => $pet->getId(),
            'name' => $pet->getName(),
            'size' => $pet->getSize(),
            'type' => $pet->getType(),
            'age' => trim($years . ' ' . $months . ' ' . $days),
        ]);
    }
}
