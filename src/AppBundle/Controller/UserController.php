<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\User;

use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends Controller
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Create a new user",
     *     statusCodes={
     *         200="Returned when successful",
     *     },
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Id of the user"
     *      }
     *  },
     * )
     *
     * @param $id
     * @return View
     */
    public function getUserAction($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneById($id);
        if(!is_object($user)){
            throw $this->createNotFoundException();
        }
        $view = View::create();
        $view->setData($user)->setStatusCode(200);
        return $view;
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Create a new user",
     *     statusCodes={
     *         200="Returned when successful",
     *         403="Returned when the user is already in database",
     *     },
     *  parameters={
     *      {"name"="first_name", "dataType"="string", "required"=true, "description"="first name"},
     *      {"name"="last_name", "dataType"="string", "required"=true, "description"="last name"}
     *  }
     * )
     *
     *
     * @RequestParam(name="first_name")
     * @RequestParam(name="last_name")
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return View
     */
    public function postUserAction(ParamFetcher $paramFetcher) {
        $firstName = $paramFetcher->get('first_name');
        $lastName = $paramFetcher->get('last_name');

        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);

        $view = View::create();

        try {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $view->setStatusCode(201);
        } catch (\Doctrine\DBAL\DBALException $e) {
            $view->setStatusCode(403);
        } catch (\Exception $e) {
            $view->setStatusCode(500);
        }
        return $view;
    }
}
