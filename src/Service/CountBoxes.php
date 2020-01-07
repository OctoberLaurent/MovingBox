<?php
namespace App\Service;

use App\Repository\BoxesRepository;

class CountBoxes
{
    private $repo;
    
    public function  __construct(BoxesRepository $repo){

        $this->repo = $repo;
    }

    public function getLastReccord($id)
    {
        $results = $this->repo->findMaxNumber($id);

        return $results;
    }
}