<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $runtime;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="movies")
     */
    private $genreList;

    /**
     * @ORM\OneToMany(targetEntity=Director::class, mappedBy="movie")
     */
    private $director;

    public function __construct()
    {
        $this->genreList = new ArrayCollection();
        $this->director = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function setRuntime(?int $runtime): self
    {
        $this->runtime = $runtime;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenreList(): Collection
    {
        return $this->genreList;
    }

    public function addGenreList(Genre $genreList): self
    {
        if (!$this->genreList->contains($genreList)) {
            $this->genreList[] = $genreList;
        }

        return $this;
    }

    public function removeGenreList(Genre $genreList): self
    {
        $this->genreList->removeElement($genreList);

        return $this;
    }

    /**
     * @return Collection<int, Director>
     */
    public function getDirector(): Collection
    {
        return $this->director;
    }

    public function addDirector(Director $director): self
    {
        if (!$this->director->contains($director)) {
            $this->director[] = $director;
            $director->setMovie($this);
        }

        return $this;
    }

    public function removeDirector(Director $director): self
    {
        if ($this->director->removeElement($director)) {
            // set the owning side to null (unless already changed)
            if ($director->getMovie() === $this) {
                $director->setMovie(null);
            }
        }

        return $this;
    }

    
}
