<?php

namespace App\DataTransferObject;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class MessageDTO
{
    public ?int $id;

    public ?string $text;

    public ?int $user;

    public ?int $status;

    public ?\DateTimeInterface $datetime;

    public static function fromRequest(Request $request): self
    {
        $content = json_decode($request->getContent(), true);

        $dto = new self();
        $dto->text = $content['message'];
        $dto->datetime = new \DateTime();

        return $dto;
    }

    public static function fromEntity(Message $message): self
    {
        $dto = new self();

        $dto->id = $message->getId();
        $dto->text = $message->getText();
        $dto->datetime = $message->getDatetime();
        $dto->user = $message->getUser()->getId();

        return $dto;
    }
}
