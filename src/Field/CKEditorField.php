<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

final class CKEditorField implements FieldInterface
{
    use FieldTrait;

    /**
     * @param string|false|null $label
     */
    public static function new(string $propertyName, $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplateName('crud/field/text_editor')
            ->setFormType(CKEditorType::class)
            ->addCssClass('field-ckeditor');
    }
}
