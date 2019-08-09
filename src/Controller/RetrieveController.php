<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Retrieve;

class RetrieveController
{
    private $retrieveObj;

    public function __construct(Retrieve $retrieveObj)
    {
        $this->retrieveObj = $retrieveObj;
    }

    /**
     * @return Response
     * @throws \Doctrine\DBAL\DBALException
     */
    public function actionValue(): Response
    {
        $request = Request::createFromGlobals();

        if ($id = $request->query->get('id')) {
            $value = $this->retrieveObj->getValue($id);
            $response = json_encode([
                'status' => true,
                'value'  => $value[0]['value'],
            ]);
            return new Response($response);
        } else {
            $response = 'Check the relevance of your data';
            $response = json_encode(
                $response = [
                    'status' => false,
                    'text' => $response,
                ]);
            return new Response($response);
        }
    }
}