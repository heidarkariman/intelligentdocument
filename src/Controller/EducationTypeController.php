<?php

namespace App\Controller;

use App\Entity\EducationType;
use App\Form\EducationTypeType;
use App\Repository\EducationTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/education/type')]
class EducationTypeController extends AbstractController
{
    #[Route('/', name: 'app_education_type_index', methods: ['GET'])]
    public function index(EducationTypeRepository $educationTypeRepository): Response
    {
        return $this->render('education_type/index.html.twig', [
            'education_types' => $educationTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_education_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EducationTypeRepository $educationTypeRepository): Response
    {
        $educationType = new EducationType();
        $form = $this->createForm(EducationTypeType::class, $educationType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $educationTypeRepository->save($educationType, true);

            return $this->redirectToRoute('app_education_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('education_type/new.html.twig', [
            'education_type' => $educationType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_education_type_show', methods: ['GET'])]
    public function show(EducationType $educationType): Response
    {
        return $this->render('education_type/show.html.twig', [
            'education_type' => $educationType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_education_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EducationType $educationType, EducationTypeRepository $educationTypeRepository): Response
    {
        $form = $this->createForm(EducationTypeType::class, $educationType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $educationTypeRepository->save($educationType, true);

            return $this->redirectToRoute('app_education_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('education_type/edit.html.twig', [
            'education_type' => $educationType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_education_type_delete', methods: ['POST'])]
    public function delete(Request $request, EducationType $educationType, EducationTypeRepository $educationTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$educationType->getId(), $request->request->get('_token'))) {
            $educationTypeRepository->remove($educationType, true);
        }

        return $this->redirectToRoute('app_education_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
