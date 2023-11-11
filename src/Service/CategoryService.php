<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{
    public function __construct(
        readonly CategoryRepository $categoryRepo
    ) {}

    public function findAll(): array
    {
        return $this->categoryRepo->findAll();
    }
}