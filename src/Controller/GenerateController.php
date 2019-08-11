<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Generate;

class GenerateController
{
    private $generateObj;

    public function __construct(Generate $obj)
    {
        $this->generateObj = $obj;
    }

    /**
     * @return Response
     * @throws \Doctrine\DBAL\DBALException
     */
    public function actionGenerate(): Response
    {
        $request = Request::createFromGlobals();
        if ($request->request->get('length')) {
            $length = urldecode($request->request->get('length'));
            $length = json_decode($length);
            $data = (array)$length;
            if ($data['length'] !== '' && $data['type'] !== '') {
                $rand = $this->generateObj->generator($data);
                $response = $this->trueResponseBuilder($rand);
                return new Response($response);
            } else {
                $response = $this->falseResponseBuilder('Make sure you enter all the required parameters');
                return new Response($response);
            }
        } else {
            $response = $this->falseResponseBuilder('Check the relevance of your data');
            return new Response($response);
        }
    }

    /**
     * @param array $data
     * @return string
     */
    private function trueResponseBuilder(array $data): string
    {
        $response = [
            'status' => true,
            'id' => $data['id'],
            'value' => $data['value'],
        ];

        return $response = json_encode($response);
    }

    /**
     * @param string $message
     * @return string
     */
    private function falseResponseBuilder(string $message): string
    {
        $response = [
            'status' => false,
            'text' => $message,
        ];

        return $response = json_encode($response);
    }
}