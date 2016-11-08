<?php

namespace WorkTrackerBundle\Controller;

use WorkTrackerBundle\Entity\WorkTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Worktime controller.
 *
 * @Route("worktime")
 */
class WorkTimeController extends Controller
{
    /**
     * Lists all workTime entities.
     *
     * @Route("/", name="worktime_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $workTimes = $em->getRepository('WorkTrackerBundle:WorkTime')->findAll();

        return $this->render('worktime/index.html.twig', array(
            'workTimes' => $workTimes,
        ));
    }

    /**
     * Creates a new workTime entity.
     *
     * @Route("/new", name="worktime_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $workTime = new Worktime();
        $form = $this->createForm('WorkTrackerBundle\Form\WorkTimeType', $workTime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workTime);
            $em->flush($workTime);

            return $this->redirectToRoute('worktime_show', array('id' => $workTime->getId()));
        }

        return $this->render('worktime/new.html.twig', array(
            'workTime' => $workTime,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a workTime entity.
     *
     * @Route("/{id}", name="worktime_show")
     * @Method("GET")
     */
    public function showAction(WorkTime $workTime)
    {
        $deleteForm = $this->createDeleteForm($workTime);

        return $this->render('worktime/show.html.twig', array(
            'workTime' => $workTime,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing workTime entity.
     *
     * @Route("/{id}/edit", name="worktime_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, WorkTime $workTime)
    {
        $deleteForm = $this->createDeleteForm($workTime);
        $editForm = $this->createForm('WorkTrackerBundle\Form\WorkTimeType', $workTime);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('worktime_edit', array('id' => $workTime->getId()));
        }

        return $this->render('worktime/edit.html.twig', array(
            'workTime' => $workTime,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a workTime entity.
     *
     * @Route("/{id}", name="worktime_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, WorkTime $workTime)
    {
        $form = $this->createDeleteForm($workTime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($workTime);
            $em->flush($workTime);
        }

        return $this->redirectToRoute('worktime_index');
    }

    /**
     * Creates a form to delete a workTime entity.
     *
     * @param WorkTime $workTime The workTime entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(WorkTime $workTime)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('worktime_delete', array('id' => $workTime->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
