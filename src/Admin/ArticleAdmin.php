<?php

namespace App\Admin;

use App\Entity\{ Category };
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ArticleAdmin extends AbstractAdmin
{
    private const NAME_LABEL = 'Название';
    private const SLUG_LABEL = 'Уникальный фрагмент URL-адреса';
    private const CONTENT_LABEL = 'Cодержание';
    private const CATEGORIES_LABEL = 'Категории';
    private const FEATURED_TEXT_LABEL = 'Избранный текст';
    private const CREATED_AT_LABEL = 'Дата создания';
    private const UPDATED_AT_LABEL = 'Дата изменения';

    protected function configureFormFields(FormMapper $form): void
    {
        if ($this->isCurrentRoute('create')) {
            $form
                ->add('createdAt', DateTimeType::class, [
                    'data' => new \DateTime(),
                    'label' => self::CREATED_AT_LABEL
                ]);
        } else {
            $form
                ->add('updatedAt', DateTimeType::class, [
                    'data' => new \DateTime(),
                    'label' => self::UPDATED_AT_LABEL
                ]);
        }
        $form
            ->add('title', TextType::class, [
                'label' => self::NAME_LABEL
            ])
            ->add('slug', TextType::class, [
                'label' => self::SLUG_LABEL
            ])
            ->add('content', TextareaType::class, [
                'label' => self::CONTENT_LABEL
            ])
            ->add('featuredText', TextType::class, [
                'label' => self::FEATURED_TEXT_LABEL
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'choice_label' => 'name',
                'label' => self::CATEGORIES_LABEL
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('title', null, [], [
                'label' => self::NAME_LABEL
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('title', TextType::class, [
                'label' => self::NAME_LABEL
            ])
            ->add('featuredText', TextType::class, [
                'label' => self::FEATURED_TEXT_LABEL
            ])
            ->add('createdAt', null, [
                'label' => self::CREATED_AT_LABEL
            ])
            ->add('updatedAt', null, [
                'label' => self::UPDATED_AT_LABEL
            ])
            ->add('categories', null, [
                'associated_property' => 'name',
                'delimiter' => ' | ',
                'label' => self::CATEGORIES_LABEL
            ])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => []
                ]
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('title', null, [
                'label' => self::NAME_LABEL
            ])
            ->add('slug', null, [
                'label' => self::SLUG_LABEL
            ])
            ->add('featuredText', null, [
                'label' => self::FEATURED_TEXT_LABEL
            ])
            ->add('createdAt', null, [
                'label' => self::CREATED_AT_LABEL
            ])
            ->add('updatedAt', null, [
                'label' => self::UPDATED_AT_LABEL
            ])
            ->add('categories', null, [
                'associated_property' => 'name',
                'delimiter' => ' | ',
                'label' => self::CATEGORIES_LABEL
            ])
            ->add('content', null, [
                'label' => self::CONTENT_LABEL
            ]);
    }
}