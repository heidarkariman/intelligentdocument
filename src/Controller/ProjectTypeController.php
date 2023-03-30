<?php

namespace App\Controller;

use App\Entity\ProjectType;
use App\Form\ProjectTypeType;
use App\Repository\ProjectTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/project/type')]
class ProjectTypeController extends AbstractController
{
    #[Route('/', name: 'app_project_type_index', methods: ['GET'])]
    public function index(ProjectTypeRepository $projectTypeRepository): Response
    {
        return $this->render('project_type/index.html.twig', [
            'project_types' => $projectTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_project_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProjectTypeRepository $projectTypeRepository): Response
    {
        $projectType = new ProjectType();
        $form = $this->createForm(ProjectTypeType::class, $projectType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectTypeRepository->save($projectType, true);

            return $this->redirectToRoute('app_project_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project_type/new.html.twig', [
            'project_type' => $projectType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_type_show', methods: ['GET'])]
    public function show(ProjectType $projectType): Response
    {
        return $this->render('project_type/show.html.twig', [
            'project_type' => $projectType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_project_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProjectType $projectType, ProjectTypeRepository $projectTypeRepository): Response
    {
        $form = $this->createForm(ProjectTypeType::class, $projectType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectTypeRepository->save($projectType, true);

            return $this->redirectToRoute('app_project_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project_type/edit.html.twig', [
            'project_type' => $projectType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_type_delete', methods: ['POST'])]
    public function delete(Request $request, ProjectType $projectType, ProjectTypeRepository $projectTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projectType->getId(), $request->request->get('_token'))) {
            $projectTypeRepository->remove($projectType, true);
        }

        return $this->redirectToRoute('app_project_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
