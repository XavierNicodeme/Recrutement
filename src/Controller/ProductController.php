<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index():Response
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $product->setCreationDate(new DateTime());
            $managerRegistry->getManager()->persist($product);

            $managerRegistry->getManager()->flush();

            return $this->redirectToRoute('product_index');
        }
        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Product $product, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $product->setDateUpdate(new DateTime());
            $managerRegistry->getManager()->flush();

            return $this->redirectToRoute('product/index.html.twig');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form'    => $form->createView(),
        ]);
    }
}