<?php
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

    public function actionGenerate()
    {
        //$a = $this->generateObj->generator();
        $request = Request::createFromGlobals();

        return new Response($request->query->get('papa'));
        if (isset($_POST['length'])) {
            $_POST['length'] = json_decode($_POST['length']);
            $data = (array)$_POST['length'];
            if ($data['length'] !== '' && $data['type'] !== '') {
                $rand = $this->generateObj->generator($data);
                return $response = $this->trueResponseBuilder($rand);
            } else {
                return $response = $this->falseResponseBuilder('Make sure you enter all the required parameters');
            }
        } else {
            return $response = $this->falseResponseBuilder('Check the relevance of your data');
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