<?php

namespace App\Entity;

use App\Repository\RequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestRepository::class)]
class Request
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'request', targetEntity: User::class)]
    private Collection $user_id;

    #[ORM\OneToMany(mappedBy: 'request', targetEntity: Company::class)]
    private Collection $company_id;

    #[ORM\OneToMany(mappedBy: 'request', targetEntity: DocumentType::class)]
    private Collection $document_type_id;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'request_id')]
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
            $userId->setRequest($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getRequest() === $this) {
                $userId->setRequest(null);
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
            $companyId->setRequest($this);
        }

        return $this;
    }

    public function removeCompanyId(Company $companyId): self
    {
        if ($this->company_id->removeElement($companyId)) {
            // set the owning side to null (unless already changed)
            if ($companyId->getRequest() === $this) {
                $companyId->setRequest(null);
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
            $documentTypeId->setRequest($this);
        }

        return $this;
    }

    public function removeDocumentTypeId(DocumentType $documentTypeId): self
    {
        if ($this->document_type_id->removeElement($documentTypeId)) {
            // set the owning side to null (unless already changed)
            if ($documentTypeId->getRequest() === $this) {
                $documentTypeId->setRequest(null);
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
