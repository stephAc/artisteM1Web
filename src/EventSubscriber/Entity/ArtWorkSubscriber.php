<?php

namespace App\EventSubscriber\Entity;

use App\Entity\ArtWork;
use App\Service\FileService;
use App\Service\StringService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArtWorkSubscriber implements EventSubscriber {

    private $stringService;
    private $fileService;

    public function __construct(StringService $stringService, FileService $fileService){
        $this->stringService = $stringService;
        $this->fileService = $fileService;
    }

    public function prePersist(LifecycleEventArgs $args):void {
        $entity = $args->getObject();

        if(!$entity instanceof ArtWork){
            return;
        }else{
            if($entity->getImage() instanceof UploadedFile){
                $this->fileService->upload($entity->getImage(),'img/artwork');
                $entity->setImage($this->fileService->getFileName());
            }
        }
    }

    public function postLoad(LifecycleEventArgs $args):void {
        $entity = $args->getObject();

        if(!$entity instanceof ArtWork){
            return;
        }else{
            $entity->prevImage = $entity->getImage();
        }
    }

    public function preUpdate(LifecycleEventArgs $args):void {
        $entity = $args->getObject();

        if(!$entity instanceof ArtWork){
            return;
        }else{
            if($entity->getImage() instanceof UploadedFile){
                $this->fileService->upload($entity->getImage(), 'img/artwork');
                $entity->setImage($this->fileService->getFileName());

                if(file_exists("img/artwork/{entity->prevImage}")){
                    $this->fileService->remove('img/artwork', $entity->prevImage);
                }
            }else{
                $entity->setImage($entity->prevImage);
            }
        }
    }

    public function getSubscribedEvents():array {

        return [
            Events::prePersist,
            Events::postLoad,
            Events::preUpdate
        ];
    }

}