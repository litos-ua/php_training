<?php

namespace App\Controller;

use App\Shortener\Interfaces\IUrlDecoder;
use App\Shortener\Interfaces\IUrlEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/url')]
class ShortenerController extends AbstractController
{
    public function __construct(
        protected IUrlEncoder $encoder,
        protected IUrlDecoder $decoder
    )
    {
    }

    #[Route('/encode',
        methods: ['POST']
    )]
    public function encodeAction (Request $request): Response
    {
        //$rqwst1 = $request->attributes->get('url');
        //$code = $this->encoder->encode($request->attributes->get('url'));
        //$rqwst3 = $request->request->get('url');
        //$code = $this->encoder->encode($request->request->get('url'));

        $rqwst2 = $request->get('url');
        $code = $this->encoder->encode($rqwst2);//$this->encoder->encode($request->get('url'));

        return new Response($code);
    }

    #[Route('/decode',
        methods: ['POST']
    )]
    public function decodeAction (Request $request): Response
    {
        $rqwst2 = $request->get('code');
        $code = $this->decoder->decode($rqwst2);

        return new Response($code);
    }

    #[Route('/{code}',
        requirements:['code' => '\w{6,8}'],
        methods: ['GET']
    )]
    public function redirectAction (string $code): Response
    {
        try{
            $url = $this->decoder->decode($code);
            $response = new RedirectResponse($url);
        }   catch (\Throwable $e) {
            $response = new RedirectResponse($e->getMessage(), 400);
        }
        return  $response;
    }


}