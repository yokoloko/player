<?php

namespace App\Controller;

use App\Normalizer\FavoriteNormalizer;
use App\Normalizer\SongNormalizer;
use App\Normalizer\UserNormalizer;
use Framework\Response\JsonResponse;
use Framework\Response\Response;
use Framework\Response\XmlResponse;
use Framework\Serializer\Normalizer\ArrayNormalizer;
use Framework\Serializer\Serializer;

class Controller extends \Framework\Controller\Controller
{
    /**
     * @return Serializer
     */
    public function getSerializer()
    {
        $serializer = parent::getSerializer();

        $serializer->addNormalizer(new FavoriteNormalizer());
        $serializer->addNormalizer(new UserNormalizer());
        $serializer->addNormalizer(new SongNormalizer());
        $serializer->addNormalizer(new ArrayNormalizer());

        return $serializer;
    }

    public function createResponse($body, $code = 200)
    {
        $request = $this->request;

        foreach ($request->getAcceptedContentTypes() as $type) {
            $type = current(explode(';', $type));

            switch ($type) {
                # default type to Json
                case '*/*':
                case 'application/json':
                case 'text/json':
                    return new JsonResponse($body, $code);
                case 'text/xml':
                case 'application/xml':
                    return new XmlResponse($body, $code);
            }
        }

        # Server cannot display requested format
        return new Response(null, 409);
    }
}