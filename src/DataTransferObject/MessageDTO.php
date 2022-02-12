<?php

namespace App\DataTransferObject;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class MessageDTO
{
    public ?int $id;

    public ?string $text;

    public ?User $user;

    public ?int $status;

    public ?\DateTimeInterface $datetime;

    public static function fromRequest(Request $request): self
    {
        $text = json_decode($request->getContent(), true)['message'];

        return new self([
            'text'     => $text,
            'user'     => $request->getUser(),
            'datetime' => new \DateTime()
        ]);
    }

    public static function fromEntity(Message $message): self
    {

    }
}
