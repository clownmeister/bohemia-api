<?php

namespace ClownMeister\BohemiaApi\Form;

use ClownMeister\BohemiaApi\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //I hate flow :D
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['autocomplete' => 'email']
            ])->setRequired(true)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('firstname', TextType::class, [
                'attr' => ['autocomplete' => 'given-name']
            ])->setRequired(true)
            ->add('lastname', TextType::class, [
                'attr' => ['autocomplete' => 'family-name']
            ])->setRequired(true)
//            Propably dont need it in the registration
//            ->add('phone', TelType::class, [
//                'attr' => ['autocomplete' => 'tel']
//            ])
//            ->add('country', CountryType::class, [
//                'attr' => ['autocomplete' => 'country-name']
//            ])
//            ->add('state', CountryType::class, [
//                'attr' => ['autocomplete' => 'state']
//            ])
//            ->add('city', CountryType::class, [
//                'attr' => ['autocomplete' => 'city']
//            ])
//            ->add('street', CountryType::class, [
//                'attr' => ['autocomplete' => 'street-address']
//            ])
//            ->add('zip', StringType::class, [
//                'attr' => ['autocomplete' => 'postal-code']
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
