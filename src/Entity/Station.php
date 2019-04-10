<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StationRepository")
 */
class Station
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Title", inversedBy="stations")
     * */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=5,minMessage="Text must have more then 5 character")
     */
    private $text;

    /**
     * @ORM\Column(type="boolean")
     */
    private $readed;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @Assert\Valid()
     * @Assert\Count(3)
     * @ORM\OneToMany(targetEntity="App\Entity\File", mappedBy="station", cascade={"persist"})
     */
    private $files;


    public function __construct()
    {
        $this->files=new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getReaded()
    {
        return $this->readed;
    }

    /**
     * @param mixed $readed
     */
    public function setReaded($readed): void
    {
        $this->readed = $readed;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return ArrayCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param ArrayCollection $files
     */
    public function setFiles($files): void
    {
        $this->files = $files;
    }


    public function setAttachFile(array $files=array())
    {
        if (!$files) return [];
        foreach ($files as $file) {
            if (!$file) return [];
            $this->attachFile($file);
        }
        return [];
    }


    public function attachFile(UploadedFile $file=null)
    {
        if (!$file) {
            return;
        }
        $newFile = new File();
        $newFile->setName($file);
        $this->addFile($newFile);
    }

    public function addFile(File $file)
    {
        $file->setStation($this);
        $this->files->add($file);
    }



}
