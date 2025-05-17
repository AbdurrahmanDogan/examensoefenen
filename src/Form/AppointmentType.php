<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Datum',
            ])
            ->add('time', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Tijd',
            ])
            ->add('subject', TextType::class, [
                'label' => 'Onderwerp',
            ])
            ->add('problems', TextareaType::class, [
                'label' => 'Problemen (optioneel)',
                'required' => false,
            ])
            ->add('discussed', TextareaType::class, [
                'label' => 'Besproken punten (optioneel)',
                'required' => false,
            ])
            ->add('patient', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'firstname',
                'label' => 'Patiënt',
            ])
            ->add('specialist', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'firstname',
                'label' => 'Specialist',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Afspraak aanmaken',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
