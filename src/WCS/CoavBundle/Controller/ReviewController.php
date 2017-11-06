<?php

namespace WCS\CoavBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WCS\CoavBundle\Entity\Review;
use WCS\CoavBundle\Form\ReviewType;

/**
 * @Route("review")
 */
class ReviewController extends Controller
{
    /**
     * @Route("/", name="review_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reviews = $em->getRepository('WCSCoavBundle:Review')->findAll();
        return $this->render('WCSCoavBundle:Review:index.html.twig', array(
            'reviews' => $reviews
        ));
    }

    /**
     * @Route("/new", name="review_new")
     */
    public function newAction(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('review_show', array('id' => $review->getId()));
        }
        return $this->render('WCSCoavBundle:Review:new.html.twig', array(
            'form'=>$form->createView(),
            'review'=>$review,
        ));
    }

    /**
     *
     * @Route("/{id}", name="review_show")
     */
    public function showAction(Review $review){

        return $this->render('WCSCoavBundle:Review:show.html.twig', array(

            'review'=>$review,
        ));

    }

    /**
     *
     * @Route("/delete/{id}", name="review_delete")
     */
    public function deleteAction(Review $review){
        if (!$review)
            throw new NotFoundHttpException('la review '.$review->getId().' pas trouvé');
        $em=$this->getDoctrine()->getManager();
        $review = $em->getRepository('WCSCoavBundle:Review')->find($review->getId());
        $em->remove($review);
        $em->flush();
        $this->redirectToRoute('review_index');
    }

    /**
     *
     * @Route("/edit/{id}", name="review_edit")
     */
    public function editAction(Review $review,Request $request){
        if (!$review)
            throw new NotFoundHttpException('la review '.$review->getId().' pas trouvé');

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('review_show', array('id' => $review->getId()));
        }
        return $this->render('WCSCoavBundle:Review:edit.html.twig', array(
            'form'=>$form->createView(),
            'review'=>$review,
        ));
    }

}
