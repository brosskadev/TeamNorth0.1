<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use App\Services\Interfaces\AdminServiceInterface;

class AdminService implements AdminServiceInterface{
    protected $adminRepo;

    public function __construct(AdminRepository $authRepo){
        $this->adminRepo = $authRepo;
    }

}