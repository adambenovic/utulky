<?php declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HealthController
 * @package App\Controller
 */
final class HealthController extends AbstractController
{
    #[Route('/api/health', name: 'health', methods: ['GET'])]
    public function health(): Response
    {
        return new JsonResponse(
            'healthy',
            Response::HTTP_OK,
        );
    }
}
