<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: User::class)]
    private Collection $user_id;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: DocumentType::class)]
    private Collection $document_type_id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_path = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->document_type_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
            $userId->setDocument($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getDocument() === $this) {
                $userId->setDocument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DocumentType>
     */
    public function getDocumentTypeId(): Collection
    {
        return $this->document_type_id;
    }

    public function addDocumentTypeId(DocumentType $documentTypeId): self
    {
        if (!$this->document_type_id->contains($documentTypeId)) {
            $this->document_type_id->add($documentTypeId);
            $documentTypeId->setDocument($this);
        }

        return $this;
    }

    public function removeDocumentTypeId(DocumentType $documentTypeId): self
    {
        if ($this->document_type_id->removeElement($documentTypeId)) {
            // set the owning side to null (unless already changed)
            if ($documentTypeId->getDocument() === $this) {
                $documentTypeId->setDocument(null);
            }
        }

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function setFilePath(?string $file_path): self
    {
        $this->file_path = $file_path;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
