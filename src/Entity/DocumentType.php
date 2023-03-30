<?php

namespace App\Entity;

use App\Repository\DocumentTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentTypeRepository::class)]
class DocumentType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'document_type_id')]
    private ?Document $document = null;

    #[ORM\ManyToOne(inversedBy: 'document_type_id')]
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

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

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
