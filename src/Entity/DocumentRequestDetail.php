<?php

namespace App\Entity;

use App\Repository\DocumentRequestDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRequestDetailRepository::class)]
class DocumentRequestDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'documentRequestDetail', targetEntity: DocumentRequest::class)]
    private Collection $document_request_id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fillValue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_path = null;

    public function __construct()
    {
        $this->document_request_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, DocumentRequest>
     */
    public function getDocumentRequestId(): Collection
    {
        return $this->document_request_id;
    }

    public function addDocumentRequestId(DocumentRequest $documentRequestId): self
    {
        if (!$this->document_request_id->contains($documentRequestId)) {
            $this->document_request_id->add($documentRequestId);
            $documentRequestId->setDocumentRequestDetail($this);
        }

        return $this;
    }

    public function removeDocumentRequestId(DocumentRequest $documentRequestId): self
    {
        if ($this->document_request_id->removeElement($documentRequestId)) {
            // set the owning side to null (unless already changed)
            if ($documentRequestId->getDocumentRequestDetail() === $this) {
                $documentRequestId->setDocumentRequestDetail(null);
            }
        }

        return $this;
    }

    public function getFillValue(): ?string
    {
        return $this->fillValue;
    }

    public function setFillValue(?string $fillValue): self
    {
        $this->fillValue = $fillValue;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(?string $file_name): self
    {
        $this->file_name = $file_name;

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
}
