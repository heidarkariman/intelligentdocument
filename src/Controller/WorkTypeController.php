<?php

namespace App\Controller;

use App\Entity\WorkType;
use App\Form\WorkTypeType;
use App\Repository\WorkTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/work/type')]
class WorkTypeController extends AbstractController
{
    #[Route('/', name: 'app_work_type_index', methods: ['GET'])]
    public function index(WorkTypeRepository $workTypeRepository): Response
    {
        return $this->render('work_type/index.html.twig', [
            'work_types' => $workTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_work_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WorkTypeRepository $workTypeRepository): Response
    {
        $workType = new WorkType();
        $form = $this->createForm(WorkTypeType::class, $workType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workTypeRepository->save($workType, true);

            return $this->redirectToRoute('app_work_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('work_type/new.html.twig', [
            'work_type' => $workType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_work_type_show', methods: ['GET'])]
    public function show(WorkType $workType): Response
    {
        return $this->render('work_type/show.html.twig', [
            'work_type' => $workType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_work_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WorkType $workType, WorkTypeRepository $workTypeRepository): Response
    {
        $form = $this->createForm(WorkTypeType::class, $workType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workTypeRepository->save($workType, true);

            return $this->redirectToRoute('app_work_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('work_type/edit.html.twig', [
            'work_type' => $workType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_work_type_delete', methods: ['POST'])]
    public function delete(Request $request, WorkType $workType, WorkTypeRepository $workTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workType->getId(), $request->request->get('_token'))) {
            $workTypeRepository->remove($workType, true);
        }

        return $this->redirectToRoute('app_work_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
