<?php

namespace App\Entity;

use App\Repository\DocumentRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRequestRepository::class)]
class DocumentRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'document_request', targetEntity: User::class)]
    private Collection $user_id;

    #[ORM\OneToMany(mappedBy: 'document_request', targetEntity: Company::class)]
    private Collection $company_id;

    #[ORM\OneToMany(mappedBy: 'document_request', targetEntity: DocumentType::class)]
    private Collection $document_type_id;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'document_request_id')]
    private ?Tracking $tracking = null;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->company_id = new ArrayCollection();
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
            $userId->setDocumentRequest($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getDocumentRequest() === $this) {
                $userId->setDocumentRequest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompanyId(): Collection
    {
        return $this->company_id;
    }

    public function addCompanyId(Company $companyId): self
    {
        if (!$this->company_id->contains($companyId)) {
            $this->company_id->add($companyId);
            $companyId->setDocumentRequest($this);
        }

        return $this;
    }

    public function removeCompanyId(Company $companyId): self
    {
        if ($this->company_id->removeElement($companyId)) {
            // set the owning side to null (unless already changed)
            if ($companyId->getDocumentRequest() === $this) {
                $companyId->setDocumentRequest(null);
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
            $documentTypeId->setDocumentRequest($this);
        }

        return $this;
    }

    public function removeDocumentTypeId(DocumentType $documentTypeId): self
    {
        if ($this->document_type_id->removeElement($documentTypeId)) {
            // set the owning side to null (unless already changed)
            if ($documentTypeId->getDocumentRequest() === $this) {
                $documentTypeId->setDocumentRequest(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getTracking(): ?Tracking
    {
        return $this->tracking;
    }

    public function setTracking(?Tracking $tracking): self
    {
        $this->tracking = $tracking;

        return $this;
    }
}
