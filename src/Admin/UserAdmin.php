<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin
{
    private const LOGIN_LABEL = 'Логин';
    private const PASSWORD_LABEL = 'Пароль';
    private const ROLES_LABEL = 'Роли';

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('username', TextType::class, [
                'label' => self::LOGIN_LABEL
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Пароль'],
                'second_options' => ['label' => 'Повторите пароль']
            ])
            ->add('roles', ChoiceFieldMaskType::class, [
                'multiple' => true,
                'choices' => [
                    'ROLE_ADMIN' => 'Администратор',
                    'ROLE_MODERATOR' => 'Модератор',
                    'ROLE_USER' => 'Пользователь',
                    'ROLE_OPERATOR' => 'Оператор',
                ],
                'label' => self::ROLES_LABEL
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('username', null, [], [
                'label' => self::LOGIN_LABEL
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('username', TextType::class, [
                'label' => self::LOGIN_LABEL
            ])
            ->add('password', TextType::class, [
                'label' => self::PASSWORD_LABEL
            ])
            ->add('roles', FieldDescriptionInterface::TYPE_ARRAY, [
                'inline' => true,
                'display' => 'values',
                'label' => self::ROLES_LABEL
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('username', TextType::class, [
                'label' => self::LOGIN_LABEL
            ])
            ->add('password', TextType::class, [
                'label' => self::PASSWORD_LABEL
            ])
            ->add('roles', FieldDescriptionInterface::TYPE_ARRAY, [
                'inline' => true,
                'display' => 'values',
                'label' => self::ROLES_LABEL
            ]);
    }

    protected function prePersist(object $object): void
    {
        $password = $object->getPassword();
        $container = $this->getConfigurationPool()->getContainer();
        $encoder = $container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($object, $password);
        $object->setPassword($encoded);
    }
}