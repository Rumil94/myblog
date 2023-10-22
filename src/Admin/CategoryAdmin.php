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

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name', TextType::class, ['label' => $this->getParamLabel('name')])
            ->add('slug', TextType::class, ['label' => $this->getParamLabel('slug')])
            ->add('color', ChoiceFieldMaskType::class, [
                'multiple' => false,
                'choices' => array_flip($this->getColors()),
                'label' => $this->getParamLabel('color')
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('name', TextType::class, ['label' => $this->getParamLabel('name')])
            ->add('slug', TextType::class, ['label' => $this->getParamLabel('slug')])
            ->add('color', TextType::class, ['label' => $this->getParamLabel('color')]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('name', TextType::class, ['label' => $this->getParamLabel('name')])
            ->add('slug', TextType::class, ['label' => $this->getParamLabel('slug')])
            ->add('color', TextType::class, ['label' => $this->getParamLabel('color')]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('name',TextType::class, ['label' => $this->getParamLabel('name')])
            ->add('slug',TextType::class, ['label' => $this->getParamLabel('slug')])
            ->add('color',FieldDescriptionInterface::TYPE_CHOICE, [
                'choices' => $this->getColors(),
                'label' => $this->getParamLabel('color')
            ]);
    }

    private function getParamLabel($key): bool|string
    {
        $params = [
            'name' => 'Название',
            'slug' => 'Уникальный фрагмент URL-адреса',
            'color' => 'Цвет',
        ];
        if (in_array($key, $params)) {
            return $params[$key];
        }
        return false;
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