<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Application;
use App\Entity\Attribute;
use App\Entity\Pet;
use App\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/application')]
class ApplicationController extends AbstractController
{
    #[Route('/user/{userId}/', name: 'app_application_user', methods: ['GET'])]
    public function formsByUser(User $user): Response
    {
        $forms = $user->getApplications();

        return new JsonResponse([

        ], Response::HTTP_OK);
    }

    #[Route('/user/{userId}/pet/{petId}', name: 'app_application_user_pet', methods: ['GET'])]
    public function formsByUserAndPet(User $user, Pet $pet): Response
    {
        $forms = $user->getApplications()->filter(fn(Application $form) => $form->getPet()->getId() === $pet->getId());

        return new JsonResponse([

        ], Response::HTTP_OK);
    }

    #[Route('/pet/{id<\d+>}/', name: 'app_application_pet', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns the application form for the given pet',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Attribute::class))
        )
    )]
    #[OA\Parameter(
        name: 'id',
        description: 'The id of the pet',
        in: 'path',
        schema: new OA\Schema(type: 'id')
    )]
    public function formByPet(Pet $pet): Response
    {
        return new JsonResponse($pet
            ->getTemplate()
            ->getAttributes()
            ->map(function (Attribute $attribute) {
                return [
                    'id' => $attribute->getId(),
                    'name' => $attribute->getName(),
                    'type' => $attribute->getType(),
                    'required' => $attribute->isRequired(),
                    'choices' => $attribute->getChoices(),
                ];
            })
            ->toArray(), Response::HTTP_OK);
    }
}
