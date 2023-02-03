<?php

namespace App\Entity;

use DateTime;

class User implements EntityInterface
{

    private int $id;
    private string $uuid;
    private string $name;
    private string $password;
    private DateTime $lastOnline;
    private DateTime $dateOfRegistration;
    private string $email;

    public function __construct(
        int $id,
        string $uuid,
        string $name,
        string $email,
        string $password, // hashed
        DateTime $lastOnline,
        DateTime $dateOfRegistration
    ) {

        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
        $this->password = $password;
        $this->lastOnline = $lastOnline;
        $this->dateOfRegistration = $dateOfRegistration;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return DateTime
     */
    public function getLastOnline(): DateTime
    {
        return $this->lastOnline;
    }

    /**
     * @return DateTime
     */
    public function getDateOfRegistration(): DateTime
    {
        return $this->dateOfRegistration;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'uuid' => $this->getUuid(),
            'name' => $this->getName(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail(),
            'last_online' => $this->getLastOnline(),
            'date_of_registration' => $this->getDateOfRegistration(),
        ];
    }
}