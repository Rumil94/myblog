<?php

namespace App\Admin;

use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CommentAdmin extends AbstractAdmin
{
    private const CONTENT_LABEL = 'Содержание';
    private const CREATED_AT_LABEL = 'Дата создания';
    private const USER_LABEL = 'Пользователь';

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('content', TextType::class, [
                'label' => self::CONTENT_LABEL
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'multiple' => false,
                'expanded' => false,
                'by_reference' => false,
                'label' => self::USER_LABEL
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('content', null, [], [
                'label' => self::CONTENT_LABEL
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('content', TextType::class, [
                'label' => self::CONTENT_LABEL
            ])
            ->add('createdAt', null, [
                'label' => self::CREATED_AT_LABEL
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('content', null, [
                'label' => self::CONTENT_LABEL
            ])
            ->add('createdAt', null, [
                'label' => self::CREATED_AT_LABEL
            ]);
    }
}