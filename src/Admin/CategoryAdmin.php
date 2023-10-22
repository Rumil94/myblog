<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategoryAdmin extends AbstractAdmin
{
    private const NAME_LABEL = 'Название';
    private const SLUG_LABEL = 'Уникальный фрагмент URL-адреса';
    private const COLOR_LABEL = 'Цвет';

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name', TextType::class, ['label' => self::NAME_LABEL])
            ->add('slug', TextType::class, ['label' => self::SLUG_LABEL])
            ->add('color', ChoiceFieldMaskType::class, [
                'multiple' => false,
                'choices' => array_flip($this->getColors()),
                'label' => self::COLOR_LABEL
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('name', null, [], ['label' => self::NAME_LABEL])
            ->add('slug', null, [], ['label' => self::SLUG_LABEL])
            ->add('color', null, [], ['label' => self::COLOR_LABEL]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('name', TextType::class, ['label' => self::NAME_LABEL])
            ->add('slug', TextType::class, ['label' => self::SLUG_LABEL])
            ->add('color', TextType::class, ['label' => self::COLOR_LABEL]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('name',TextType::class, ['label' => self::NAME_LABEL])
            ->add('slug',TextType::class, ['label' => self::SLUG_LABEL])
            ->add('color',FieldDescriptionInterface::TYPE_CHOICE, [
                'choices' => $this->getColors(),
                'label' => self::COLOR_LABEL
            ]);
    }

    private function getColors(): array {
        return [
            'red' => 'Красный',
            'green' => 'Зеленый',
            'blue' => 'Синий',
            'black' => 'Черный'
        ];
    }
}