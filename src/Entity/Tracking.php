<?php

namespace App\Entity;

use App\Repository\TrackingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackingRepository::class)]
class Tracking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'tracking', targetEntity: DocumentRequest::class)]
    private Collection $document_request_id;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

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

    public function addDocumentRequestId(DocumentRequest $document_requestId): self
    {
        if (!$this->document_request_id->contains($document_requestId)) {
            $this->document_request_id->add($document_requestId);
            $document_requestId->setTracking($this);
        }

        return $this;
    }

    public function removeDocumentRequestId(DocumentRequest $document_requestId): self
    {
        if ($this->document_request_id->removeElement($document_requestId)) {
            // set the owning side to null (unless already changed)
            if ($document_requestId->getTracking() === $this) {
                $document_requestId->setTracking(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
