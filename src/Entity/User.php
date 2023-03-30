<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $crated_at = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?Document $document = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?Education $education = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?WorkExperience $workExperience = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?Project $project = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?FormTemplate $form_template = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?DocumentRequest $document_request = null;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCratedAt(): ?\DateTimeInterface
    {
        return $this->crated_at;
    }

    public function setCratedAt(\DateTimeInterface $crated_at): self
    {
        $this->crated_at = $crated_at;

        return $this;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getEducation(): ?Education
    {
        return $this->education;
    }

    public function setEducation(?Education $education): self
    {
        $this->education = $education;

        return $this;
    }

    public function getWorkExperience(): ?WorkExperience
    {
        return $this->workExperience;
    }

    public function setWorkExperience(?WorkExperience $workExperience): self
    {
        $this->workExperience = $workExperience;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getFormTemplate(): ?FormTemplate
    {
        return $this->form_template;
    }

    public function setFormTemplate(?FormTemplate $form_template): self
    {
        $this->form_template = $form_template;

        return $this;
    }

    public function getDocumentRequest(): ?DocumentRequest
    {
        return $this->document_request;
    }

    public function setDocumentRequest(?DocumentRequest $document_request): self
    {
        $this->document_request = $document_request;

        return $this;
    }
}
