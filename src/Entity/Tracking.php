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

    #[ORM\OneToMany(mappedBy: 'tracking', targetEntity: Request::class)]
    private Collection $request_id;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    public function __construct()
    {
        $this->request_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Request>
     */
    public function getRequestId(): Collection
    {
        return $this->request_id;
    }

    public function addRequestId(Request $requestId): self
    {
        if (!$this->request_id->contains($requestId)) {
            $this->request_id->add($requestId);
            $requestId->setTracking($this);
        }

        return $this;
    }

    public function removeRequestId(Request $requestId): self
    {
        if ($this->request_id->removeElement($requestId)) {
            // set the owning side to null (unless already changed)
            if ($requestId->getTracking() === $this) {
                $requestId->setTracking(null);
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
