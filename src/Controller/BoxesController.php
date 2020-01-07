<?php

namespace App\Controller;

use App\Entity\Boxes;
use App\Form\BoxesType;
use App\Repository\BoxesRepository;
use App\Service\CountBoxes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/boxes")
 */
class BoxesController extends AbstractController
{
    /**
     * @Route("/", name="boxes_index", methods={"GET"})
     */
    public function index(BoxesRepository $boxesRepository): Response
    {
        $id= $this->getUser()->getId();
        return $this->render('boxes/index.html.twig', [
            'boxes' => $boxesRepository->findBy(['user' => $id])
            ]);
    }

    /**
     * @Route("/new", name="boxes_new", methods={"GET","POST"})
     */
    public function new(Request $request, CountBoxes $number ): Response
    {
        //get User
        $user = ($this->getUser());
        // return last reccord
        $n = $number->getLastReccord($user->getId());
        // create a new box
        $box = new Boxes();
        // set user
        $box->setUser($user);
        // set number and 
        $box->setNumber($n+1);
        $form = $this->createForm(BoxesType::class, $box);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($box);
            $entityManager->flush();

            return $this->redirectToRoute('boxes_index');
        }

        return $this->render('boxes/new.html.twig', [
            'box' => $box,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="boxes_show", methods={"GET"})
     */
    public function show(Boxes $box): Response
    {
        return $this->render('boxes/show.html.twig', [
            'box' => $box,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="boxes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Boxes $box): Response
    {
        $form = $this->createForm(BoxesType::class, $box);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('boxes_index');
        }

        return $this->render('boxes/edit.html.twig', [
            'box' => $box,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="boxes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Boxes $box): Response
    {
        if ($this->isCsrfTokenValid('delete'.$box->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($box);
            $entityManager->flush();
        }

        return $this->redirectToRoute('boxes_index');
    }
}
