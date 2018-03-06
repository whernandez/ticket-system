<?php

namespace UserBundle\Form;

use CompanyBundle\Entity\Company;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Choice;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,
                    array(
                        'label' => 'Email:',
                        'attr' => array(
                            'placeholder' => 'myemail@email.com',
                            'class' => 'form-control'
                        )
                    )
                )
            ->add('username', TextType::class,
                    array(
                        'label' => 'Username:',
                        'attr' => array(
                            'placeholder' => 'max 16 chars',
                            'class' => 'form-control'
                        )
                    )
            )
            ->add('plainPassword', RepeatedType::class,
                array(
                'type' => PasswordType::class,
                'first_options'  => array(
                    'label' => 'Password:',
                    'attr' => array(
                        'class' => 'form-control'
                )),
                'second_options' =>
                    array(
                        'label' => 'Repeat Password:',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => 'Same Password'
                        )),
            ))
            ->add('company', EntityType::class,
                array(
                    'class' => Company::class,
                    'label' => 'Company:',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
        ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }


}
