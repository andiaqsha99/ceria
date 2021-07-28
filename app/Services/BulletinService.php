<?php
namespace App\Services;

use App\Repositories\Bulletin\BulletinRepositoryInterface;
use App\Repositories\Document\DocumentRepositoryInterface;
use Illuminate\Http\Request;

class BulletinService {

    protected $bulletinRepository;
    protected $documentRepository;

    public function __construct(
        BulletinRepositoryInterface $bulletinRepository,
        DocumentRepositoryInterface $documentRepository
    ){
        $this->bulletinRepository = $bulletinRepository;
        $this->documentRepository = $documentRepository;
    }

    public function getAllBulletin() {
        return $this->bulletinRepository->getAllBulletinByApproved('1');
    }

    public function getBulletinById($id) {
        return $this->bulletinRepository->getBulletinById($id);
    }

    public function createBulletin(Request $request) {
        $bulletin = $this->bulletinRepository->createBulletin($request);
        if($request->file('lampiran')) {
            $this->documentRepository->createDocumentBulletin($request, $bulletin);
        }

        return $bulletin;
    }

    public function updateBulletin(Request $request) {
        return $this->bulletinRepository->updateBulletin($request);
    }

    public function deleteBulletinById($id) {
        return $this->bulletinRepository->deleteBulletinById($id);
    }

    public function getNotAprovedBulletin() {
        return $this->bulletinRepository->getAllBulletinByApproved('0');
    }

    public function getBulletinByUsername($user_update) {
        return $this->bulletinRepository->getBulletinByUsername($user_update);
    }
}
