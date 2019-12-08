<?php

namespace App\EventSubscriber\Form;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArtWorkFormSubscriber implements EventSubscriberInterface
{
    public function postSetData(FormEvent $event) {

        $form = $event->getForm();
        $entity = $form->getData();

        $contraints = $entity->getId() ? [] : [
            new NotBlank([
                'message' => "L'image est obligatoire"
            ]),
            new Image([
                'mimeTypesMessage' => "Vous devez sélectionner une image",
                'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp']
            ])
        ];

        $form->add('image', FileType::class,[
            'data_class' => null,
            'constraints' => $contraints
        ]);
    }

    public static function getSubscribedEvents()
    {

        return [
            FormEvents::POST_SET_DATA => 'postSetData',
        ];
    }
}