<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimcore\Model\DataObject;

class ContentController extends FrontendController
{
    public function medicinesAction(Request $request): Response
    {
        $reqPage = $request->get('page') ?? 1;
        $page = [
            'prev' => $reqPage > 1 ? $reqPage - 1 : 1,
            'current' => $reqPage,
            'next' => $reqPage + 1
        ];

        $medicines = DataObject\Medicine::getList([
            "offset" => ($reqPage * 10) - 10,
            "limit" => 10,
        ]);

        return $this->render('content/medicines.html.twig', ['medicines' => $medicines, 'page' => $page]);
    }

    public function medicineAction(Request $request): Response
    {
        $medicine = DataObject\Medicine::getById($request->get('id'));

        return $this->render('content/medicine.html.twig', ['medicine' => $medicine]);
    }
}
