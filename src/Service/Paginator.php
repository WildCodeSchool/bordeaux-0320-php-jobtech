<?php

namespace App\Service;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Paginator
{
    private $paginator;
    private $request;

    public function __construct(RequestStack $request, PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
        $this->request = $request;
    }
    public function paging(array $queryEntity, int $limit)
    {
        return $this->paginator->paginate(
            $queryEntity,
            $this->request->getCurrentRequest()->query->getInt('page', 1),
            $limit
        );
    }

}

