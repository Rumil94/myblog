<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategoryAdmin extends AbstractAdmin
{
    private const NAME_LABEL = 'Название';
    private const SLUG_LABEL = 'Уникальный фрагмент URL-адреса';
    private const COLOR_LABEL = 'Цвет';

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name', TextType::class, [
                'label' => self::NAME_LABEL
            ])
            ->add('slug', TextType::class, [
                'label' => self::SLUG_LABEL
            ])
            ->add('color', ColorType::class, [
                'label' => self::COLOR_LABEL,
                'attr' => [
                    'style' => 'width: 100px;'
                ]
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('name', null, [], [
                'label' => self::NAME_LABEL
            ])
            ->add('slug', null, [], [
                'label' => self::SLUG_LABEL
            ])
            ->add('color', null, [], [
                'label' => self::COLOR_LABEL
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('name', TextType::class, [
                'label' => self::NAME_LABEL
            ])
            ->add('slug', TextType::class, [
                'label' => self::SLUG_LABEL
            ])
            ->add('color', ColorType::class, [
                'label' => self::COLOR_LABEL,
                'attr' => [
                    'style' => 'width: 100px;'
                ]
            ])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [
                        'label' => 'Показать'
                    ],
                    'edit' => [
                        'label' => 'Изменить'
                    ],
                    'delete' => [
                        'label' => 'Удалить'
                    ]
                ],
                'label' => 'Действия'
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('name',TextType::class, [
                'label' => self::NAME_LABEL
            ])
            ->add('slug',TextType::class, [
                'label' => self::SLUG_LABEL
            ])
            ->add('color',ColorType::class, [
                'label' => self::COLOR_LABEL,
                'attr' => [
                    'style' => 'width: 100px;'
                ]
            ]);
    }
}