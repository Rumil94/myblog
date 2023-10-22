<?php

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ArticleAdmin extends AbstractAdmin
{
    private const NAME_LABEL = 'Название';
    private const SLUG_LABEL = 'Уникальный фрагмент URL-адреса';
    private const CONTENT_LABEL = 'Cодержание';
    private const CATEGORIES_LABEL = 'Категории';

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('title', TextType::class, ['label' => self::NAME_LABEL])
            ->add('slug', TextType::class, ['label' => self::SLUG_LABEL])
            ->add('content', TextareaType::class, ['label' => self::CONTENT_LABEL])
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
        $datagrid->add('title');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('title');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('title');
    }
}