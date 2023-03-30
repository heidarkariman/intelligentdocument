<?php

namespace App\Entity;

use App\Repository\FormTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormTypeRepository::class)]
class FormType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'form_type_id')]
    private ?FormTemplate $form_template = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFormTemplate(): ?FormTemplate
    {
        return $this->$form_template;
    }

    public function setFormTemplate(?FormTemplate $form_template): self
    {
        $this->$form_template = $form_template;

        return $this;
    }
}
