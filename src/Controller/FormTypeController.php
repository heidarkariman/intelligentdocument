<?php

namespace App\Controller;

use App\Entity\FormType;
use App\Form\FormTypeType;
use App\Repository\FormTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/form/type')]
class FormTypeController extends AbstractController
{
    #[Route('/', name: 'app_form_type_index', methods: ['GET'])]
    public function index(FormTypeRepository $formTypeRepository): Response
    {
        return $this->render('form_type/index.html.twig', [
            'form_types' => $formTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormTypeRepository $formTypeRepository): Response
    {
        $formType = new FormType();
        $form = $this->createForm(FormTypeType::class, $formType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formTypeRepository->save($formType, true);

            return $this->redirectToRoute('app_form_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_type/new.html.twig', [
            'form_type' => $formType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_form_type_show', methods: ['GET'])]
    public function show(FormType $formType): Response
    {
        return $this->render('form_type/show.html.twig', [
            'form_type' => $formType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormType $formType, FormTypeRepository $formTypeRepository): Response
    {
        $form = $this->createForm(FormTypeType::class, $formType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formTypeRepository->save($formType, true);

            return $this->redirectToRoute('app_form_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_type/edit.html.twig', [
            'form_type' => $formType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_form_type_delete', methods: ['POST'])]
    public function delete(Request $request, FormType $formType, FormTypeRepository $formTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formType->getId(), $request->request->get('_token'))) {
            $formTypeRepository->remove($formType, true);
        }

        return $this->redirectToRoute('app_form_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
