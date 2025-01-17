<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $data = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=TgChat::class, inversedBy="games")
     */
    private $TgChat;

    /**
     * @ORM\ManyToMany(targetEntity=TgUser::class, inversedBy="games")
     */
    private $TgUsers;

    public function __construct()
    {
        $this->TgUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getTgChat(): ?TgChat
    {
        return $this->TgChat;
    }

    public function setTgChat(?TgChat $TgChat): self
    {
        $this->TgChat = $TgChat;

        return $this;
    }

    /**
     * @return Collection|TgUser[]
     */
    public function getTgUsers(): Collection
    {
        return $this->TgUsers;
    }

    public function addTgUser(TgUser $tgUser): self
    {
        if (!$this->TgUsers->contains($tgUser)) {
            $this->TgUsers[] = $tgUser;
        }

        return $this;
    }

    public function removeTgUser(TgUser $tgUser): self
    {
        if ($this->TgUsers->contains($tgUser)) {
            $this->TgUsers->removeElement($tgUser);
        }

        return $this;
    }
}
