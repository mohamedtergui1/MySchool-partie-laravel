<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use App\Repositories\PromoRepositoryInterface;
class PromoController extends Controller
{
    private $repository;
    function __construct(PromoRepositoryInterface $repository){
        $this->repository = $repository;
    }
     function index(){
        return $this->success( $this->repository->paginate(10) );
     }

     function destroy(Promo $promo){
        $this->repository->delete($promo);
        return $this->success([],"promo deleted with success");
     }
}
